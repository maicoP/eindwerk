angular.module('starter', ['ionic', 'starter.controllers'])

.run(function($ionicPlatform,$ionicPopup) {
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
          $ionicPopup.confirm({
              title: "Internet Disconnected",
              content: "The internet is disconnected on your device."
          })
          .then(function(result) {
              if(!result) {
                  ionic.Platform.exitApp();
              }
          });
      }
    }
  });
})

.config(function($stateProvider,$urlRouterProvider,$httpProvider) {
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

  .state('favorite', {
    url: "/favorite",
    templateUrl: "templates/favorite.html",
    controller: 'FavKotCtrl'
  })
    .state('main', {
      url: "/main",
      templateUrl: "templates/main_kot.html",
      controller: 'MainKotCtrl'
    });
  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/tutorial');
  $httpProvider.defaults.useXDomain = true;
$httpProvider.defaults.withCredentials = true;
delete $httpProvider.defaults.headers.common["X-Requested-With"];
$httpProvider.defaults.headers.common["Accept"] = "application/json";
$httpProvider.defaults.headers.common["Content-Type"] = "application/json";
});
