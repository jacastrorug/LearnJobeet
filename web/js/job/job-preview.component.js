'use strict'

angular.module('job').component('previewJob', {
    templateUrl: '/js/job/job-preview.template.html',
    controller: ['$http', '$routeParams',
        function detailJob($http, $routeParams) {
            var me = this;
            $http.get('/json?id='+$routeParams.index).then(function (response) {
                me.index = response.data;
                me.index = me.index[0];
            });
        }]
});