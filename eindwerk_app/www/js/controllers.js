angular.module('starter.controllers', [])

.controller('AppCtrl', function($scope, $ionicModal, $timeout) {
  // Form data for the login modal
  $scope.loginData = {};

  // Create the login modal that we will use later
  $ionicModal.fromTemplateUrl('templates/login.html', {
    scope: $scope
  }).then(function(modal) {
    $scope.modal = modal;
  });

  // Triggered in the login modal to close it
  $scope.closeLogin = function() {
    $scope.modal.hide();
  };

  // Open the login modal
  $scope.login = function() {
    $scope.modal.show();
  };

  // Perform the login action when the user submits the login form
  $scope.doLogin = function() {
    console.log('Doing login', $scope.loginData);

    // Simulate a login delay. Remove this and replace with your login
    // code if using a login system
    $timeout(function() {
      $scope.closeLogin();
    }, 1000);
  };
})

.controller('PlaylistsCtrl', function($scope) {
  $scope.playlists = [
    { title: 'Reggae', id: 1 },
    { title: 'Chill', id: 2 },
    { title: 'Dubstep', id: 3 },
    { title: 'Indie', id: 4 },
    { title: 'Rap', id: 5 },
    { title: 'Cowbell', id: 6 }
  ];
})

.controller('StartCtrl', function($location) {
  if(window.localStorage.hasOwnProperty('username') && window.localStorage.hasOwnProperty('password'))
    {
        $location.path('/menu/playlists');
    }
})

.controller('PlaylistCtrl', function($scope, $stateParams) {
})

.controller('RegisterCtrl', function($scope, $stateParams,$timeout,$location) {

  $scope.registerData = {};
  $scope.doRegister = function() {
      //controlleren of alle velden zijn ingevuld
      var isValid = true;
      var usernameEl = document.querySelector( '.item-username' );
      var passwordEl = document.querySelector( '.item-password' );
      //remove red from input fields
      angular.element(usernameEl).removeClass('error');
      angular.element(passwordEl).removeClass('error');
      if(!$scope.registerData.hasOwnProperty('username'))
      {
        isValid = false;
        angular.element(usernameEl).addClass('shake'); 
        angular.element(usernameEl).addClass('animated'); 
        angular.element(usernameEl).addClass('error'); 
        $timeout(function() {
          angular.element(usernameEl).removeClass('shake');
          angular.element(usernameEl).removeClass('animated');
         },700);
      }

      if(!$scope.registerData.hasOwnProperty('password'))
      {
        isValid = false;
        angular.element(passwordEl).addClass('shake'); 
        angular.element(passwordEl).addClass('animated'); 
        angular.element(passwordEl).addClass('error'); 
        $timeout(function() {
          angular.element(passwordEl).removeClass('shake');
          angular.element(passwordEl).removeClass('animated');
         },700);
      }

      if(isValid)
      {
        window.localStorage['username'] = $scope.registerData.username;
        window.localStorage['password'] = $scope.registerData.password;
        $location.path('/location');
      }
  };
})
.controller('LocationCtrl', function($scope, $stateParams,$timeout,$location) {

  $scope.locationData = {};
  $scope.schools = [
                      { name :'Karel De Grote , groenplaats'},
                      { name :'Karel De Grote , hoboken'},
                      { name :'Thomas More'},
                      { name :'Universiteit antwerpen'},
                      { name :'lessius'}
                    ];
  $scope.schools.sort();          
  $scope.doSave = function() {
      //controlleren of alle velden zijn ingevuld
      var isValid = true;
      var schoolEl = document.querySelector( '.item-school' );
      var pricedEl = document.querySelector( '.item-price' );
      //remove red from input fields
      angular.element(schoolEl).removeClass('error');
      angular.element(pricedEl).removeClass('error');
      if(!$scope.locationData.hasOwnProperty('school'))
      {
        isValid = false;
        
        angular.element(schoolEl).addClass('shake'); 
        angular.element(schoolEl).addClass('animated'); 
        angular.element(schoolEl).addClass('error'); 
        $timeout(function() {
          angular.element(schoolEl).removeClass('shake');
          angular.element(schoolEl).removeClass('animated');
         },700);
      }

      if(!$scope.locationData.hasOwnProperty('price'))
      {
        isValid = false;
        
        angular.element(pricedEl).addClass('shake'); 
        angular.element(pricedEl).addClass('animated'); 
        angular.element(pricedEl).addClass('error'); 
        $timeout(function() {
          angular.element(pricedEl).removeClass('shake');
          angular.element(pricedEl).removeClass('animated');
         },700);
      }

      if(isValid)
      {
        window.localStorage['school'] = $scope.locationData.school;
        window.localStorage['price'] = $scope.locationData.price;
        $location.path('/menu/playlists');
      }
  };
});
