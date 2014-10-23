app.controller('UserCtrl', [
    '$scope',
    '$rootScope',
    '$location',
    'ApiConnectService',

    function($scope, $rootScope, $location, ApiConnectService) {

          $('#step-0').removeClass('box-next');

         if(localStorage.user_logged == '1'){
            $scope.user_logged = true;
          }
         if(typeof localStorage.user_logged == 'undefined' || localStorage.user_logged != '1'){
            $location.path('/');
          }

          $scope.logout = function(){
            $rootScope.user = "";
            localStorage.setItem("user", "");
            localStorage.setItem("user_logged", "0");
            $location.path('#/');
            alert("Volte sempre!");
          }

          // $scope.steps= [{"step_id":"1","order":null,"title":null,"description":null,"step_order":"0"},{"step_id":"2","order":null,"title":null,"description":null,"step_order":"1"},{"step_id":"3","order":null,"title":null,"description":null,"step_order":"2"},{"step_id":"4","order":null,"title":"Se prepare","description":null,"step_order":"3"},{"step_id":"5","order":null,"title":null,"description":"Participe fazer (s) simulado (s) Realizado (s) na SUA Unidade "," step_order. ":" 4 "}, {" step_id ":" 6 "," ordem ": null," title ":" Atividades complementares","description":null,"step_order":"5"},{"step_id":"7","order":null,"title":null,"description":null,"step_order":"6"},{"step_id":"8","order":null,"title":"Responsabilidade","description":null,"step_order":"7"},{"step_id":"9","order":null,"title":"Final","description":null,"step_order":"8"}];

          $scope.scroll = function(id){
            $('.step-'+id+'').addClass('check-step');
            $('#step-'+id+'').animatescroll();
                 params ={step_id:id, user_id: localStorage.user}
                 function handleSuccess(response) {
                   console.log(response);
                 }
                 function handleError(response) {

                 }
                 var promise = ApiConnectService.connect('post',
                    'checklist',params);
                 promise.then(handleSuccess, handleError);


          }
          $scope.getSteps = function(){
              $scope.error_login = false;
              $scope.login_empty = false;
              $('.box-step-1').removeClass('box-next');
              function handleSuccess(response) {
                $scope.steps=response
                $scope.last_step = $scope.steps.pop();
              }
              function handleError(response) {

              }
              var promise = ApiConnectService.connect('get',
                 'steps' );
              promise.then(handleSuccess, handleError);


          }

          $scope.getSteps();

          $scope.getCheckSteps = function(){

              function handleSuccess(response) {
                console.log(response);
                $scope.checkSteps = response;
                for(var i in response){
                    $('.step-'+response[i].step_id+'').addClass('check-step');
                }
              }
              function handleError(response) {

              }
              var promise = ApiConnectService.connect('get',
                 'checklist' );
              promise.then(handleSuccess, handleError);


          }

          $scope.getCheckSteps();

    }
]);
