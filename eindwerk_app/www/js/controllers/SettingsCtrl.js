angular.module('starter.controllers')
.controller('SettingsCtrl',function($scope, $stateParams,$timeout,$location,$state,SchoolService,UserService,KotService) {

  $scope.loading= true;
  $scope.resetKot = false;

  var delayName;
  var userdata = JSON.parse(window.localStorage['userdata']);

  // when a change is made to one of the inputs save it to db
  $scope.changeEmail = function(){
    $timeout.cancel(delayName);
    delayName = $timeout(function() {
      userdata = JSON.parse(window.localStorage['userdata']);
      userdata['email'] = $scope.userdata.email;
      window.localStorage['userdata'] = JSON.stringify(userdata);
      $scope.postChanges('email',$scope.userdata.email); 
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
      $scope.postChanges('bikestands',$scope.userdata.bikestands?1:0);
    }, 1000);   
  };

  var delayKitchen;
  $scope.changeSeperatekitchen = function(){
    $timeout.cancel(delayKitchen);
    delayKitchen = $timeout(function() {
      $scope.postChanges('seperatekitchen',$scope.userdata.seperatekitchen?1:0);
    }, 1000);   
  };

  var delayBath;
  $scope.changeSeperatebathroom = function(){
    $timeout.cancel(delayBath);
    delayBath = $timeout(function() {
      $scope.postChanges('seperatebathroom',$scope.userdata.seperatebathroom?1:0);
    }, 1000);   
  };
  var delayFurn;
  $scope.changeFurniture = function(){
    $timeout.cancel(delayFurn);
    delayFurn = $timeout(function() {
      $scope.postChanges('furniture',$scope.userdata.furniture?1:0);
    }, 1000);   
  };

  var delaySize;
  $scope.changeSize = function(){
    $timeout.cancel(delaySize);
    delaySize = $timeout(function() {
      $scope.postChanges('size',$scope.userdata.size);
    }, 1000);   
  };

  var delayWifi;
  $scope.changeWifi = function(){
    $timeout.cancel(delayWifi);
    delayWifi = $timeout(function() {
      $scope.postChanges('wifi',$scope.userdata.wifi?1:0);
    }, 1000);   
  };

  // post the change to db
  $scope.postChanges = function(field,value)
  {
      console.log(value);
        UserService.changeFilter(field,value,userdata).then(function(response){
          data = response.data;
          $scope.errors= false;
          if(data['value'])
          {
            angular.forEach(data['value'], function(value,key){
               data['value'][key] = value.replace('value', "email");
              });
            $scope.errors = data['value'];
          }
        });
  }

  // delete all votes from db
  $scope.resetKotten = function()
  {
    KotService.reset(userdata).then(function(response){
        data = response.data;
        if(data['succes'])
        {
          $scope.resetKot = true;
        }
    });

  }

  // logout by clearing the local storage
  $scope.logout = function()
  {
    localStorage.clear();
    $location.path('/');
  }

  // get users current filters 
  $scope.userdata = userdata;
  UserService.getUser(userdata).then(function(response){
      data = response.data;
      if(data['succes'])
      {
        $scope.userdata.id = data['result']['id'];
        $scope.userdata.email = data['result']['email'];
        $scope.userdata.school = data['result']['school'];
        $scope.userdata.price = data['result']['filter']['price'];
        $scope.userdata.size = data['result']['filter']['size'];
        $scope.userdata.distance = data['result']['filter']['distance'];
        $scope.userdata.startDate = new Date(data['result']['filter']['startDate']);
        $scope.userdata.endDate = new Date(data['result']['filter']['endDate']);
        $scope.userdata.bikestands = (data['result']['filter']['bikestands'] == 1) ? true : false;
        $scope.userdata.seperatekitchen = (data['result']['filter']['seperatekitchen'] == 1) ? true : false;
        $scope.userdata.seperatebathroom = (data['result']['filter']['seperatebathroom'] == 1) ? true : false;
        $scope.userdata.furniture = (data['result']['filter']['furniture'] == 1) ? true : false;
        $scope.userdata.wifi = (data['result']['filter']['wifi']== 1) ? true : false;
        $scope.loading = false;
      }
  });
  
  //get all schools in db
  SchoolService.get().then(function(response){
     $scope.schools = response.data;
  });    
});