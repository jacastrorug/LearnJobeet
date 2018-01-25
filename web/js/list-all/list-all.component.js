'use strict';

angular.module('listAll').
  component('listAll', {
    templateUrl: '/js/list-all/list-all.template.html',
    controller: ['$http','$routeParams',function listJob($http,$routeParams) {
        var me = this;
        $http.get('/json?slug='+$routeParams.slug).then(function (response) {
            me.data = response.data;
        });
    }]
});