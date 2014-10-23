app.controller('MainCtrl', [
    '$scope',
    '$http',
    '$rootScope',
    'ApiConnectService',
    '$location',

    function($scope, $http, $rootScope, ApiConnectService, $location) {
      $scope.error_login = false;
      $scope.login_empty = false;
      $scope.user_logged = false;
      $scope.error_register = false;
      $scope.register_empty = false;

      if(localStorage.user_logged == '1'){
        $scope.user_logged = true;
      }

      $scope.logout = function(){
        $rootScope.user = "";
        localStorage.setItem("user", "");
        localStorage.setItem("user_logged", "0");
        window.location.reload();
        $location.path('/');

        alert("Volte sempre!");
      }

      $scope.login = function(){
          $scope.error_login = false;
          $scope.login_empty = false;

          function handleSuccess(response) {
              if(response === "null"){
                 $scope.error_login = true;
              }else{

                 $rootScope.user = response;
                 localStorage.setItem("user", response.user_id);
                 localStorage.setItem("user_logged", "1");
                 window.location.reload();
                 $location.path('/user');
              }
          }
          function handleError(response) {

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

      $scope.register = function(){
        $scope.error_register = false;
        $scope.register_empty = false;

        function handleSuccess(response) {

            if(response === "null"){
               $scope.error_login = true;
            }else{
               $rootScope.user = response;
               localStorage.setItem("user", response.user_id);
               localStorage.setItem("user_logged", "1");
               alert("cadastrado com sucesso!");
               window.location.reload();
               $location.path('user');

            }
        }
        function handleError(response) {
            // console.log(response);
        }
        params = {
                  email:$scope.email,
                  password:$scope.password,
                  registration: $scope.registration,
                  name: $scope.name
                  }
        if(typeof $scope.email != 'undefined' && typeof $scope.password != 'undefined' && typeof $scope.registration != 'undefined' && typeof $scope.name != 'undefined'){
          var promise = ApiConnectService.connect('post',
           'user', params );
          promise
          .then(handleSuccess, handleError);
        }else{
          $scope.register_empty = true;
        }
      }


    }
]);
