angular.module(appConfig.appName)
.controller('LogoutCtrl', function($location, $auth, toastr, $rootScope) {
	if (!$auth.isAuthenticated()) { return; }
	$auth.logout()
		.then(function() {
			toastr.info('Vous vous êtes déconnecté');
			$rootScope.authenticatedUser = null;
			$location.path('/');
		});
});