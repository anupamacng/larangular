//match angular route to laravel route
var app = angular.module('employeeRecords', [])
        .constant('API_URL', 'http://localhost:8000/public/api/v1/');