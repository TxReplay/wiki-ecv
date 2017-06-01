app.controller('RevisionController',
    ['$scope', '$http', '$routeParams', '$location', 'user',
        function($scope, $http, $routeParams, $location, user){
            var ctrl= this;
            ctrl.slug = $routeParams.slug;
            ctrl.id_revision = $routeParams.id;

            $scope.user = user;

            ctrl.user = $scope.user.id;

            $http.get('/api/v1/page/'+ctrl.slug).then(
                function(success){
                    ctrl.title = success.data.title;
                    ctrl.nb_revision = success.data.revisions.length;
                },
                function(error){
                    console.log(error);
                }
            );

            $http.get('/api/v1/page/'+ctrl.slug+'/revision/'+ctrl.id_revision).then(
                function(success){
                    ctrl.content = success.data.content;
                    ctrl.author = success.data.update_by.username;
                    ctrl.status = success.data.status;
                },
                function(error){
                    console.log(error);
                }
            );

            ctrl.removeRevision = function(){
                ctrl.errorsupp = 0;
                if(ctrl.nb_revision <= 1){
                    ctrl.errorsupp = 1;
                }else{
                    if(ctrl.user){ // Vérification si la personne est connecté
                        $http.delete('/api/v1/page/'+ctrl.slug+'/revision/'+ctrl.id_revision).then(
                            function(success){
                                $location.path('/page/'+ctrl.slug+'/revision/');
                            },
                            function(error){
                                console.log(error);
                            }
                        )
                    }
                }
            }

            ctrl.setRevision = function(){
                var data = {
                    "id_user" : ctrl.user,
                    "content" : ctrl.content,
                    "status" : ctrl.status
                };

                var myJSON = JSON.stringify(data);

                $http.post('/api/v1/page/'+ctrl.slug+'/revision', myJSON).then(
                    function(success){
                        $location.path('/page/'+ctrl.slug);
                    }, function(error){
                        console.log(error);
                        ctrl.showerror = 1;
                        ctrl.message_error = error.data.message;
                    }
                );
            }
        }
    ]
);