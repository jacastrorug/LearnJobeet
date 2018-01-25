'user strict'
angular.module('jobeet').config(['$locationProvider', '$routeProvider',
    function config($locationProvider, $routeProvider) {
        $routeProvider.when('/', {
            template: '<list-job></list-job>'
        }).when('/category/:slug',{
            template: '<list-all></list-all>'
        }).when('/job/detail/:index',{
            template: '<detail-job></detail-job>'
        }).when('/job/newJob',{
            template: '<new-job></new-job>'
            }
        ).otherwise('/');
    }
]);