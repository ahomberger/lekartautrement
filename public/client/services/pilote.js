angular.module(appConfig.appName)
.factory('Pilote', function ($resource) {
	return $resource('/api/v1/pilotes/:id', {}, {
		'query': {
			method: 'GET',
			isArray:true
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