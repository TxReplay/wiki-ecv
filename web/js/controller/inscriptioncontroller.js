app.controller('InscriptionController',
    ['$scope', '$http', '$location', 'user',
        function($scope, $http, $location, user){
            var ctrl= this;

            $scope.user = user;
            // and then set values on the object
            $scope.user.firstname = "John";
            $scope.user.secondname = "Smith";

            ctrl.username = "";
            ctrl.mail = "";
            ctrl.password = "";
            ctrl.repeat = "";

            ctrl.inscription = function(username, email, password, verification){
                // Reset erreur
                ctrl.showerror = 0;
                ctrl.nousername = 0;
                ctrl.wrongmail = 0;
                ctrl.nopass = 0;
                ctrl.wrongpass = 0;
                ctrl.error = 0;

                ctrl.user = 'Test';
                ctrl.error = 1;

                // Check erreur
                if(!username || username === ''){
                    ctrl.nousername = 1;
                    ctrl.error = 1;
                }
                if(!email.match(/[a-z0-9_\-\.]+@[a-z0-9_\-\.]+\.[a-z]+/i)) {
                    ctrl.wrongmail = 1;
                    ctrl.error = 1;
                }
                if(!password || password === ''){
                    ctrl.nopass = 1;
                    ctrl.error = 1;
                }else{
                    if(password !== verification){
                        ctrl.wrongpass = 1;
                        ctrl.error = 1;
                    }
                }

                // Inscription
                if(!ctrl.error){
                    var data = {
                        "username" : username,
                        "email" : email,
                        "password" : password
                    };
                    var myJSON = JSON.stringify(data);

                    $http.post('/api/v1/user/register', myJSON).then(
                        function(success){
                            $location.path('/');
                        }, function(error){
                            ctrl.showerror = 1;
                            ctrl.message_error = error.data.message;
                        }
                    );
                }
            };
        }
    ]
);