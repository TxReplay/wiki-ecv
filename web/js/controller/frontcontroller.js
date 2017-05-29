app.controller('FrontController',
    ['$scope', '$http', 'user',
        function($scope, $http, user){
            $scope.user = user;
            console.log($scope);
        }
    ]
);