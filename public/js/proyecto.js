/* global C_SERVER, app */

app.controller("ctrlProyecto", function ($scope, $http) {

    $scope.list = function () {
        $http({
            method: 'POST',
            url: C_SERVER + 'proyecto/list'
        }).then(function successCallback(response) {
            $scope.showMessage = true;
            $scope.proyectos = response.data;
            if (response.data.length === 0) {
                $scope.showContent = false;
            } else {
                $scope.showContent = true;
            }
        }, function errorCallback(response) {

        });
    };
    $scope.list();

    $scope.saveProject = function () {
        $http({
            method: 'POST',
            url: C_SERVER + 'proyecto/save',
            data: {'nombre': $scope.nombre}
        }).then(function successCallback(response) {
            if (response.data.success) {
                $scope.list();
                $scope.message = response.data.message;
                $scope.success = response.data.success;
                $('#modal-nuevo').modal('hide');
            }
        }, function errorCallback(response) {

        });

    };

    $scope.goToConfig = function (proyecto) {
        location.href = C_SERVER + 'backlog/list-view/' + proyecto;
    };

    $scope.getEliminarProyecto = function (id) {
        $scope.idProyecto = id;
    };

    $scope.removeProyecto = function () {
        $http({
            method: 'POST',
            url: C_SERVER + 'proyecto/remove',
            data: {'id': parseInt($scope.idProyecto)}
        }).then(function successCallback(response) {
            if (response.data.success) {
                $scope.list();
                $scope.message = response.data.message;
                $scope.success = response.data.success;
                $('#modal-eliminar-proyecto').modal('hide');
            }
            $scope.nombre = '';
        }, function errorCallback(response) {
        });
    };


});