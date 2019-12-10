require('./bootstrap');
import 'angular';

var app = angular.module('genKeywords', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    }).constant('API_URL', 'http://127.0.0.1:8000/api/v1/');

app.controller('genKeywordsController', function ($scope, $http, API_URL) {
    console.log(API_URL);

    $scope.wordset = [];
    $scope.calc_res = 0;
    $scope.result = '';

    $scope.add_wset = function () {
        $scope.wordset.push({set: ''});
    }

    this.$onInit = function(){
        getWordset();
    }

    $scope.upload = function () {
        // TODO
    }
    $scope.clear = function () {
        $scope.wordset = [];
        $scope.calc_res = 0;
        $scope.result = '';
        if($scope.wordset.length < 3){
            for(var i=$scope.wordset.length; i < 3; i++){
                $scope.wordset.push({set: ''});
            }
        }
    }

    var getWordset = function (){
        $http({
            method: 'GET',
            url: API_URL + "keywords"
        }).then(function (resp) {
            var data = resp.data;
            if(data.length > 0){
                // TODO
                $scope.wordset = data;
            }
            if($scope.wordset.length < 3){
                for(var i=$scope.wordset.length; i < 3; i++){
                    $scope.wordset.push({set: ''});
                }
            }
            console.log($scope.wordset);
        }, function (err) {
            console.debug(err);
        });
    }

    var calcMatches = function (){
        /*
        $http({
            method: 'GET',
            url: API_URL + "getwordset"
        }).then(function (resp) {
            console.log(resp);
        }, function (err) {
            console.debug(err);
        });
        */
    }

});
