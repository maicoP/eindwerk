angular.module('starter.controllers')
.controller('LocationCtrl', function($scope, $stateParams,$timeout,$location,$http) {

  $scope.locationData = {};
  $scope.locationData.price = 100;
  $http({method: "GET",dataType:"jsonp",url:'http://kotterapp.be/api/getschools',headers:{'Access-Control-Allow-Origin': '*'}})
  .success(function(data, status, headers, config) {
    $scope.schools = data;
  });        
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
        userdata = JSON.parse(window.localStorage['userdata']);
        $http({method: "get",dataType:"jsonp",url:'http://kotterapp.be/api/savefilter',params : {school: $scope.locationData.school,price: $scope.locationData.price , userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          console.log(data);
          if(data['succes'])
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