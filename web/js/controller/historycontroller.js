app.controller('HistoryController',
    ['$scope', '$http', '$routeParams', 'user',
        function($scope, $http, $routeParams, user){
            var ctrl= this;
            ctrl.slug = $routeParams.slug;

            $scope.user = user;

            $http.get('/api/v1/page/'+ctrl.slug).then(
                function(success){
                    ctrl.revisions = success.data.revisions;
                },
                function(error){
                    console.log(error);
                }
            );

            $scope.$watch(function(){return user;}, function(value, oldValue){
                if(oldValue !== value){
                    ctrl.user = value.id;
                }
            }, true);
        }
    ]
);
