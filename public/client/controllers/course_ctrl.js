angular.module(appConfig.appName)
.controller('CourseCtrl', function($scope, Saison, Trophee, Course, Circuit, $http, $auth) {
    $scope.courses = [];

    index();
    initStoreCourse();

    $scope.store = function () {
        var course = new Course();
        course.circuit = $scope.circuit;
        course.date = $scope.date;
        course.sens_inverse = $scope.sens_inverse;
        course.annulee = $scope.annulee;

        var courseData = angular.copy($scope.course);
        courseData.date = moment(courseData.date).format('YYYY-MM-DD');
        Course.updateProfile(userData)
        .then(function() {
          toastr.options.positionClass = "toast-top-center";
          toastr.success('La course a été ajoutée');
          $scope.getProfile();
        })
        .catch(function(response) {
          toastr.error(response.data.message, response.status);
        });

        course.$save(function (data) {
            $scope.courses.push(data.course);
            initStoreCourse();
        });
    }

    $scope.destroy = function (index) {
        angular.forEach($scope.courses, function (value, key) {
          if($scope.courses.indexOf(value) === index) {
            Course.delete({id: value.id}, function () {
                $scope.courses.splice(index, 1);    
            });
          }
        });
    }

    $scope.isAdmin = function() {
        return $auth.isAuthenticated();
    };

    function index() {
        $scope.saisons = Saison.query();
        $scope.trophees = Trophee.query();
        $scope.circuits = Circuit.query();
        $scope.courses = Course.query();
    }

    function initStoreCourse() {
        $scope.circuit = "";
        $scope.date = "";
        $scope.sens_inverse = false;
        $scope.annulee = false;
        $scope.circuits = Circuit.query();
    }
});