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

.controller('MainKotCtrl', function($scope,$http,$window,$ionicLoading) {
    
  userdata = JSON.parse(window.localStorage['userdata']);
  $scope.change_image = function($event){
      console.log(document.getElementById('main_image'));
      console.log(angular.element(document.getElementById('main_image')).attr("src"));
      angular.element(document.getElementById('main_image')).attr("src", angular.element($event.target).attr('src'));
      
  };

  $http({method: "post",dataType: "jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/getkot.php',data: {userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
      .success(function(data, status, headers, config) {
        $scope.kot = data['kot'];
        adress = $scope.kot.city+' '+$scope.kot.zipcode+' '+$scope.kot.streatname+' '+$scope.kot.housenumber;
        $scope.kot.image = data['images'];
        var schoolLatlng;
        var adressLatlng;
        var myLatlng = new google.maps.LatLng(51.301137, 4.733754);
        var mapOptions = {
            center: myLatlng,
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address':  userdata['school']}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                  console.log(results);
                  schoolLatlng = results[0].geometry.location;
                  map.setCenter(results[0].geometry.location);
                          var marker = new google.maps.Marker({
                              map: map,
                              animation: google.maps.Animation.DROP,
                              position: results[0].geometry.location
                          }); 
              } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
         geocoder.geocode( { 'address': adress}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                  console.log(results);
                  adressLatlng = results[0].geometry.location;
                  map.setCenter(results[0].geometry.location);
                          var marker = new google.maps.Marker({
                              map: map,
                              animation: google.maps.Animation.DROP,
                              position: results[0].geometry.location
                          });
                  var latlngbounds = new google.maps.LatLngBounds();
                  latlngbounds.extend(adressLatlng);
                  latlngbounds.extend(schoolLatlng);
                  map.setCenter(latlngbounds.getCenter());
                  map.fitBounds(latlngbounds);
                  $scope.lenght = google.maps.geometry.spherical.computeDistanceBetween(adressLatlng,schoolLatlng)/1000;  
                  $scope.lenght = $scope.lenght.toFixed(2);
              } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
         
 
        $scope.map = map;
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
            $location.path('/main');
          }  
      });
      
  }
})

.controller('FavKotCtrl', function($scope, $stateParams,$http) {
  userdata = JSON.parse(window.localStorage['userdata']);
  $http({method: "post",dataType: "jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/getFavKot.php',data : {userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
      .success(function(data, status, headers, config) {
        $scope.favKot = data;
        console.log(data); 
    });
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
            $location.path('/main');
          }
        });
      }
  };
})

.controller('SettingsCtrl', function($scope, $stateParams,$timeout,$location,$http) {
  var delayName;
  $scope.changeUsername = function(){
    $timeout.cancel(delayName);
    delayName = $timeout(function() {
      $scope.postChanges('username',$scope.userdata.username); 
    }, 1000);
  };
  var delaySchool;
  $scope.changeSchool = function(){
    $timeout.cancel(delaySchool);
    delaySchool = $timeout(function() {
      userdata = JSON.parse(window.localStorage['userdata']);
      userdata['school'] = $scope.userdata.school;
      window.localStorage['userdata'] = JSON.stringify(userdata);
      $scope.postChanges('school',$scope.userdata.school);
    }, 1000);    
  };
  var delayPrice;
  $scope.changePrice = function(){
    $timeout.cancel(delayPrice);
    delayPrice = $timeout(function() {
      $scope.postChanges('price',$scope.userdata.price); 
    }, 1000);  
  };
  var delayDist;
  $scope.changeDistance = function(){
    $timeout.cancel(delayDist);
    delayDist = $timeout(function() {
      $scope.postChanges('distance',$scope.userdata.distance);
    }, 1000);   
  };
  var delaySDate;
  $scope.changeStartDate = function(){
    $timeout.cancel(delaySDate);
    delaySDate = $timeout(function() {
      $scope.postChanges('startDate',$scope.userdata.startDate);
    }, 1000);   
  };
  var delayEDate;
  $scope.changeEndDate = function(){
    $timeout.cancel(delayEDate);
    delayEDate = $timeout(function() {
      $scope.postChanges('endDate',$scope.userdata.endDate);
    }, 1000);   
  };
  var delayBike;
  $scope.changeBikestands = function(){
    $timeout.cancel(delayBike);
    delayBike = $timeout(function() {
      $scope.postChanges('bikestands',$scope.userdata.bikestands);
    }, 1000);   
  };
  var delayKitchen;
  $scope.changeSeperatekitchen = function(){
    $timeout.cancel(delayKitchen);
    delayKitchen = $timeout(function() {
      $scope.postChanges('seperatekitchen',$scope.userdata.seperatekitchen);
    }, 1000);   
  };
  var delayBath;
  $scope.changeSeperatebathroom = function(){
    $timeout.cancel(delayBath);
    delayBath = $timeout(function() {
      $scope.postChanges('seperatebathroom',$scope.userdata.seperatebathroom);
    }, 1000);   
  };
  var delayFurn;
  $scope.changeFurniture = function(){
    $timeout.cancel(delayFurn);
    delayFurn = $timeout(function() {
      $scope.postChanges('furniture',$scope.userdata.furniture);
    }, 1000);   
  };

  $scope.postChanges = function(field,value)
  {
      console.log(value);
      userdata = JSON.parse(window.localStorage['userdata']);
        $http({method: "POST",dataType:"jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/changeFilters.php',data : {field: field,value: value , userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          console.log(data);
        });
  }

  userdata = JSON.parse(window.localStorage['userdata']);
  $http({method: "POST",dataType:"jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/getUser.php',data : {userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          console.log(data['result'][0]['bikestands']);
          if(data['succes'])
          {
            $scope.userdata = data['result'][0];
            $scope.userdata.startDate = new Date(data['result'][0]['startDate']);
            $scope.userdata.endDate = new Date(data['result'][0]['endDate']);
            $scope.userdata.bikestands = (data['result'][0]['bikestands'] == 1) ? true : false;
            $scope.userdata.seperatekitchen = (data['result'][0]['seperatekitchen'] == 1) ? true : false;
            $scope.userdata.seperatebathroom = (data['result'][0]['seperatebathroom'] == 1) ? true : false;
            $scope.userdata.furniture = (data['result'][0]['furniture'] == 1) ? true : false;
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
