var app = angular.module('App', [
    'ngRoute',
]);

app.config(function ($routeProvider, $httpProvider) {


    $httpProvider.defaults.withCredentials = true;

    $routeProvider
    .when('/', {
        controller: 'MainCtrl',
        templateUrl: 'views/home.html'
    })
    .when('/user', {
        controller: 'UserCtrl',
        templateUrl: 'views/steps.html'
    })
    .otherwise({redirectTo: '/'});
});

app.run(function () {

});
