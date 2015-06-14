angular.module('starter.controllers')
.controller('LoginCtrl', function($scope,$timeout,$location,UserService) {

  $scope.loginData= {};

// check user input when valid user logdin and save the data to local storage
  $scope.doLogin = function() {

      var isValid = true;
      var emailEl = document.querySelector( '.item-email' );
      var passwordEl = document.querySelector( '.item-password' );
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
        UserService.login(userdata.email,userdata.password).then(function(response){
          data = response.data;
          if(data['succes'])
          {
            userdata = {
              id : data['user']['id'],
              email:data['user']['email'],
              password: data['user']['password'],
              school: data['user']['school']
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

  // register via fb
  $scope.facebookRegister = function() {
    facebookConnectPlugin.login(["public_profile", "email"],
      function(success) {
        if(success.status == 'connected')
        {
          facebookConnectPlugin.api('/me',["public_profile", "email"],function(result){
              // check if user exist in db if exist then login
              UserService.fbLogin(result.email).then(function(response){
                data = response.data;
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
