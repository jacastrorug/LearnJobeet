'use strict';

angular.
module('list').
component('listJob', {
        templateUrl: '/js/list/list.template.html',
        controller: function listJob($http) {
            var me = this;
            $http.get('/json').then(function(response) {
                me.info = response.data;
            });
        }

});
//<list-job></list-job>