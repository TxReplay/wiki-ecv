app.controller('PageController',
    ['$scope', '$http', '$routeParams',
        function($scope, $http, $routeParams){
            var ctrl= this;
            ctrl.slug = $routeParams.slug;

            $http.get('/api/v1/page/'+ctrl.slug).then(
                function(success){
                    console.log(success);
                },
                function(error){
                    console.log(error);
                }
            );

            /*var myObj = {"title":"TEST2"};
            var myJSON = JSON.stringify(myObj);

            $http.post('/api/v1/page', myJSON).then(
                function(response){
                    console.log(response);
                }, function(response){
                    console.log(response);
                }
            );*/
        }
    ]
);