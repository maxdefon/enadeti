describe('Angular-simple App', function() {

  describe('Main view', function() {

    beforeEach(function() {
      browser.get('index.html');
    });
    it('Filtrar a lista de usuários na busca', function() {

      var userList = element.all(by.repeater('user in users'));
      var query = element(by.model('query'));

      expect(userList.count()).toBe(7);

      query.sendKeys('Julie');
      expect(userList.count()).toBe(2);

      query.clear();
      query.sendKeys('Lee');
      expect(userList.count()).toBe(3);
      
      query.clear();
      query.sendKeys('John');
      expect(userList.count()).toBe(2);
    });
    
    it('Filtrar a lista de usuarios por ordem Alfabética', function() {

      var userFirstName = element.all(by.repeater('user in users').column('{{user.firstName}}'));
      var query = element(by.model('query'));

      function getNames() {
        return userFirstName.map(function(elm) {
          return elm.getText();
        });
      }

      element(by.model('orderProp')).element(by.css('option[value="firstName"]')).click();

      expect(getNames()).toEqual([
        "Eugene Lee",
        "James King",
        "John Williams",
        "John Lee",
        "Julie Taylor",
        "Julie Lee",
        "Ray Moore"
      ]);
    });
    
    it('Busca pelo usuário James click para ver detalhes e verifica se sua url esta correta', function() {
        
      var query = element(by.model('query'));
      query.sendKeys('James');
      element.all(by.css('.users li a')).first().click();
      browser.getLocationAbsUrl().then(function(url) {
        expect(url.split('#')[1]).toBe('/users/1');
      });
    });          
  });
  
  describe('Detalhes de usuários', function() {

    beforeEach(function() {
      browser.get('#/users/2');
    });


    it('Verifica se estar na pagina de user dois com firstName de Julie', function() {
      expect(element(by.binding('user.firstName')).getText()).toBe('Julie');
    });
  });
});
