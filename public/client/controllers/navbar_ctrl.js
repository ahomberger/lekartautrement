angular.module(appConfig.appName)
.controller('NavbarCtrl', function($scope, $auth) {
	$scope.isAuthenticated = function() {
	  return $auth.isAuthenticated();
	};
});