/* global C_SERVER, app */

app.controller("ctrlLink", function ($scope, $http) {

    $('.slidediv').hide();

    $scope.MenuReturn = function () {
        location.href = C_SERVER + '/login/bienvenida';
    };
    $scope.salir = function () {
        location.href = C_SERVER + '/usuario/exit';
    };
    $scope.goToPersona = function () {
        location.href = C_SERVER + 'persona/list-view';
    };
    $scope.goToProyectos = function () {
        location.href = C_SERVER + 'proyecto/list-view';
    };


});

$(function () {
    $('.showhide').mouseover(function () {
        $(".slidediv").show();
    });
    $('.showhide').mouseout(function () {
        $(".slidediv").hide();
    });
});