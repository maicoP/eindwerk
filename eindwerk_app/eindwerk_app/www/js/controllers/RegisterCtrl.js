angular.module('starter.controllers')
.controller('RegisterCtrl', function($scope, $stateParams,$timeout,$location,$http) {

  $scope.registerData = {};

  $scope.doRegister = function() {
      //controlleren of alle velden zijn ingevuld
      var isValid = true;
      var emailEl = document.querySelector( '.item-email' );
      var passwordEl = document.querySelector( '.item-password' );
      //remove red from input fields
      angular.element(emailEl).removeClass('error');
      angular.element(passwordEl).removeClass('error');
      if(!$scope.registerData.hasOwnProperty('email'))
      {
        isValid = false;
        addError(emailEl,$timeout);
      }

      if(!$scope.registerData.hasOwnProperty('password'))
      {
        isValid = false;
        addError(passwordEl,$timeout);
      }

      if(isValid)
      {
        var userdata ={
          email: $scope.registerData.email,
          password: $scope.registerData.password
        }
        $http({method: "get",dataType:"jsonp",url:'http://kotterapp.be/api/register',params : {email: $scope.registerData.email,password: $scope.registerData.password},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          if(data['email'])
          {
            $scope.errors = data['email'];
          }
          if(data['succes'])
          {
            userdata = {
              id : data['id'],
              email:data['email'],
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
            console.log(result);
              $http({method: "get",dataType:"jsonp",url:'http://kotterapp.be/api/register',params : {email: result.email,password: '',facebook:true},headers:{'Access-Control-Allow-Origin': '*'}})
                .success(function(data, status, headers, config) {
                  if(data['email'])
                  {
                    $scope.errors = data['email'];
                  }
                  if(data['succes'])
                  {
                    userdata = {
                      id : data['id'],
                      email:data['email'],
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