app.controller('RevisionController',
    ['$scope', '$http', '$routeParams', '$location', 'user',
        function($scope, $http, $routeParams, $location, user){
            var ctrl= this;
            ctrl.slug = $routeParams.slug;
            ctrl.id_revision = $routeParams.id;

            $scope.user = user;

            ctrl.user = $scope.user.id;
        }
    ]
);