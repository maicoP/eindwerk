angular.module('starter.controllers')
.controller('LocationCtrl', function($scope, $stateParams,$timeout,$location,$http) {

  $scope.locationData = {};
  $scope.locationData.price = 100;
  $scope.schools = [
                      { name :'KDG, groenplaats'},
                      { name :'KDG, hoboken'},
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