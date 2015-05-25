angular.module('starter.controllers')
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
        $http({method: "POST",dataType:"jsonp",url:'http://kotterapp.be/db/register.php',data : {username: $scope.registerData.username,password: $scope.registerData.password},headers:{'Access-Control-Allow-Origin': '*'}})
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
              $http({method: "POST",dataType:"jsonp",url:'http://kotterapp.be/db/register.php',data : {username: result.name,password: ''},headers:{'Access-Control-Allow-Origin': '*'}})
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