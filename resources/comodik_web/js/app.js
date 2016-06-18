
var app = angular.module('comodik', ['ngRoute', 'ngCookies', 'ngAnimate', 'toastr']);

app.constant('env', {
});

app.config(function ($locationProvider) {
    $locationProvider.html5Mode(true).hashPrefix('!');
});

function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value) {
    var expiration_date = new Date();
    expiration_date.setFullYear(expiration_date.getFullYear() + 1);
    cookie_string = name + "=" + value + "; path=/; expires=" + expiration_date.toGMTString();
    document.cookie = cookie_string;
}

app.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'views/main.html',
            controller: 'MainController'
        })
        .when('/pages', {
            templateUrl: 'views/pages.html',
            controller: 'PagesController'
        });
    $routeProvider.otherwise('/');
});

