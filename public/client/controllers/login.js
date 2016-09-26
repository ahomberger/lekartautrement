angular.module(appConfig.appName)
.controller('LoginCtrl', function($scope, $location, $auth, toastr) {
  $scope.login = function() {
    $auth.login($scope.user)
      .then(function() {
        toastr.success('Vous êtes connecté !');
        $location.path('/');
      })
      .catch(function(error) {
        console.log(error);
        toastr.error(error.data.message, error.status);
      });
  };
  $scope.authenticate = function(provider) {
    $auth.authenticate(provider)
      .then(function(data) {
        toastr.success('Vous êtes connecté avec ' + provider + ' !');
        $location.path('/');
      })
      .catch(function(error) {
        if (error.error) {
          // Popup error - invalid redirect_uri, pressed cancel button, etc.
          toastr.error(error.error);
        }
        else if (error.data) {
          // HTTP response error from server
          toastr.error(error.data.message, error.status);
        }
        else {
          toastr.error(error);
        }
      });
  };
});
