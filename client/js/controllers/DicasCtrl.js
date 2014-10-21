app.controller('DicasCtrl', [
    '$scope',
    '$http',

    function($scope, $http) {
       $http.get('users/users.json')
               .success(function(data) {
                    $scope.users = data;
                });
       $scope.orderProp = 'id';
    }
]);
