app.controller('UserCtrl', [
    '$scope',
    '$http',

    function($scope, $http) {
       $http.get('http://192.168.1.2:8888/api/steps')
               .success(function(data) {
                    $scope.users = data;
                });
    }
]);
