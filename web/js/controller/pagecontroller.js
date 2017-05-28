app.controller('PageController',
    ['$scope', '$http', '$routeParams',
        function($scope, $http, $routeParams){
            var ctrl= this;
            ctrl.slug = $routeParams.slug;

            $http.get('/api/v1/page/'+ctrl.slug).then(
                function(success){
                    console.log(success.data);
                },
                function(error){
                    console.log(error);
                }
            );
        }
    ]
);