app.controller('FrontController',
    ['$scope', '$http', 'user',
        function($scope, $http, user){
            var ctrl = this;
            $scope.user = user;

            $http.get('/api/v1/page/last?limit=3&offset=1').then(
                function(success){
                    ctrl.pages = success.data;
                },
                function(error){
                    console.log(error);
                }
            );

            $http.get('/api/v1/page/best_rated?limit=3&offset=1').then(
                function(success){
                    ctrl.best_rated = success.data;
                },
                function(error){
                    console.log(error);
                }
            )

        }
    ]
);