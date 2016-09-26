angular.module(appConfig.appName, ['ngResource', 'ngMessages', 'ngAnimate', 'ui.router', 'ui.bootstrap', 'satellizer', 'toastr'])
// angular.module(appConfig.appName, ['ngResource', 'ngMessages', 'ngAnimate', 'toastr', 'ui.router', 'ui.bootstrap','satellizer', 'datePicker'])
.config(function($stateProvider, $urlRouterProvider, $authProvider, toastrConfig) {     
    $stateProvider
        .state('home', {
            url: '/',
            controller: 'HomeCtrl',
            templateUrl: 'client/partials/home.html'
        })
        .state('login', {
            url: '/login',
            templateUrl: 'client/partials/login.html',
            controller: 'LoginCtrl',
            resolve: {
                skipIfLoggedIn: skipIfLoggedIn
            }
        })
        .state('signup', {
            url: '/signup',
            templateUrl: 'client/partials/signup.html',
            controller: 'SignupCtrl',
            resolve: {
                skipIfLoggedIn: skipIfLoggedIn
            }
        })
        .state('logout', {
            url: '/logout',
            template: null,
            controller: 'LogoutCtrl'
        })
        .state('profile', {
            url: '/profile',
            templateUrl: 'client/partials/profile.html',
            controller: 'ProfileCtrl',
            resolve: {
                loginRequired: loginRequired
            }
        })
        .state('categorie_x30', {
            url: '/categorie/x30',
            templateUrl: 'client/partials/categorie_x30.html'
        })
        .state('pilotes', {
            url: '/pilotes',
            templateUrl: 'client/partials/pilotes.html',
            controller: 'PiloteCtrl'
        })
        .state('circuits', {
            url: '/circuits',
            templateUrl: 'client/partials/circuits.html',
            controller: 'CircuitCtrl'
        })
        .state('courses', {
            url: '/courses',
            templateUrl: 'client/partials/courses.html',
            controller: 'CourseCtrl'
        });

    $urlRouterProvider.otherwise('/');

    // ============ Satellizer ============
    $authProvider.facebook({ clientId: appConfig.facebookClientId });
    $authProvider.google({ clientId: appConfig.googleClientId });
	$authProvider.baseUrl = appConfig.apiPath;
	$authProvider.loginUrl = appConfig.loginUrl;
	$authProvider.signupUrl = appConfig.signupUrl;
	$authProvider.unlinkUrl = appConfig.unlinkUrl;

    function skipIfLoggedIn($q, $auth) {
    var deferred = $q.defer();
        if ($auth.isAuthenticated()) {
            deferred.reject();
        }
        else {
            deferred.resolve();
        }
        return deferred.promise;
    }

    function loginRequired($q, $location, $auth) {
        var deferred = $q.defer();
        if ($auth.isAuthenticated()) {
            deferred.resolve();
        }
        else {
            $location.path('/login');
        }
        return deferred.promise;
    }

    // angular.extend(toastrConfig, {
    //     autoDismiss: false,
    //     containerId: 'toast-container',
    //     maxOpened: 0,    
    //     newestOnTop: true,
    //     positionClass: 'toast-bottom-center',
    //     preventDuplicates: false,
    //     preventOpenDuplicates: true,
    //     target: 'body'
    //   });
});