app.controller('PageController',
    ['$scope', '$http', '$routeParams', 'user',
        function($scope, $http, $routeParams, user){
            var ctrl= this;
            ctrl.slug = $routeParams.slug;

            $scope.user = user;

            $http.get('/api/v1/page/'+ctrl.slug).then(
                function(success){
                    ctrl.title = success.data.title;
                    ctrl.last_revision = success.data.revisions[success.data.revisions.length - 1];
                },
                function(error){
                    console.log(error);
                }
            );
        }
    ]
);