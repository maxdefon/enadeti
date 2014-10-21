describe('angular-simple controllers', function() {
  describe('MainCtrl', function(){
    beforeEach(module('App'));
          
    beforeEach(inject(function($controller) {
      scope = {};
      ctrl = $controller('MainCtrl', {$scope:scope});
    }));
    
     it('Verifica se o controller Main esta definido',inject(function($controller) {
       expect(ctrl).toBeDefined();
     }));
      
//    it('"users precisa estar com 7 usuários', inject(function($controller) {
//      expect(scope.users.length).toBe(7);
//    }));
     


    it('O valor default do select de usuários dever ser por id', function() {
      expect(scope.orderProp).toBe('id');
    });
   
  });
});
