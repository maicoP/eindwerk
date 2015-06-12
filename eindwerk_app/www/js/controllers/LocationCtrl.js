angular.module('starter.controllers')
.controller('LocationCtrl', function($scope, $stateParams,$timeout,$location,SchoolService,UserService) {

  $scope.locationData = {};
  $scope.locationData.price = 250;

  //get all schools from db
  SchoolService.get().then(function(response){
     $scope.schools = response.data;
  });

  // check user input when valid save to db and local storage        
  $scope.doSave = function() {
      var isValid = true;
      var schoolEl = document.querySelector( '.item-school' );
      var priceEl = document.querySelector( '.item-price' );
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
        UserService.saveFilter(userdata,$scope.locationData.price,$scope.locationData.school).then(function(response){
          data = response.data;
          if(data['succes'])
          {
            userdata['school'] = $scope.locationData.school;
            userdata['price'] = $scope.locationData.price;
            window.localStorage['userdata'] = JSON.stringify(userdata);
            $location.path('/main');
          }
        })
      }
  };
})