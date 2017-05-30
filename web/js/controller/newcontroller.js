app.controller('NewController',
    ['$scope', '$http', '$location', 'user',
        function($scope, $http, $location, user){
            var ctrl = this;
            $scope.user = user;

            if(typeof $scope.user.id === 'undefined'){
                $location.path('/inscription');
            }

            ctrl.showerror = 0;
            ctrl.titre = "";
            ctrl.contenu = "";
            ctrl.id_user = $scope.user.id;

            ctrl.addPage = function(titre, contenu){
                // Reset erreur
                ctrl.error = 0;
                ctrl.notitre = 0;
                ctrl.nocontenu = 0;

                // Check erreur
                if(!titre || titre === ''){
                    ctrl.notitre = 1;
                    ctrl.error = 1;
                }
                if(!contenu || contenu === ''){
                    ctrl.nocontenu = 1;
                    ctrl.error = 1;
                }

                if(!ctrl.error){
                    var data = {
                        "title" : titre
                    };
                    var myJSON = JSON.stringify(data);

                    $http.post('/api/v1/page', myJSON).then(
                        function(success){
                            var data = {
                                "id_user" : ctrl.id_user,
                                "content" : contenu
                            };
                            var myJSON = JSON.stringify(data);

                            var save_slug = success.data.slug_page;
                            $http.post('/api/v1/page/'+success.data.slug_page+'/revision', myJSON).then(
                                function(success){
                                    $location.path('/page/'+save_slug);
                                }, function(error){
                                    console.log(error);
                                    ctrl.showerror = 1;
                                    ctrl.message_error = error.data.message;
                                }
                            );
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