angular.module('starter.controllers', [])

.controller('MainKotCtrl', function($scope,$http,$window,$ionicScrollDelegate,$ionicLoading,$timeout,$state) {
  $scope.loading=true;
  $scope.extraInfo=false;
  $scope.noResult=false;
  var kotids = [];
  var currentLocation = new Array();
  var userdata = JSON.parse(window.localStorage['userdata']);
  $scope.user = userdata;

  getKot();

  $scope.change_image = function($event){
      angular.element(document.getElementById('main_image')).attr("src", angular.element($event.target).attr('src'));  
  };

  function setMap(location){
    var mapOptions = {
        zoom: 15,
        center: location,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    $scope.map = new google.maps.Map(document.getElementById("map"), mapOptions);
    
    var marker = new google.maps.Marker({
        map: $scope.map,
        animation: google.maps.Animation.DROP,
        position: location
    });
    $scope.map.control = {};
    $scope.map.center.A= location['lat'];
    $scope.map.center.F =  location['lng'];
    console.log($scope.map);
  };

  function getKot()
  {
    
    $http({method: "get",dataType: "jsonp",url:'http://kotterapp.be/api/getKot',params: {userid: userdata['id'],kotids: kotids},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          console.log(data);
          if(data['kot'] == false)
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
          
      });
  };
  $scope.vote = function(vote,kotid)
  {
    $http({method: "get",dataType: "jsonp",url:'http://kotterapp.be/api/vote',params : {userid: userdata['id'],kotid: kotid,vote: vote},headers:{'Access-Control-Allow-Origin': '*'}})
        .success(function(data, status, headers, config) {
          if(data)
          {
            console.log('test');
            //clean images so previos don't show
            $scope.kot.images = ''; 
            $scope.loading = true;
            getKot();
          }
      });
  };

  $scope.info = function()
  {

    /*setMap(currentLocation);*/
    console.log($scope.map.center);
    $scope.map.center.A = currentLocation['lat'];
    $scope.map.center.F=  currentLocation['lng'];
    var info = document.getElementById('extraInfo');
    var card = document.querySelectorAll('td-card')[0];
    var openInfo = document.getElementById('openInfo');
    var closeInfo = document.getElementById('closeInfo');
    angular.element(card).removeClass('fadeIn animated');
    angular.element(card).addClass('fadeOut animated');    $timeout(function(){
      $scope.extraInfo=true;
      angular.element(info).removeClass('fadeOut animated');
      angular.element(info).addClass('fadeIn animated');
    },500);
  };

  $scope.closeInfo = function()
  {
    var info = document.getElementById('extraInfo');
    var card = document.querySelectorAll('td-card')[0];
    var openInfo = document.getElementById('openInfo');
    var closeInfo = document.getElementById('closeInfo');
    angular.element(info).removeClass('fadeIn animated');
    angular.element(info).addClass('fadeOut animated');
    $timeout(function(){
      $scope.extraInfo=false;
      angular.element(card).removeClass('fadeOut animated');
      angular.element(card).addClass('fadeIn animated');
    },500);
  };

  var timeout;
  $scope.swipeLeft = function(id)
  {
    console.log('leftswipe');
    $timeout.cancel(timeout);
      timeout = $timeout(function() {
        $scope.vote('dislike',id);
      }, 800);
  }
  $scope.swipeRight = function(id)
  {
    console.log('rightswipe');
    $timeout.cancel(timeout);
      timeout = $timeout(function() {
        $scope.vote('like',id);
      }, 800);
  }
  $scope.onRelease = function(id)
  {
    console.log('drag');
    console.log(document.querySelectorAll('td-card')[0].getBoundingClientRect()['right']);
    if(document.querySelectorAll('td-card')[0].getBoundingClientRect()['right'] > 435)
    {

      $timeout.cancel(timeout);
      timeout = $timeout(function() {
        $scope.vote('like',id);
      }, 800);
    }

    if(document.querySelectorAll('td-card')[0].getBoundingClientRect()['left'] < -75)
      {
        $timeout.cancel(timeout);
        timeout = $timeout(function() {
          $scope.vote('dislike',id);
        }, 800);
      }
  }

});