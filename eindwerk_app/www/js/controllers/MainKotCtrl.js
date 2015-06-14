angular.module('starter.controllers', [])

.controller('MainKotCtrl', function($scope,$ionicScrollDelegate,$timeout,$state,KotService,VoteService) {

  $scope.loading=true;
  $scope.extraInfo=false;
  $scope.noResult=false;

  var kotids = [];
  var currentLocation = new Array();
  var userdata = JSON.parse(window.localStorage['userdata']);
  $scope.user = userdata;
  
  getKot();

  // change main image
  $scope.change_image = function($event){
      angular.element(document.getElementById('main_image')).attr("src", angular.element($event.target).attr('src'));  
  };

  // init the map and set marker to position of kot
  function setMap(location){
    var mapOptions = {
        zoom: 15,
        center: location,
        draggable: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    $scope.map = new google.maps.Map(document.getElementById("map"), mapOptions);
    
    var marker = new google.maps.Marker({
        map: $scope.map,
        animation: google.maps.Animation.DROP,
        position: location
    });
  };

  function getKot()
  {
    // get a kot that you haven't voted on and match your current filters
    KotService.getKot(userdata).then(function(response){
      data = response.data;
      if(data['kot'] == null || data['kot'] == false)
      {
        $scope.loading = false;
        $scope.noResult = true;  
      }
      else
      {
        $scope.include='templates/card.html';
        
        currentLocation['lat'] = data['kot']['lat'];
        currentLocation['lng'] = data['kot']['lng'];
        google.maps.event.addDomListener(document.getElementById("map"), "load",setMap(currentLocation));
        $scope.kot = data['kot'];
        $scope.lenght = data['kot']['distance'];
        if(document.querySelectorAll('td-card')[0] !== undefined && document.querySelectorAll('td-card')[0] !== undefined){
          document.querySelectorAll('td-card')[0].removeAttribute("style");
        }
        $scope.loading=false;
      }
    })
  };
  $scope.vote = function(vote,kotid)
  {
    VoteService.vote(userdata,vote,kotid).then(function(response){
          data = response.data;
          if(data)
          {
            //clean images so previos don't show
            $scope.kot.images = ''; 
            $scope.loading = true;
            getKot();
          }
      });
  };
  //open info tab
  $scope.info = function()
  {
    $scope.map.draggable =true;

    var info = document.getElementById('extraInfo');
    var card = document.querySelectorAll('td-card')[0];
    var openInfo = document.getElementById('openInfo');
    var closeInfo = document.getElementById('closeInfo');
    var map = document.getElementById("map");

    angular.element(card).removeClass('fadeIn animated');
    angular.element(card).addClass('fadeOut animated');  

    $timeout(function(){
      $scope.extraInfo=true;

      angular.element(info).removeClass('fadeOut animated');
      angular.element(info).addClass('fadeIn animated');
      angular.element(map).removeClass('mapHidden fadeOut animated');
      angular.element(map).addClass('mapShow');
      angular.element(map).addClass('fadeIn animated');
      angular.element(openInfo).css( "display", "none" );
      angular.element(closeInfo).css( "display", "block" );
    },500);
  };
  // close info tab
  $scope.closeInfo = function()
  {
    $scope.map.draggable =false;

    var info = document.getElementById('extraInfo');
    var card = document.querySelectorAll('td-card')[0];
    var openInfo = document.getElementById('openInfo');
    var closeInfo = document.getElementById('closeInfo');
    var map = document.getElementById("map");

    angular.element(info).removeClass('fadeIn animated');
    angular.element(info).addClass('fadeOut animated');
    angular.element(map).removeClass('mapShow fadeIn animated');   
    angular.element(map).addClass('fadeOut animated');

    $timeout(function(){
      $scope.extraInfo=false;

      angular.element(map).addClass('mapHidden');
      angular.element(card).removeClass('fadeOut animated');
      angular.element(card).addClass('fadeIn animated');
      $ionicScrollDelegate.scrollTop();
      angular.element(closeInfo).css( "display", "none" );
      angular.element(openInfo).css( "display", "block" );
    },500);
  };

  var timeout;
  // when swipe left dislike
  $scope.swipeLeft = function(id)
  {
    $timeout.cancel(timeout);// cancel the timeout of other functions like onRelease
      timeout = $timeout(function() {
        $scope.vote('dislike',id);
      }, 800);
  }
  // when swipe right like
  $scope.swipeRight = function(id)
  {
    $timeout.cancel(timeout);
      timeout = $timeout(function() {
        $scope.vote('like',id);
      }, 800);
  }

  // when swipe is slow it wil not register as a swipe
  // this function wil check on drag release if the users has voted
  $scope.onRelease = function(id)
  {
    //get with of device
    var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    if(document.querySelectorAll('td-card')[0].getBoundingClientRect()['right'] > (w*1.2133))
    {
      $timeout.cancel(timeout);
      timeout = $timeout(function() {
        $scope.vote('like',id);
      }, 800);
    }

    if(document.querySelectorAll('td-card')[0].getBoundingClientRect()['left'] < (-w*0.2133))
      {
        $timeout.cancel(timeout);
        timeout = $timeout(function() {
          $scope.vote('dislike',id);
        }, 800);
      }
      $ionicScrollDelegate.scrollTop();
  }

});