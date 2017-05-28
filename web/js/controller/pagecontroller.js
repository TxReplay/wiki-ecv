app.controller('PageController',
    ['$scope', '$http', '$routeParams',
        function($scope, $http, $routeParams){
            var ctrl= this;
            ctrl.slug = $routeParams.slug;

            // yolo
        }
    ]
);
