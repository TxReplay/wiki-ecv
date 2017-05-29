app.controller('PageController',
    ['$scope', '$http', '$routeParams',
        function($scope, $http, $routeParams){
            var ctrl= this;
            ctrl.slug = $routeParams.slug;

            $http.get('/api/v1/page/1').then(
                function(success){
                    console.log(success.data);
                },
                function(error){
                    console.log(error);
                }
            );

            $http({
                method: 'GET',
                url: '/api/v1/page/1'
            }).then(function successCallback(response) {
                console.log(response);
            }, function errorCallback(response) {
                console.log(response);
            });
        }
    ]
);