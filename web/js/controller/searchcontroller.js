app.controller('SearchController',
    ['$scope', '$http', 'user',
        function($scope, $http, user){
            var ctrl = this;
            $scope.user = user;
        }
    ]
);