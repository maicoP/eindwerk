angular.module('starter.controllers')
.controller('LoginCtrl', function($scope, $stateParams,$timeout,$location,$http) {

  $scope.loginData= {};

  $scope.doLogin = function() {
      //controlleren of alle velden zijn ingevuld
      var isValid = true;
      var emailEl = document.querySelector( '.item-email' );
      var passwordEl = document.querySelector( '.item-password' );
      //remove red from input fields
      angular.element(emailEl).removeClass('error');
      angular.element(passwordEl).removeClass('error');
      if(!$scope.loginData.hasOwnProperty('email'))
      {
        isValid = false;
        addError(emailEl,$timeout);
      }

      if(!$scope.loginData.hasOwnProperty('password'))
      {
        isValid = false;
        addError(passwordEl,$timeout);
      }

      if(isValid)
      {
        var userdata ={
          email: $scope.loginData.email,
          password: $scope.loginData.password
        }
        $http({method: "get",dataType:"jsonp",url:'http://kotterapp.be/api/login',params : {email: $scope.loginData.email,password: $scope.loginData.password},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          console.log(data);
          if(data['succes'])
          {
            userdata = {
              id : data['user']['id'],
              email:data['user']['email'],
              password: data['user']['password']
            };
            window.localStorage['userdata'] = JSON.stringify(userdata);
            $location.path('/main');
          }
          else
          {
            $scope.error = 'email of password is niet correct'
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
              $http({method: "get",dataType:"jsonp",url:'http://kotterapp.be/api/fblogin',params : {email: result.email,password: ''},headers:{'Access-Control-Allow-Origin': '*'}})
                .success(function(data, status, headers, config) {
                  if(data['succes'])
                  {
                    userdata = {
                      id : data['user']['id'],
                      email:data['user']['email'],
                      password: data['user']['password']
                    };
                    window.localStorage['userdata'] = JSON.stringify(userdata);
                    $location.path('/main');
                  }
                  else
                  {
                    $scope.error = 'u bent nog niet geregistreerd';
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