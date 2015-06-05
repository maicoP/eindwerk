angular.module('starter.controllers')
.factory('SchoolService',function($http){
	return{

		get: function(){
			return $http({method: "GET",dataType:"jsonp",url:'http://kotterapp.be/api/getschools',headers:{'Access-Control-Allow-Origin': '*'}})	
		} 
	}
})
.factory('KotService',function($http){
	return{
		getFavKoten: function(userdata){
			return $http({method: "get",dataType: "jsonp",url:'http://kotterapp.be/api/favkotten',params : {userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
		},
		getKot: function(userdata){
			return $http({method: "get",dataType: "jsonp",url:'http://kotterapp.be/api/getKot',params: {userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
		},
		reset:function(userdata){
			return $http({method: "get",dataType:"jsonp",url:'http://kotterapp.be/api/resetkotten',params : {userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
		}
	}
})
.factory('VoteService',function($http){
	return{
		changeVote:function(userdata,vote,kotid){
			return $http({method: "get",dataType: "jsonp",url:'http://kotterapp.be/api/changevote',params : {userid: userdata['id'],kotid: kotid,vote: vote},headers:{'Access-Control-Allow-Origin': '*'}})
		},
		vote:function(userdata,vote,kotid){
			return $http({method: "get",dataType: "jsonp",url:'http://kotterapp.be/api/vote',params : {userid: userdata['id'],kotid: kotid,vote: vote},headers:{'Access-Control-Allow-Origin': '*'}})
		}
	}
})
.factory('UserService',function($http){
	return{
		saveFilter:function(userdata,price,school){
			return $http({method: "get",dataType:"jsonp",url:'http://kotterapp.be/api/savefilter',params : {school: school,price: price , userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
		},
		register:function(email,password,facebook){
			return $http({method: "get",dataType:"jsonp",url:'http://kotterapp.be/api/register',params : {email: email,password: password,facebook: facebook},headers:{'Access-Control-Allow-Origin': '*'}})
		},
		login: function(email ,password){
			return $http({method: "get",dataType:"jsonp",url:'http://kotterapp.be/api/login',params : {email: email,password: password},headers:{'Access-Control-Allow-Origin': '*'}})
		},
		fbLogin: function(email){
			return $http({method: "get",dataType:"jsonp",url:'http://kotterapp.be/api/fblogin',params : {email: email,password: ''},headers:{'Access-Control-Allow-Origin': '*'}})
		},
		changeFilter: function(field,value,userdata){
			return $http({method: "get",dataType:"jsonp",url:'http://kotterapp.be/api/changefilter',params : {field: field,value: value , userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
		},
		getUser: function(userdata){
			return $http({method: "get",dataType:"jsonp",url:'http://kotterapp.be/api/getappuser',params : {userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
		},
		checkUser: function(userdata){
			return $http({method: "get",dataType: "jsonp",url:'http://kotterapp.be/api/checkuser',params : {userid: userdata['id']},headers:{'Access-Control-Allow-Origin': '*'}})
		}
	}
});