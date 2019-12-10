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
                        <textarea id="" name="dataset[<% $index %>]" cols="30" rows="10" placeholder="Enter set"><% item.set %></textarea>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="modifiers">
                    <input class="separator" type="text">
                    <select id="" name="wrapper">
                        <option value="t1" selected>Чебурашка</option>
                        <option value="t2">Крокодил Гена</option>
                        <option value="t3">Шапокляк</option>
                        <option value="t4">Крыса Лариса</option>
                    </select>
                    <select id="" name="formatter">
                        <option value="t1" selected>Чебурашка</option>
                        <option value="t2">Крокодил Гена</option>
                        <option value="t3">Шапокляк</option>
                        <option value="t4">Крыса Лариса</option>
                    </select>
                </div>
                <div class="calc-results"><% calc_res %>Combinations possible</div>
                <div class="center"><button class="btn" ng-click="getResult()">Merge</button></div>
                <div class="calculated">
                    <% result %>
                </div>
                <div class="bottom-left">
                    <button class="btn btn-success" ng-click="upload()">Upload</button>
                    <button class="btn btn-success" ng-click="clear()">Cancel</button>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
