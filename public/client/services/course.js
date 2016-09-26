angular.module(appConfig.appName)
.factory('Course', function ($resource) {
	// return $resource('http://api.lekartautrement.com/courses/:id', {}, {
	return $resource(appConfig.apiPath+'/courses/:id', {}, {
		'query': {
			method: 'GET',
			// isArray:true
		},
		'get': {
			method: 'GET',
			transformResponse: function(data) {
				data = angular.fromJson(data);
				return data;
			}
		},
		'delete': {
			method: 'DELETE'
		}
	});
})
.factory('Circuit', function ($resource) {
	return $resource(appConfig.apiPath+'/circuits/:id', {}, {
		'query': {
			method: 'GET',
			// isArray:true
		},
		'get': {
			method: 'GET',
			transformResponse: function(data) {
				data = angular.fromJson(data);
				return data;
			}
		},
		'delete': {
			method: 'DELETE'
		}
	});
});