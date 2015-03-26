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

.controller('PlaylistsCtrl', function($scope,$http) {
  $http({method: "GET",url:'db/getkot.php'})
      .success(function(data, status, headers, config) {
        console.log(data);
    });
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
/*  if(window.localStorage.hasOwnProperty('username') && window.localStorage.hasOwnProperty('password'))
  {
      $location.path('/menu/playlists');
  }*/
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
        addError(usernameEl,$timeout);
      }

      if(!$scope.registerData.hasOwnProperty('password'))
      {
        isValid = false;
        addError(passwordEl,$timeout);
      }

      if(isValid)
      {
        var userdata = {
          username: $scope.registerData.username,
          password: $scope.registerData.password
        }
        window.localStorage['userdata'] = JSON.stringify(userdata);
        $location.path('/location');
      }
  };

  $scope.facebookRegister = function() {
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
          console.log('logind');
        }
        else {
          FB.login(function(){
            console.log('inloggen');
          },{scope: ['email']});
        }
      });
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
      var priceEl = document.querySelector( '.item-price' );
      //remove red from input fields
      angular.element(schoolEl).removeClass('error');
      angular.element(priceEl).removeClass('error');
      if(!$scope.locationData.hasOwnProperty('school'))
      {
        isValid = false;
        
        addError(schoolEl,$timeout);
      }

      if(!$scope.locationData.hasOwnProperty('price'))
      {
        isValid = false;
        
        addError(priceEl,$timeout);
      }

      if(isValid)
      {
        window.localStorage['school'] = $scope.locationData.school;
        window.localStorage['price'] = $scope.locationData.price;
        $location.path('/menu/playlists');
      }
  };
});

function addError(el,$timeout)
  {
    angular.element(el).addClass('shake'); 
    angular.element(el).addClass('animated'); 
    angular.element(el).addClass('error'); 
    $timeout(function() {
      angular.element(el).removeClass('shake');
      angular.element(el).removeClass('animated');
     },700);
  }
