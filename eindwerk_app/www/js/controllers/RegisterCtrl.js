angular.module('starter.controllers')
.controller('RegisterCtrl', function($scope,$timeout,$location,UserService) {

  $scope.registerData = {};
// check user data when valid save to db
  $scope.doRegister = function() {

      var isValid = true;
      var emailEl = document.querySelector( '.item-email' );
      var passwordEl = document.querySelector( '.item-password' );

      angular.element(emailEl).removeClass('error');
      angular.element(passwordEl).removeClass('error');
      if(!$scope.registerData.hasOwnProperty('email') || $scope.registerData.email == '' )
      {
        isValid = false;
        addError(emailEl,$timeout);
      }

      if(!$scope.registerData.hasOwnProperty('password') || $scope.registerData.password == '')
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
        UserService.register(userdata.email,userdata.password,false).then(function(response){
            data = response.data;
            handelRegister(data);
        });
      }
  };
  // register with facebook
  $scope.facebookRegister = function() {
    facebookConnectPlugin.login(["public_profile", "email"],
      function(success) {
        if(success.status == 'connected')
        {
          facebookConnectPlugin.api('/me',["public_profile", "email"],function(result){
            // get email from user and set password empty in db
            UserService.register(result.email,'',true).then(function(response){
                  data = response.data;
                  handelRegister(data);
                });
          });
        }
      
    }, function (error) {
      console.log(error);
    });
  };
  function handelRegister(data){
    if(data['email'] || data['password'])
    {
      $scope.errors = data;
    }
    if(data['succes'])
    {
      userdata = {
        id : data['id'],
        email:data['user_email'],
        password: data['user_password']
      };
      window.localStorage['userdata'] = JSON.stringify(userdata);
      $location.path('/location');
    }
  }
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