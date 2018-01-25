'use strict'
angular.module('job').component('newJob', {
    templateUrl: '/js/job/job-new.template.html',
    controller: ['$http',
        function formJob($http) {

        }]
});


angular.module('job').controller('postJob', ['$scope', '$http', function ($scope, $http) {
    var me = this;
    $scope.save = function (job) {
        console.log(job.category);
        $http({
            url: '/postJob',
            method: "POST",
            data: {
                'category': job.category,
                'type': job.type,
                'company': job.company,
                'logo': job.logo,
                'url': job.url,
                'position': job.position,
                'location': job.location,
                'description': job.description,
                'howToApply': job.howToApply,
                'public': job.pub,
                'email': job.email
            }
        }).then(function (response) {
                console.log('Save Job Success');
                //window.location.replace('/');
            },
            function (response) {
                console.log('Save Job Error');
                console.log(response);
            });
    }
}]);