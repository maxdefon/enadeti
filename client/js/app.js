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
    .otherwise({redirectTo: '/'});
});

app.run(function () {

});
