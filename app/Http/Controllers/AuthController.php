<?php namespace App\Http\Controllers;

use Hash;
use Config;
use Validator;
use JWTAuth;
use Illuminate\Http\Request;
use GuzzleHttp;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use App\User;

class AuthController extends Controller {
    /**
     * Create Email and Password Account.
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prenom' => 'required|alpha',
            'nom' => 'required|alpha',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 400);
        }

        $user = new User;
        $user->prenom = $request->input('prenom');
        $user->nom = $request->input('nom');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json(['token' => JWTAuth::fromUser($user)]);
    }

    /**
     * Log in with Email and Password.
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', '=', $email)->first();

        if (!$user)
        {
            return response()->json(['message' => 'Mauvais email et/ou mot de passe'], 401);
        }

        if (Hash::check($password, $user->password))
        {
            unset($user->password);

            return response()->json(['token' => JWTAuth::fromUser($user)]);
        }
        else
        {
            return response()->json(['message' => 'Mauvais email et/ou mot de passe'], 401);
        }
    }
    
    /**
     * Login with Facebook.
     */
    public function facebook(Request $request)
    {
        $client = new GuzzleHttp\Client();

        // Step 1. Exchange authorization code for access token.
        $accessTokenResponse = $client->request('GET', 'https://graph.facebook.com/v2.5/oauth/access_token', [
            'query' => [
                'code' => $request->input('code'),
                'client_id' => $request->input('clientId'),
                'redirect_uri' => $request->input('redirectUri'),
                'client_secret' => Config::get('app.facebook_secret')
            ],
            'verify' => Config::get('app.guzzle_ssl_verify')
        ]);

        $accessToken = json_decode($accessTokenResponse->getBody(), true);

        // // Step 2. Retrieve profile information about the current user.
        $profileResponse = $client->request('GET', 'https://graph.facebook.com/v2.5/me', [
            'query' => [
                'access_token' => $accessToken['access_token'],
                'fields' => 'id,email,first_name,last_name,gender,link'
            ],
            'verify' => Config::get('app.guzzle_ssl_verify')
        ]);
        $profile = json_decode($profileResponse->getBody(), true);

        $userFacebook = User::where('facebook_id', '=', $profile['id'])
                ->orWhere('email', '=', $profile['email'])->first();

        // Step 3a. If user is already signed in then link accounts.
        if ($request->header('Authorization')) {
            $user = JWTAuth::setRequest($request)->parseToken()->authenticate();

            if (isset($userFacebook) && $user->id != $userFacebook->id) {
                return response()->json(['message' => 'Ce compte Facebook est déjà rattaché au profil de '.$userFacebook->prenom.' '.$userFacebook->nom], 409);
            }
        }
        // Step 3b. Create a new user account or return an existing one.
        else {
            if (!$userFacebook) {
                $user = new User;
            }
            else {
                $user = $userFacebook;
            }
        }

        $user->facebook_id = $profile['id'];
        $user->facebook_link = $profile['link'];
        $user->email = $user->email ?: $profile['email'];
        $user->sexe = $user->sexe ?: $profile['gender'];
        $user->prenom = $user->prenom ?: $profile['first_name'];
        $user->nom = $user->nom ?: $profile['last_name'];
        $user->save();

        return response()->json(['token' => JWTAuth::fromUser($user)]);
    }

    /**
     * Login with Google.
     */
    public function google(Request $request)
    {
        $client = new GuzzleHttp\Client();

        $params = [
            'code' => $request->input('code'),
            'client_id' => $request->input('clientId'),
            'client_secret' => Config::get('app.google_secret'),
            'redirect_uri' => $request->input('redirectUri'),
            'grant_type' => 'authorization_code',
        ];

        // Step 1. Exchange authorization code for access token.
        $accessTokenResponse = $client->request('POST', 'https://accounts.google.com/o/oauth2/token', [
            'form_params' => $params
        ]);
        $accessToken = json_decode($accessTokenResponse->getBody(), true);

        // Step 2. Retrieve profile information about the current user.
        $profileResponse = $client->request('GET', 'https://www.googleapis.com/plus/v1/people/me/openIdConnect', [
            'headers' => array('Authorization' => 'Bearer ' . $accessToken['access_token'])
        ]);
        $profile = json_decode($profileResponse->getBody(), true);

        // Step 3a. If user is already signed in then link accounts.
        if ($request->header('Authorization'))
        {
            $user = User::where('google', '=', $profile['sub']);

            if ($user->first())
            {
                return response()->json(['message' => 'There is already a Google account that belongs to you'], 409);
            }

            $token = explode(' ', $request->header('Authorization'))[1];
            $payload = (array) JWT::decode($token, Config::get('app.token_secret'), array('HS256'));

            $user = User::find($payload['sub']);
            $user->google = $profile['sub'];
            $user->displayName = $user->displayName ?: $profile['name'];
            $user->save();

            return response()->json(['token' => JWTAuth::fromUser($user)]);
        }
        // Step 3b. Create a new user account or return an existing one.
        else
        {
            $user = User::where('google', '=', $profile['sub']);

            if ($user->first())
            {
                return response()->json(['token' => $this->createToken($user->first())]);
            }

            $user = new User;
            $user->google = $profile['sub'];
            $user->displayName = $profile['name'];
            $user->save();

            return response()->json(['token' => JWTAuth::fromUser($user)]);
        }
    }

    /**
     * Unlink provider.
     */
    public function unlink(Request $request)
    {
        $provider = $request->input('provider');
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé']);
        }

        if ($provider == 'google') {
            $user->google_id = null;
        }
        elseif ($provider == 'facebook') {
            $user->facebook_id = null;
            $user->facebook_link = null;
        }

        $user->save();
        
        return response()->json(['token' => JWTAuth::fromUser($user)]);
    }
}
