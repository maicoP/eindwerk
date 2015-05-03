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


  .state('menu', {
    url: "/menu",
    abstract: true,
    templateUrl: "templates/menu.html",
    controller: 'AppCtrl'
  })

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

  .state('menu.settings', {
    url: "/settings",
    views: {
      'menuContent': {
        templateUrl: "templates/settings.html",
        controller: 'SettingsCtrl'
      }
    }
  })

  .state('menu.favorite', {
    url: "/favorite",
    views: {
      'menuContent': {
        templateUrl: "templates/favorite.html"
      }
    }
  })

  .state('menu.search', {
    url: "/search",
    views: {
      'menuContent': {
        templateUrl: "templates/search.html"
      }
    }
  })

  .state('menu.browse', {
    url: "/browse",
    views: {
      'menuContent': {
        templateUrl: "templates/browse.html"
      }
    }
  })
    .state('menu.playlists', {
      url: "/playlists",
      views: {
        'menuContent': {
          templateUrl: "templates/playlists.html",
          controller: 'PlaylistsCtrl'
        }
      }
    })
    .state('menu.main', {
      url: "/main",
      views: {
        'menuContent': {
          templateUrl: "templates/main_kot.html",
          controller: 'MainKotCtrl'
        }
      }
    })

  .state('menu.single', {
    url: "/playlists/:playlistId",
    views: {
      'menuContent': {
        templateUrl: "templates/playlist.html",
        controller: 'PlaylistCtrl'
      }
    }
  });
  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/tutorial');
  $httpProvider.defaults.useXDomain = true;
$httpProvider.defaults.withCredentials = true;
delete $httpProvider.defaults.headers.common["X-Requested-With"];
$httpProvider.defaults.headers.common["Accept"] = "application/json";
$httpProvider.defaults.headers.common["Content-Type"] = "application/json";
});
