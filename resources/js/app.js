require('./bootstrap');
import 'angular';
import 'angular-sanitize';

var app = angular.module('genKeywords', ['ngSanitize'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    }).constant('API_URL', 'http://127.0.0.1:8000/api/v1/');

app.controller('genKeywordsController', function ($scope, $http, API_URL) {
    console.log(API_URL);

    $scope.wordset = [];
    $scope.calc_res = 0;
    $scope.result = '';
    $scope.Data = [];
    $scope.Separator = '';
    $scope.Wrapper = '';
    $scope.Formatter = '';

    $scope.add_wset = function () {
        $scope.wordset.push({set: ''});
    }

    this.$onInit = function(){
        getWordset();
    }

    $scope.upload = function () {
        // TODO
    }

    $scope.calculate = function(id, text){
        $scope.Data[id] = text;
        var precalc = [];
        angular.forEach($scope.Data, function(value, key){
            var val = value.split(/[\r\n]+/);
            precalc[key] = val.length;
        });
        for(var i = 0; i < precalc.length; i++){
            if(i == 0){
                $scope.calc_res = precalc[i];
            }else{
                $scope.calc_res = $scope.calc_res * precalc[i];
            }
        }
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
        //    console.log($scope.wordset);
        }, function (err) {
            console.debug(err);
        });
    }

    $scope.calcMatches = function (){
        if($scope.Data.length < 1){
            // TODO err msg
            return false;
        }
        if($scope.Separator == ''){
            // TODO err msg
            return false;
        }
        if($scope.Wrapper == ''){
            // TODO err msg
            return false;
        }
        if($scope.Formatter == ''){
            // TODO err msg
            return false;
        }
        var post_data = {
            'set': $scope.Data,
            'separate': $scope.Separator,
            'wrap': $scope.Wrapper,
            'format': $scope.Formatter
        }
        console.log(post_data);
        $http({
            method: 'POST',
            url: API_URL + "keywords",
            data: JSON.stringify(post_data),
            headers: { 'Content-Type': 'application/json; charset=utf-8' }
        }).then(function (resp) {
            $scope.result = resp.data.data;
            console.log(resp);
        }, function (err) {
            console.debug(err);
        });
    }

});
