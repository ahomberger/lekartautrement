angular.module(appConfig.appName)
.controller('AuthCtrl', function ($rootScope, $auth, $state, $http) {

    var vm = this;
    vm.loginError = false;
    vm.loginErrorText;
	
    vm.signup = function() {
        $auth.signup({email: vm.email, password: vm.password}).then(function (response) {
            // set the token received from server
            $auth.setToken(response);
            // go to secret page
            $state.go('course');
        }, function (response) {
            console.log("error response", response);
        });
    }

    vm.login = function () {
        var credentials = {
            email: vm.email,
            password: vm.password
        }

        $rootScope.authenticated = false;

        $auth.login(credentials)
            .then(function (response) {
                return $http.get('http://api.lekartautrement.com/auth');
            }, function (response) {
                vm.loginError = true;
                vm.loginErrorText = response.data.error;
            })
            .then(function (response) {
                console.log(response);
                $rootScope.authenticated = true;
                $rootScope.authenticatedUser = response.data.user;
                $state.go($rootScope.stateAfterLogin);
            });
    }

    vm.logout = function() {
        $auth.logout()
            .then(function() {
                $rootScope.authenticated = false;
                $rootScope.authenticatedUser = null;
            });
    }
});

// app.factory('User', function ($http) {
//     return {
//         get: function() {
//             $http.get('api/v1/auth')
//             .success(function (response) {
//                 return response.user;
//             });
//         }
        
//     }
// });