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

    // Simulate a login delay. Remove this and replace with your login
    // code if using a login system
    $timeout(function() {
      $scope.closeLogin();
    }, 1000);
  };
})

.controller('MainKotCtrl', function($scope,$http,$window) {
  userdata = JSON.parse(window.localStorage['userdata']);
  $scope.change_image = function($event){
      console.log(document.getElementById('main_image'));
      console.log(angular.element(document.getElementById('main_image')).attr("src"));
      angular.element(document.getElementById('main_image')).attr("src", angular.element($event.target).attr('src'));
      
  };

  $http({method: "post",dataType: "jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/getkot.php',data: {userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
      .success(function(data, status, headers, config) {
        console.log(data);
        $scope.kot = data['kot'];
        $scope.kot.image = data['images'];
    });

  $scope.vote = function(vote,kotid)
  {
    
    $http({method: "post",dataType: "jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/vote.php',data : {userid: userdata['id'],kotid: kotid,vote: vote},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          if(data)
          {
            $window.location.reload(true);
          }
      });
  }
})

.controller('StartCtrl', function($location,$http) {
  if(window.localStorage.hasOwnProperty('userdata'))
  {
      userdata = JSON.parse(window.localStorage['userdata']);
      $http({method: "post",dataType: "jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/checkUser.php',data : {userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          if(data.succes)
          {
            $location.path('/menu/main');
          }  
      });
      
  }
})

.controller('PlaylistCtrl', function($scope, $stateParams) {
})

.controller('RegisterCtrl', function($scope, $stateParams,$timeout,$location,$http) {

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
        var userdata ={
          username: $scope.registerData.username,
          password: $scope.registerData.password
        }
        /*window.localStorage['userdata'] = JSON.stringify(userdata);*/
        $http({method: "POST",dataType:"jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/register.php',data : {username: $scope.registerData.username,password: $scope.registerData.password},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          console.log(data);
          if(data['result'])
          {
            userdata = {
              id : data['id'],
              username:data['username'],
              password: data['password']
            };
            window.localStorage['userdata'] = JSON.stringify(userdata);
            $location.path('/location');
          }
        });
      }
  };

  $scope.facebookRegister = function() {
    facebookConnectPlugin.login(["public_profile", "email"],
      function(success) {
        if(success.status == 'connected')
        {
          facebookConnectPlugin.api('/me',["public_profile", "email"],function(result){
              $http({method: "POST",dataType:"jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/register.php',data : {username: result.name,password: ''},headers:{'Access-Control-Allow-Origin': '*'}})
                .success(function(data, status, headers, config) {
                  if(data['result'])
                  {
                    userdata = {
                      id : data['id'],
                      username:data['username'],
                      password: data['password']
                    };
                    window.localStorage['userdata'] = JSON.stringify(userdata);
                    $location.path('/location');
                  }
                });
          });
        }
      
    }, function (error) {
      console.log(error);
    });
  };
})
.controller('LocationCtrl', function($scope, $stateParams,$timeout,$location,$http) {

  $scope.locationData = {};
  $scope.locationData.price = 100;
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
      console.log($scope.locationData.price);

      if(isValid)
      {
        userdata = JSON.parse(window.localStorage['userdata']);
        $http({method: "POST",dataType:"jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/savebasicfilter.php',data : {school: $scope.locationData.school,price: $scope.locationData.price , userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          console.log(data);
          if(data['result'])
          {
            userdata['school'] = $scope.locationData.school;
            userdata['price'] = $scope.locationData.price;
            window.localStorage['userdata'] = JSON.stringify(userdata);
            $location.path('/menu/main');
          }
        });
      }
  };
})

.controller('SettingsCtrl', function($scope, $stateParams,$timeout,$location,$http) {
  $scope.changeUsername = function(){
      $scope.postChanges('username',$scope.userdata.username); 
  };

  $scope.changeSchool = function(){
      $scope.postChanges('school',$scope.userdata.school);    
  };

  $scope.changePrice = function(){
      $scope.postChanges('price',$scope.userdata.price);   
  };

  $scope.changeDistance = function(){
      $scope.postChanges('distance',$scope.userdata.distance);   
  };

  $scope.changeStartDate = function(){
      $scope.postChanges('startDate',$scope.userdata.startDate);   
  };

  $scope.changeEndDate = function(){
      $scope.postChanges('endDate',$scope.userdata.endDate);   
  };

  $scope.changeBikestands = function(){
      $scope.postChanges('bikestands',$scope.userdata.bikestands);   
  };

  $scope.changeSeperatekitchen = function(){
      $scope.postChanges('seperatekitchen',$scope.userdata.seperatekitchen);   
  };

  $scope.changeSeperatebathroom = function(){
      $scope.postChanges('seperatebathroom',$scope.userdata.seperatebathroom);   
  };

  $scope.changeFurniture = function(){
      $scope.postChanges('furniture',$scope.userdata.furniture);   
  };

  //needed to cancel the timeout function
  var delay;
  $scope.postChanges = function(field,value)
  {
    //cancel current timeout
    $timeout.cancel(delay);
    delay = $timeout(function() {
      console.log(field+'='+value);
      userdata = JSON.parse(window.localStorage['userdata']);
        $http({method: "POST",dataType:"jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/changeFilters.php',data : {field: field,value: value , userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          console.log(data);
        });
    }, 1000);
    
  }

  userdata = JSON.parse(window.localStorage['userdata']);
  $http({method: "POST",dataType:"jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/getUser.php',data : {userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          console.log(data['result'][0]);
          if(data['succes'])
          {
            $scope.userdata = data['result'][0];
            $scope.userdata.startDate = new Date(data['result'][0]['startDate']);
            $scope.userdata.endDate = new Date(data['result'][0]['endDate']);
          }
        });
  $scope.userdata = JSON.parse(window.localStorage['userdata']);
  $scope.schools = [
                      { name :'Karel De Grote , groenplaats'},
                      { name :'Karel De Grote , hoboken'},
                      { name :'Thomas More'},
                      { name :'Universiteit antwerpen'},
                      { name :'lessius'}
                    ];
  $scope.schools.sort();          
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
