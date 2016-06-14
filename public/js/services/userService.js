angular.module('userService', [])

.factory('User', function($http) {

    	return {
        // get all the comments
        get : function() {
            return $http.get('/api/v1/getAllUsers/'+document.userId);
        },

        individualUser : function(id){
    		 return  $http.get('/api/v1/viewuser/'+ id);
    	},

    	login : function(userData){
    		 return $http({
                method: 'POST',
                url: '/api/v1/login',
                headers: { 'Content-Type' : 'application/json' },
                data: {"email":userData.email, "password"  : userData.password}
            });
    	},
    	friendList : function(){
    		 return  $http.get('/api/v1/getfriendlist/'+ document.userId);
    	},

    	sendRequest : function(id){

    		console.log(document.userId+id );
    		 return $http({
                method: 'POST',
                url: '/api/v1/addfriend/'+ document.userId ,
                headers: { 'Content-Type' : 'application/json' },
                data: {"friend_id":id}
            });
    	}
    }
});


