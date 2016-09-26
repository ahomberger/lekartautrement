<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use Validator;
use Config;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Dingo\Api\Exception\ValidationHttpException;

class UserController extends Controller {
    /**
     * Get signed in user's profile.
     */
    public function getUser() {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return $this->response->error('Utilisateur non trouvé', 404);
        }

        return response()->json($user->toArray());
    }

    /**
     * Update signed in user's profile.
     */
    public function updateUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'sexe' => 'required|alpha',
            'prenom' => 'required|alpha',
            'nom' => 'required|alpha',
            'date_naissance' => 'required|date|before:now',
            'num_licence' => 'numeric|min:10',
            'num_licence' => 'numeric|min:10',
            'num_transpondeur' => 'numeric|min:10',
            'tel_fixe' => 'numeric|min:10',
            'tel_port' => 'numeric|min:10',
            'pilote' => 'digits:1'
        ]);

        if ($validator->fails()) {
            return $this->response->error($validator->messages(), 400);
        }

        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return $this->response->error('Utilisateur non trouvé', 404);
        }
        else {
            $user->sexe = $request->input('sexe');
            $user->prenom = $request->input('prenom');
            $user->nom = $request->input('nom');
            $user->date_naissance = $request->input('date_naissance');
            $user->num_licence = $request->input('num_licence');
            $user->num_licence_tuteur = $request->input('num_licence_tuteur');
            $user->num_transpondeur = $request->input('num_transpondeur');
            $user->tel_fixe = $request->input('tel_fixe');
            $user->tel_port = $request->input('tel_port');
            $user->pilote = $request->input('pilote');
            $user->save();

            return response()->json(['token' => JWTAuth::fromUser($user)]);
        }
    }

    /**
     * Update password of signed in user's profile.
     */
    public function updatePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 401);
        }

        $user = JWTAuth::parseToken()->authenticate();

        if (Hash::check($request->input('old_password'), $user->password)) {
            $user->password = $request->input('new_password');;
            $user->save();

            return response()->json(['token' => JWTAuth::fromUser($user)]);
        }
        else {
            return response()->json(['message' => 'L\'ancien mot de passe est incorrect'], 401);
        }
    }

    /**
     * Set password of signed in user's profile.
     */
    public function setPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 401);
        }

        $user = JWTAuth::parseToken()->authenticate();
        $user->password = $request->input('new_password');;
        $user->save();

        return response()->json(['token' => JWTAuth::fromUser($user)]);
    }

    public function pilotes() {
        try {
            $pilotes = User::where('pilote', 1)
                ->select('nom','prenom')
                ->get()->toArray();
            return response()->json($pilotes);
        }
            catch(Exception $e) {
            return response()->json(['message' => 'Echec de récupération'], 404);
        }
    }
}