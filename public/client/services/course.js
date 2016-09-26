angular.module(appConfig.appName)
.factory('Course', function ($resource) {
	return $resource(appConfig.apiPath+'/courses/:id', {}, {
		'query': {
			method: 'GET',
			isArray:true,
			transformResponse: function(data) {
				data = angular.fromJson(data).courses;
				return data;
			}
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
			isArray:true,
			transformResponse: function(data) {
				data = angular.fromJson(data).circuits;
				return data;
			}
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
.factory('Saison', function ($resource) {
	return $resource(appConfig.apiPath+'/saisons/:id', {}, {
		'query': {
			method: 'GET',
			isArray:true,
			transformResponse: function(data) {
				data = angular.fromJson(data).saisons;
				return data;
			}
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
.factory('Trophee', function ($resource) {
	return $resource(appConfig.apiPath+'/trophees/:id', {}, {
		'query': {
			method: 'GET',
			isArray:true,
			transformResponse: function(data) {
				data = angular.fromJson(data).trophees;
				return data;
			}
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