var app = angular.module('App', [
    'ngRoute',
    'ApiConnect',
]);

app.config(function ($routeProvider, $httpProvider) {

    $httpProvider.defaults.withCredentials = false;

    $routeProvider
    .when('/', {
        controller: 'MainCtrl',
        templateUrl: 'views/home.html'
    })
    .when('/user', {
        controller: 'UserCtrl',
        templateUrl: 'views/steps.html'
    })
    .when('/step-1', {
        controller: 'UserCtrl',
        templateUrl: 'views/steps.html'
    })
    .otherwise({redirectTo: '/'});
});

app.run([
  '$rootScope',
  function ($rootScope) {
    $rootScope.api_url = "http://enade.maxlima.net/api";
    $rootScope.client_url = "http://enade.maxlima.net/client/";


}]);
