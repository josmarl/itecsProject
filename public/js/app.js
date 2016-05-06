/* global angular */

var C_SERVER = 'http://localhost:80/projectUpeu/public/';
var LOADING_GIF = "<img src='" + C_SERVER + '/img/loading.gif' + "'/>";
var NUM_PER_PAGE = 25;
var MAX_PAGE = 1000000000;
var MSG_MAX_REG = '*Sólo se mostrarán los 25 últimos registros';
var app = angular.module("app", ['ngRoute', 'ui.bootstrap'], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

function getUrlParameter() {
    var pathname = window.location.href;
    var lastItem = pathname.split("/").pop(-1);
    return lastItem;
}

function serializeObj(obj) {
    var result = [];
    for (var property in obj)
        result.push(encodeURIComponent(property) + "=" + encodeURIComponent(obj[property]));
    return result.join("&");
}

$(document).ready(function () {
    $("#mainContainerPage").css('display', 'block');
    $(document).on('blur', 'textarea', function ()
    {
        var val = $(this).val().toUpperCase();
        $(this).val(val);
    });

    $('input, textarea').bind('keypress', function (event) {
        if ($(this).hasClass('onlyNumber')) {
            if (event.keyCode != 8 && event.keyCode != 13 && event.keyCode != 9) {
                var regex = new RegExp("^[0-9]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            }
        }
    });


    $('input, textarea').bind("contextmenu", function (event) {
        if ($(this).hasClass('onlyText') || $(this).hasClass('onlyNumber')) {
            return false;
        }
    });

});

$(document).on('keypress', '.onlyNumber', function (event) {
    if ($(this).hasClass('onlyNumber')) {
        console.log(1);
        if (event.keyCode != 8 && event.keyCode != 13 && event.keyCode != 9) {
            var regex = new RegExp("^[0-9]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        }
    }
});


$(document).on('contextmenu', '.onlyNumber,.onlyText',
        function (event) {
            return false;
        }
);

$('input, textarea').bind("contextmenu", function (event) {
    if ($(this).hasClass('onlyText') || $(this).hasClass('onlyNumber')) {
        return false;
    }
});
