angular.module(appConfig.appName)
.factory('User', function($http) {
  return {
    getProfile: function() {
      return $http.get(appConfig.apiPath+'/user/profile');
    },
    updateProfile: function(profileData) {
      return $http.put(appConfig.apiPath+'/user/profile', profileData);
    },
    updatePassword: function(passwordData) {
      return $http.put(appConfig.apiPath+'/user/password', passwordData);
    },
    setPassword: function(passwordData) {
      return $http.post(appConfig.apiPath+'/user/password', passwordData);
    }
  };
});