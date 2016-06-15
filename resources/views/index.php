<!DOCTYPE html>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<html lang="en-US" ng-app="userApp" >
<style type="text/css">
	#map {
    width: 500px;
    height: 400px;
    background-color: #CCC;
  }
  #map1 {
    width: 500px;
    height: 400px;
    background-color: #CCC;
  }
</style>
<body  ng-app="userApp" > 
    <!-- LOADING ICON =============================================== -->
    <!-- show loading icon if the loading variable is set to true -->
    <p ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>
    
    <!--main controller-->
    <div ng-controller="mainController">
      <!-- login form -->
        <div ng-show="frm_login">
          <form ng-submit="getLogin()">
          <input type="text" ng-model="user.email">
          <input type="password" ng-model="user.password">
          <input type="submit" ng-click="getLogin(user)" value="Login" />
          </form>
        </div>

      <!-- user list -->
        <h1>User List</h1>
     	  <ul class="todo-list" ng-repeat="user in users">
       	  <li>
              <span ng-click="myFunction(user.id)" >{{user.name}}</span>
              <div>
                {{user.status}}
              </div>


              <button ng-click="addFriend(user.id)">Add friend</button>

          </li>
        </ul>
  <!-- single user information div -->
        <div ng-show="viewSingleUser">
            <h1>{{single.name}}</h1>
            <div>{{single.name}}</div>
    	 </div>

      	<div ng-show="friendList">
        	<h1>Friend List </h1>
           <ul class="todo-list" ng-repeat="friend in friends">
           	  <li>
                  <span>{{friend.name}}</span><br>
                  <span>Distance : {{friend.distance_in_km}}Km</span>
              </li>
            </ul>
      	</div>
        <!-- div for displaying map -->
        <div id="map1"></div>
        <!-- import google maps API -->
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCg-0VdX3_n3NRZ0bJVDDGUDg5DdbC192o"
      async defer>
      </script>
   
    </div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<!-- <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> <!-- load angular --> -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0rc1/angular-route.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular-resource.min.js"></script>
<script src="js/services/userService.js"></script> <!-- load user service -->
<script src="js/app.js"></script>
</body> 
</html>

</html>