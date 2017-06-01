app.controller('PageController',
    ['$scope', '$http', '$routeParams', '$location', 'user',
        function($scope, $http, $routeParams, $location, user){
            var ctrl= this;
            ctrl.slug = $routeParams.slug;

            $scope.user = user;

            ctrl.user = $scope.user.id;

            ctrl.option = {
                mode: null,
                availableOptions: [
                    {id: '1', name: '1'},
                    {id: '2', name: '2'},
                    {id: '3', name: '3'},
                    {id: '4', name: '4'},
                    {id: '5', name: '5'}
                ]
            };

            $http.get('/api/v1/page/'+ctrl.slug).then(
                function(success){
                    ctrl.title = success.data.title;
                    ctrl.last_revision = success.data.revisions[success.data.revisions.length - 1];
                    ctrl.id_revision = ctrl.last_revision.id;
                    ctrl.status = ctrl.last_revision.status;
                    ctrl.ratings = ctrl.last_revision.ratings;
                    if(ctrl.ratings.length){
                        var total = 0;
                        for(rate in ctrl.ratings){
                            total += ctrl.ratings[rate]['rating'];
                            if(ctrl.ratings[rate]['user']['id'] === ctrl.user){
                                ctrl.my_note = ctrl.ratings[rate]['rating'];
                                ctrl.no_custom_note = 0;
                            }
                        }
                        if(!ctrl.my_note){
                            ctrl.no_custom_note = 1;
                        }
                        ctrl.current_note = total/ctrl.ratings.length;
                    }else{
                        ctrl.no_custom_note = 1;
                        ctrl.current_note = 0;
                    }
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
            };

            ctrl.addNote = function(note){
                ctrl.nonote = 0;

                if(!note || note === '' || ctrl.user === ''){
                    ctrl.nonote = 1;
                }else{
                    var data = {
                        "user_id" : ctrl.user,
                        "rating" : note
                    };

                    var myJSON = JSON.stringify(data);

                    $http.post('/api/v1/page/'+ctrl.slug+'/revision/'+ctrl.id_revision+'/rate', myJSON).then(
                        function(success){
                            console.log(success);
                        }, function(error){
                            console.log(error);
                            ctrl.showerror = 1;
                            ctrl.message_error = error.data.message;
                        }
                    );
                }
            };

            ctrl.changeNote = function(note){
                ctrl.nonote = 0;

                if(!note || note === '' || ctrl.user === ''){
                    ctrl.nonote = 1;
                }else{
                    var data = {
                        "user_id" : ctrl.user,
                        "rating" : note
                    };

                    var myJSON = JSON.stringify(data);

                    $http.post('/api/v1/page/'+ctrl.slug+'/revision/'+ctrl.id_revision+'/rate', myJSON).then(
                        function(success){
                            console.log(success);
                        }, function(error){
                            console.log(error);
                            ctrl.showerror = 1;
                            ctrl.message_error = error.data.message;
                        }
                    );
                }
            };

            $scope.$watch(function(){return user;}, function(value, oldValue){
                if(oldValue !== value){
                    ctrl.user = value.id;
                    $http.get('/api/v1/page/'+ctrl.slug).then(
                        function(success){
                            ctrl.title = success.data.title;
                            ctrl.last_revision = success.data.revisions[success.data.revisions.length - 1];
                            ctrl.id_revision = ctrl.last_revision.id;
                            ctrl.status = ctrl.last_revision.status;
                            ctrl.ratings = ctrl.last_revision.ratings;
                            if(ctrl.ratings.length){
                                var total = 0;
                                for(rate in ctrl.ratings){
                                    total += ctrl.ratings[rate]['rating'];
                                    console.log(ctrl.ratings[rate]['user']['id']);
                                    console.log(ctrl.user);
                                    if(ctrl.ratings[rate]['user']['id'] === ctrl.user){
                                        ctrl.my_note = ctrl.ratings[rate]['rating'];
                                        ctrl.no_custom_note = 0;
                                    }
                                }
                                if(!ctrl.my_note){
                                    ctrl.no_custom_note = 1;
                                }
                                ctrl.current_note = total/ctrl.ratings.length;
                            }else{
                                ctrl.no_custom_note = 1;
                                ctrl.current_note = 0;
                            }
                        },
                        function(error){
                            console.log(error);
                        }
                    );
                }
            }, true);
        }
    ]
);