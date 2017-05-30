app.controller('PageController',
    ['$scope', '$http', '$routeParams', '$location', 'user',
        function($scope, $http, $routeParams, $location, user){
            var ctrl= this;
            ctrl.slug = $routeParams.slug;

            $scope.user = user;

            ctrl.user = $scope.user.id;

            $http.get('/api/v1/page/'+ctrl.slug).then(
                function(success){
                    ctrl.title = success.data.title;
                    ctrl.last_revision = success.data.revisions[success.data.revisions.length - 1];
                    ctrl.status = ctrl.last_revision.status;
                },
                function(error){
                    console.log(error);
                }
            );

            ctrl.removePage = function(){
                if(ctrl.user){ // Vérification si la personne est connecté
                    $http.delete('/api/v1/page/'+ctrl.slug).then(
                        function(success){
                            $location.path('/');
                        },
                        function(error){
                            console.log(error);
                        }
                    )
                }
            }
        }
    ]
);