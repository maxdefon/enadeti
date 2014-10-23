app.controller('UserCtrl', [
    '$scope',
    '$rootScope',
    '$location',

    function($scope, $rootScope, $location) {
            console.log(localStorage.user);
           if(typeof localStorage.user_logged == 'undefined' || localStorage.user_logged != '1'){
              $location.path('/');
            }
    }
]);
