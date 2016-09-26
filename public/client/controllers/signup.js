angular.module(appConfig.appName)
.controller('SignupCtrl', function($scope, $location, $auth, toastr) {
  $scope.signup = function() {
    $auth.signup($scope.user)
      .then(function(response) {
        $auth.setToken(response);
        $location.path('/');
        toastr.info('Votre compte a été créé et vous êtes connecté');
      })
      .catch(function(response) {
        toastr.error(response.data.message);
      });
  };
});