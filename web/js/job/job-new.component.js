'use strict'
angular.module('job').component('newJob', {
    templateUrl: '/js/job/job-new.template.html',
    controller: ['$http',
        function formJob($http) {
            this.isnew = true;
        }]
});

angular.module('job').component('editJob', {
    templateUrl: '/js/job/job-new.template.html',
    controller: ['$http', '$routeParams', '$scope',
        function formJob($http, $routeParams, $scope) {
            this.isnew = false;
            var me = this;
            $http.get('/json?id=' + $routeParams.index).then(function (response) {
                me.index = response.data;
                me.jobEdit = me.index[0];
                fun();
            });

            var fun = function () {
                var data = {
                    company: me.jobEdit['company'],
                    category: me.jobEdit['categoryId'],
                    type: me.jobEdit['type'],
                    url: me.jobEdit['url'],
                    position: me.jobEdit['position'],
                    location: me.jobEdit['location'],
                    description: me.jobEdit['description'],
                    howToApply: me.jobEdit['howToApply'],
                    isPublic: me.jobEdit['isPublic'],
                    email: me.jobEdit['email'],
                    id: me.jobEdit['id']
                };
                $scope.job = data;
            }
        }]
});

angular.module('job').controller('postJob', ['$scope', '$http', function ($scope, $http) {
    $scope.save = function (job) {
        console.log(job);
        $http({
            url: '/postJob',
            method: "POST",
            data: {
                'email': job.email,
                'category': job.category,
                'type': job.type,
                'company': job.company,
                'logo': job.logo,
                'url': job.url,
                'position': job.position,
                'location': job.location,
                'description': job.description,
                'howToApply': job.howToApply,
                'isPublic': job.isPublic
            }
        }).then(
            function (response) {
                console.log('Save Job Success');
                console.log(response.data);
                window.location.replace('#/job/detail/' + response.data.id);
            },
            function (response) {
                console.log('Save Job Error');
                console.log(response);
            });
    }

    $scope.edit = function (job) {
        console.log(job);
        $http({
            url: '/editJob',
            method: "POST",
            data: {
                'email': job.email,
                'category': job.category,
                'type': job.type,
                'company': job.company,
                'logo': job.logo,
                'url': job.url,
                'position': job.position,
                'location': job.location,
                'description': job.description,
                'howToApply': job.howToApply,
                'isPublic': job.isPublic,
                'id': job.id
            }
        }).then(
            function (response) {
                console.log('Edit Job Success');
                console.log(response.data);
                window.location.replace('#/job/detail/' + response.data.id);
            },
            function (response) {
                console.log('Edit Job Error');
                console.log(response);
            });
    }
}]);