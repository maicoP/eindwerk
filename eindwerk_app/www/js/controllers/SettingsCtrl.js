angular.module('starter.controllers')
.controller('SettingsCtrl', function($scope, $stateParams,$timeout,$location,$http,$state) {
  $scope.loading= true;
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
          console.log(data);
          if(data['succes'])
          {
            $scope.userdata = data['result'][0];
            $scope.userdata.startDate = new Date(data['result'][0]['startDate']);
            $scope.userdata.endDate = new Date(data['result'][0]['endDate']);
            $scope.userdata.bikestands = (data['result'][0]['bikestands'] == 1) ? true : false;
            $scope.userdata.seperatekitchen = (data['result'][0]['seperatekitchen'] == 1) ? true : false;
            $scope.userdata.seperatebathroom = (data['result'][0]['seperatebathroom'] == 1) ? true : false;
            $scope.userdata.furniture = (data['result'][0]['furniture'] == 1) ? true : false;
            $scope.loading = false;
          }
        });
  $scope.userdata = JSON.parse(window.localStorage['userdata']);
  $http({method: "GET",dataType:"jsonp",url:'http://maicopaulussen.2fh.co/eindwerk/db/getSchools.php',headers:{'Access-Control-Allow-Origin': '*'}})
  .success(function(data, status, headers, config) {
    $scope.schools = data;
  });
           
});