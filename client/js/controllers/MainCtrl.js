app.controller('MainCtrl', [
    '$scope',
    '$http',
    '$rootScope',
    'ApiConnectService',
    '$location',

    function($scope, $http, $rootScope, ApiConnectService, $location) {
      console.log($rootScope.api_url);
      $scope.error_login = false;
      $scope.login_empty = false;
      $scope.user_logged = false;

      if(localStorage.user_logged == '1'){
        $scope.user_logged = true;
      }

      $scope.logout = function(){
        $rootScope.user = "";
        localStorage.setItem("user", "");
        localStorage.setItem("user_logged", "0");
        $location.path('user');
      }

      $scope.login = function(){
          $scope.error_login = false;
          $scope.login_empty = false;

          function handleSuccess(response) {
              console.log(response);
              if(response === "null"){
                 $scope.error_login = true;
              }else{
                 $location.path('user');
                 $rootScope.user = response;
                 localStorage.setItem("user", response.user_id);
                 localStorage.setItem("user_logged", "1");
              }
          }
          function handleError(response) {
              // console.log(response);
          }
          params = {email:$scope.email, password:$scope.password}
          if(typeof $scope.email != 'undefined' && typeof $scope.password != 'undefined'){
            var promise = ApiConnectService.connect('get',
             'user', params );
            promise
            .then(handleSuccess, handleError);
          }else{
            $scope.login_empty = true;
          }

        }

    }
]);
