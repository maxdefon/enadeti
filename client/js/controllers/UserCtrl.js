app.controller('UserCtrl', [
    '$scope',
    '$rootScope',
    '$location',
    'ApiConnectService',

      function($scope, $rootScope, $location, ApiConnectService) {

        $("body").removeClass("modal-open");
        $(".modal-backdrop").remove();

         $('#step-0').removeClass('box-next');

         if(localStorage.user_logged == '1'){
            $scope.user_logged = true;
         } else {
           $location.path('/');
           return;
         }

          $scope.logout = function(){
            $.get('/api/logout');
            $rootScope.user_logged = false;
            localStorage.setItem("user_logged", "0");
            alert("Volte sempre!");
            $location.path('/');
          }

          $scope.scroll = function(id){
            $('.step-'+id+'').addClass('check-step');
            $('#step-'+id+'').animatescroll();
            params ={step_id:id, user_id: localStorage.user_id}
            function handleSuccess(response) {
              console.log(response);
            }
            function handleError(response) {
              console.log(response);
            }
            var promise = ApiConnectService.connect('post',
               'checklist',params);
            promise.then(handleSuccess, handleError);
          }

          $scope.getSteps = function(fun){
              $('.box-step-1').removeClass('box-next');
              function handleSuccess(response) {
                $scope.steps=response;
                $scope.last_step = $scope.steps.pop();
                fun();
              }
              function handleError(response) {
              }
              var promise = ApiConnectService.connect('get',
                 'steps' );
              promise.then(handleSuccess, handleError);
          }

          $scope.getSteps(getCheckSteps);

          function getCheckSteps(){
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

    }
]);
