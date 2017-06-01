app.controller('SearchController',
    ['$scope', '$http', 'user',
        function($scope, $http, user){
            var ctrl = this;
            $scope.user = user;
            ctrl.search = $scope.user.search;
            ctrl.query = $scope.user.query;

            $scope.$watch(function(){return user;}, function(value, oldValue){
                if(oldValue !== value){
                    ctrl.query = value.query;
                    ctrl.search = value.search;
                }
            }, true);
        }
    ]
);