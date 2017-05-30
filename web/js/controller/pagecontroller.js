app.controller('PageController',
    ['$scope', '$http', '$routeParams', 'user',
        function($scope, $http, $routeParams, user){
            var ctrl= this;
            ctrl.slug = $routeParams.slug;

            $scope.user = user;

            ctrl.user = $scope.user.id;

            $http.get('/api/v1/page/'+ctrl.slug).then(
                function(success){
                    console.log(success);
                    ctrl.title = success.data.title;
                    ctrl.last_revision = success.data.revisions[success.data.revisions.length - 1];
                    ctrl.status = ctrl.last_revision.status;
                },
                function(error){
                    console.log(error);
                }
            );
        }
    ]
);