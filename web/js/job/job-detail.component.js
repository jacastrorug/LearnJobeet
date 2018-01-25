'use strict'

angular.module('job').component('detailJob', {
    templateUrl: '/js/job/job-detail.template.html',
    controller: ['$http', '$routeParams',
        function detailJob($http, $routeParams) {
            var me = this;
            $http.get('/json?id='+$routeParams.index).then(function (response) {
                me.index = response.data;
            });
        }]
});