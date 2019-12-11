<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" ng-app="genKeywords">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Generate Keywords</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" >
    </head>
    <body ng-controller="genKeywordsController">
        <div class="position-ref header">
            <div class="">Generate Keywords</div>
        </div>
        <div class="flex-center position-ref full-height">
            <div class="top-right"><button class="btn btn-success" ng-click="add_wset()"><i class="fa fa-plus" aria-hidden="true"></i></button></div>
            <div class=" position-ref content">
                <div class="wordset">
                    <div ng-repeat="item in wordset track by $id(item)" class="text-set">
                        <textarea id="" name="dataset[<% $index %>]" cols="30" rows="10" placeholder="Enter set" ng-change="calculate($index, SetData)" ng-model="SetData"><% item.set %></textarea>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="modifiers col-md-12">
                    <div class="col-md-4">
                        <label for="separator">Separator</label>
                        <br />
                        <input id="separator" class="separator" type="text" ng-model="Separator">
                    </div>
                    <div class="col-md-4">
                        <label for="wrapper">Wrap in</label>
                        <br />
                        <select id="wrapper" name="wrapper" ng-model="Wrapper">
                            <option value="1">''</option>
                            <option value="2">""</option>
                            <option value="3"><></option>
                            <option value="4">()</option>
                            <option value="5">[]</option>
                            <option value="6">{}</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="formatter">Format</label>
                        <br />
                        <select id="formatter" name="formatter" ng-model="Formatter">
                            <option value="snake">snake_case</option>
                            <option value="dash">dash-case</option>
                            <option value="camel">camelCase</option>
                            <option value="studly">StudlyCase</option>
                            <option value="upper">UPPER CASE</option>
                            <option value="lower">lower case</option>
                            <option value="title">Title Case</option>
                            <option value="none">None</option>
                        </select>
                    </div>
                </div>
                <div class="calc-results"><% calc_res %> Combinations possible</div>
                <div class="center"><button class="btn" ng-click="calcMatches()">Merge</button></div>
                <div class="calculated center" ng-bind-html="result"></div>
                <div class="bottom-left">
                    <button class="btn btn-success" ng-click="upload()">Upload</button>
                    <button class="btn btn-success" ng-click="clear()">Cancel</button>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
