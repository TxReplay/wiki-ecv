var app = angular.module("WikiApp", ["ngRoute", "ngResource"]);

app.config(['$routeProvider', function($routeProvider){
    $routeProvider.
    when('/', {
        templateUrl: '/templates/index.html',
        controller: "FrontController",
        controllerAs: 'ctrl',
        title: 'homepage'
    }).
    when('/search', {
        templateUrl: 'templates/index.html',
        controller: "SearchController",
        controllerAs: 'ctrl',
        title: 'Recherche'
    }).
    when('/page/new', {
        templateUrl: 'templates/page/new_page.html',
        controller: "NewController",
        controllerAs: 'ctrl',
        title: 'Nouvel page'
    }).
    when('/page/:slug', {
        templateUrl: 'templates/page/page.html',
        controller: "PageController",
        controllerAs: 'ctrl',
        title: 'Page précise'
    }).
    when('/page/:slug/edit', {
        templateUrl: 'templates/index.html',
        controller: "EditController",
        controllerAs: 'ctrl',
        title: 'Modifié page'
    }).
    when('/page/:slug/history', {
        templateUrl: 'templates/index.html',
        controller: "HistoryController",
        controllerAs: 'ctrl',
        title: 'Historique page'
    }).
    when('/inscription', {
        templateUrl: 'templates/page/inscription.html',
        controller: "InscriptionController",
        controllerAs: 'ctrl',
        title: 'Inscription'
    })
}]);

app.run(['$rootScope', '$route', function($rootScope, $route) {
    $rootScope.$route = $route;
    $rootScope.$on('$routeChangeSuccess', function() {
        // Si on veux faire des trucs au changement de page
    });
}]);

// DIRECTIVE

app.directive('header', ['$http', '$window', function($http, $window){
    return {
        restrict: 'EA',
        scope: {
            myVar: '=myVar'
        },
        templateUrl: '/templates/bases/header.html',
        link: function($scope, element, attrs) {
            console.log($scope.myVar)
        }
    }
}]);

app.directive('footer', ['$http', function($http){
    return {
        restrict: 'EA',
        templateUrl: '/templates/bases/footer.html'
    }
}]);

app.directive('titre', ['$http', function($http){
    return {
        restrict: 'EA',
        templateUrl: '/templates/bases/title.html'
    }
}]);

// END DIRECTIVE

app.factory("user",function(){
    return {};
});