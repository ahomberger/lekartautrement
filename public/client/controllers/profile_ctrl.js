angular.module(appConfig.appName)
.controller('ProfileCtrl', function($scope, $auth, toastr, User, $http) {

  toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }

  $scope.getProfile = function() {
    User.getProfile()
      .then(function(response) {
        $scope.user = response.data;
        if($scope.user.date_naissance) {
          $scope.user.date_naissance = new Date(response.data.date_naissance);
        }
        if ($scope.user.pilote == 1) {$scope.user.pilote = true; }
        else { $scope.user.pilote = false; }
        if ($scope.user.staff == 1) {$scope.user.staff = true; }
        else { $scope.user.staff = false; }
        if ($scope.user.admin == 1) {$scope.user.admin = true; }
        else { $scope.user.admin = false; }
      })
      .catch(function(response) {
        toastr.error(response.data.message, response.status);
      });
  };
  $scope.updateProfile = function() {
    var userData = angular.copy($scope.user);
    userData.date_naissance = moment(userData.date_naissance).format('YYYY-MM-DD');
    if (userData.pilote == true) { userData.pilote = 1; }
    else { userData.pilote = 0; }

    User.updateProfile(userData)
      .then(function() {
        toastr.options.positionClass = "toast-top-center";
        toastr.success('Votre profil a été mis à jour');
        $scope.getProfile();
      })
      .catch(function(response) {
        toastr.error(response.data.message, response.status);
      });
  };
  $scope.updatePassword = function() {
    User.updatePassword($scope.password)
      .then(function() {
        toastr.success('Votre mot de passe a été mis à jour');
        $scope.passwordForm.$setPristine();
        $scope.passwordForm.$setUntouched();
        delete $scope.password;
      })
      .catch(function(response) {
        toastr.error(response.data.message, response.status);
      });
  };
  $scope.setPassword = function() {
    User.setPassword($scope.newPassword)
      .then(function() {
        toastr.success('Votre mot de passe a été créé');
        $scope.newPasswordForm.$setPristine();
        $scope.newPasswordForm.$setUntouched();
        delete $scope.newPassword;
        $scope.user.has_password=true;
      })
      .catch(function(response) {
        toastr.error(response.data.message, response.status);
      });
  };
  $scope.link = function(provider) {
    $auth.link(provider)
      .then(function(data) {
        toastr.success('Ajout de la liaison ' + provider + ' à votre profil');
        $scope.getProfile();
      })
      .catch(function(response) {
        // console.log(response.data);
        toastr.error(response.data.message, response.status);
      });
  };
  $scope.unlink = function(provider) {
    // $auth.unlink(provider)
    $http.put('/auth/unlink', {'provider': provider})
      .then(function(data) {
        toastr.info('Retrait de la liaison ' + provider + ' de votre profil');
        $scope.getProfile();
      })
      .catch(function(response) {
        toastr.error(response.data ? response.data.message : 'Impossible de retirer la liaison ' + provider + ' de votre profil', response.status);
      });
  };

  $scope.today = function() {
    $scope.today = new Date();
  };

  $scope.today();
  $scope.getProfile();
});
