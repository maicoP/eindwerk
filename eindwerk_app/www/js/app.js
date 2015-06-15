angular.module('starter', ['ionic','ionic.contrib.ui.tinderCards', 'starter.controllers'])

.run(function($ionicPlatform,$ionicPopup,$http,$location) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if (window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
    }
    if (window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleDefault();
    }
    if(window.Connection) {
      if(navigator.connection.type == Connection.NONE) {
          $ionicPopup.alert({
              title: "Internet verbinding",
              content: "Er is een internet verbinding nodig."
          })
          .then(function(result) {
            console.log(result);
              if(result) {
                  ionic.Platform.exitApp();
              }
          });
      }
    }
  });
})

.config(function($ionicConfigProvider,$stateProvider,$urlRouterProvider,$httpProvider) {
  // set caching off
  $ionicConfigProvider.views.maxCache(0);
  // define routes
  $stateProvider
  .state('tutorial', {
    url: "/tutorial",
    templateUrl: "templates/tut1.html",
    controller: 'StartCtrl'
  })

  .state('register', {
    url: "/register",
    templateUrl: "templates/register.html",
    controller: 'RegisterCtrl'
  })

  .state('location', {
    url: "/location",
    templateUrl: "templates/location.html",
    controller: 'LocationCtrl'
  })

  .state('settings', {
    url: "/settings",
    templateUrl: "templates/settings.html",
    controller: 'SettingsCtrl'
  })
  .state('login', {
    url: "/login",
    templateUrl: "templates/login.html",
    controller: 'LoginCtrl'
  })
  .state('main', {
      url: "/main",
      templateUrl: "templates/main_kot.html",
      controller: 'MainKotCtrl'
    })
  .state('favorite', {
    url: "/favorite",
    templateUrl: "templates/favorite.html",
    controller: 'FavKotCtrl'
  });
  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/tutorial');
});


