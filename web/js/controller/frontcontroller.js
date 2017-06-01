app.controller('FrontController',
    ['$scope', '$http', 'user',
        function($scope, $http, user){
            var ctrl = this;
            $scope.user = user;

            $http.get('/api/v1/page/last?limit=3&offset=1').then(
                function(success){
                    ctrl.pages = success.data;
                    console.log(ctrl.pages);
                },
                function(error){
                    console.log(error);
                }
            )

        }
    ]
);