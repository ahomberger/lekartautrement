angular.module(appConfig.appName)
.controller('PiloteCtrl', function($scope, Pilote, $http, $auth) {
    $scope.liste = [];

    index();
    initStore();

    $scope.store = function () {
        var course = new Course();
        course.circuit = $scope.circuit;
        course.date = $scope.date;
        course.sens_inverse = $scope.sens_inverse;
        course.annulee = $scope.annulee;

        var courseData = angular.copy($scope.course);
        courseData.date = moment(courseData.date).format('YYYY-MM-DD hh:mm:ss');
        Course.updateProfile(userData)
        .then(function() {
          toastr.options.positionClass = "toast-top-center";
          toastr.success('Votre profil a été mis à jour');
          $scope.getProfile();
        })
        .catch(function(response) {
          toastr.error(response.data.message, response.status);
        });

        course.$save(function (data) {
            $scope.liste.push(data.course);
            initStore();
        });
    }

    $scope.destroy = function (index) {
        angular.forEach($scope.liste, function (value, key) {
          if($scope.liste.indexOf(value) === index) {
            Course.delete({id: value.id}, function () {
                $scope.liste.splice(index, 1);    
            });
          }
        });
    }

    $scope.isAdmin = function() {
        return $auth.isAuthenticated();
    };

    function index() {
        $scope.liste = Course.query();
    }

    function initStore() {
        $scope.circuit = "";
        $scope.date = "";
        $scope.sens_inverse = false;
        $scope.annulee = false;
        $scope.circuits = Circuit.query();
    }
});