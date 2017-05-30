app.controller('EditController',
    ['$scope', '$http', '$routeParams', '$location', 'user',
        function($scope, $http, $routeParams, $location, user){
            var ctrl= this;
            ctrl.slug = $routeParams.slug;
            $scope.user = user;

            if(typeof $scope.user.id === 'undefined'){
                $location.path('/inscription');
            }

            ctrl.title = "";
            ctrl.content = "";

            $http.get('/api/v1/page/'+ctrl.slug).then(
                function(success){
                    ctrl.title = success.data.title;
                    ctrl.id = success.data.id;
                    ctrl.last_revision = success.data.revisions[success.data.revisions.length - 1];
                    ctrl.content = ctrl.last_revision.content;
                    ctrl.save = ctrl.last_revision.content;
                },
                function(error){
                    console.log(error);
                }
            );

            ctrl.modification = function(content){
                // Init erreur
                ctrl.error = 0;
                ctrl.empty = 0;
                ctrl.nochange = 0;

                // Check erreur
                if(content === ''){
                    ctrl.empty = 1;
                    ctrl.error = 1;
                }
                if(content === ctrl.save){
                    ctrl.nochange = 1;
                    ctrl.error = 1;
                }

                if(!ctrl.error){
                    var data = {
                        "id_user" : $scope.user.id,
                        "content" : content
                    };
                    var myJSON = JSON.stringify(data);

                    $http.post('/api/v1/page/'+ctrl.slug+'/revision', myJSON).then(
                        function(success){
                            $location.path('/');
                        }, function(error){
                            console.log(error);
                            ctrl.showerror = 1;
                            ctrl.message_error = error.data.message;
                        }
                    );
                }
            }
        }
    ]
);
