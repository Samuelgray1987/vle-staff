 angular.module('reports-services', []);
 /*
 *
 * Factories
 *
 */

angular.module('reports-services').factory("Classes", function($http, FlashService){
	var classesError = function(response){
		FlashService.show(response.flash);
	};
	return {
		myClasses: function() {
			var classes = $http.get("./staff/class/upn");
			classes.success(FlashService.clear);
			classes.error(classesError);
			return classes;
		},
		departmentClasses: function() {
			var classes = $http.get("./report/admin/hodclasses");
			classes.success(FlashService.clear);
			classes.error(classesError);
			return classes;
		},
		allClasses: function() {
			var classes = $http.get("./report/admin/allclasses");
			classes.success(FlashService.clear);
			classes.error(classesError);
			return classes;
		}
	}
});

angular.module('reports-services').factory("StartYeargroup", function($http, FlashService){
	return { 
		get: function() {
			var data = $http.get("./student-data/studentstartyear");
			data.success(FlashService.clear);
			data.error("Error retrieving class data.");
			return data;
		}
	}
});

angular.module('reports-services').factory("GetClassReports", function($resource, FlashService){
	return $resource('./report/classes', {}, {
		get: { method: 'POST', params: {}, isArray: true, 
						interceptor: { 
							response : function (data) {
								document.body.scrollTop = document.documentElement.scrollTop = 0;
								return data.data;
							},
							responseError: function(data)
							{	
								document.body.scrollTop = document.documentElement.scrollTop = 0;
								return data.data;
							}
						} 
	            }
	});
});

angular.module('reports-services').factory("GetDataEntries", function($resource, FlashService){
	return $resource('./attainment/entries', {}, {
		get: { method: 'GET', params: {}, isArray: true, 
						interceptor: { 
							response : function (data) {
								return data.data;
							},
							responseError: function(data)
							{	
								return data.data;
							}
						} 
	            }
	});
});

angular.module('reports-services').factory("GetAttainmentGraphData", function($resource, FlashService){
	return $resource('./attainment/results', {}, {
		get: { method: 'GET', params: {}, isArray: false, 
						interceptor: { 
							response : function (data) {
								return data.data;
							},
							responseError: function(data)
							{	
								return data.data;
							}
						} 
	            }
	});
});

angular.module('reports-services').factory("GetAttainmentTableData", function($resource, FlashService){
	return $resource('./attainment/resultstable', {}, {
		get: { method: 'GET', params: {}, isArray: false, 
						interceptor: { 
							response : function (data) {
								return data.data;
							},
							responseError: function(data)
							{	
								return data.data;
							}
						} 
	            }
	});
});

angular.module('reports-services').factory("InsertReportCard", function($resource, FlashService){
	return $resource('./reporting/insertcard', {}, {
		insert: { method: 'POST', params: {}, isArray: false, 
						interceptor: { 
							response : function (data) {
								return data.data;
							},
							responseError: function(data)
							{	
								return data.data;
							}
						} 
	            }
	});
});

angular.module('reports-services').factory("DeleteReportCard", function($resource, FlashService){
	return $resource('./reporting/deletecard', {}, {
		delete: { method: 'POST', params: {}, isArray: false, 
						interceptor: { 
							response : function (data) {
								return data.data;
							},
							responseError: function(data)
							{	
								return data.data;
							}
						} 
	            }
	});
});

angular.module('reports-services').factory("FlagReportCard", function($resource, FlashService){
	return $resource('./reporting/flagcard', {}, {
		post: { method: 'POST', params: {}, isArray: false, 
						interceptor: { 
							response : function (data) {
								return data.data;
							},
							responseError: function(data)
							{	
								return data.data;
							}
						} 
	            }
	});
});

angular.module('reports-services').factory("CompleteReportCard", function($resource, FlashService){
	return $resource('./reporting/completecard', {}, {
		post: { method: 'POST', params: {}, isArray: false, 
						interceptor: { 
							response : function (data) {
								return data.data;
							},
							responseError: function(data)
							{	
								return data.data;
							}
						} 
	            }
	});
});

angular.module('reports-services').factory("PrintOverview", function($resource, FlashService){
	return $resource('./reports-printing/printoverview', {}, {
		get: { method: 'GET', params: {}, isArray: false, 
						interceptor: { 
							response : function (data) {
								return data.data;
							},
							responseError: function(data)
							{	
								return data.data;
							}
						} 
	            }
	});
});

angular.module('reports-services').factory("PrintGenerate", function($resource, FlashService){
	return $resource('./reports-printing', {}, {
		get: { method: 'GET', params: {}, isArray: false, 
						interceptor: { 
							response : function (data) {
								return data.data;
							},
							responseError: function(data)
							{	
								return data.data;
							}
						} 
	            }
	});
});

angular.module('reports-services').factory("PrintAttainmentOptions", function($resource, FlashService){
	return $resource('./reports-printing/printattainmentoptions', {}, {
		get: { method: 'GET', params: {}, isArray: false, 
						interceptor: { 
							response : function (data) {
								return data.data;
							},
							responseError: function(data)
							{	
								return data.data;
							}
						} 
	            }
	});
});

angular.module('reports-services').factory("PrintStudentErrors", function($resource, FlashService){
	return $resource('./reports-printing/studenterrors', {}, {
		get: { method: 'GET', params: {}, isArray: false, 
						interceptor: { 
							response : function (data) {
								return data.data;
							},
							responseError: function(data)
							{	
								return data.data;
							}
						} 
	            }
	});
});
