/* global C_SERVER, app */

app.controller("ctrlBacklog", function ($scope, $http) {

    $scope.proyecto = window.location.href.split("/").pop(-1);

    $scope.list = function () {

        $http({
            method: 'POST',
            url: C_SERVER + 'backlog/list/' + $scope.proyecto
        }).then(function successCallback(response) {
            $scope.showMessage = true;
            $scope.backlogs = response.data;
            if ($scope.backlogs.result.length === 0) {
                $scope.sizeBacklog = 1;
            } else {
                $scope.sizeBacklog = $scope.backlogs.result.length + 1;
            }
        }, function errorCallback(response) {

        });
    };
    $scope.list();

    $scope.listPersonas = function () {
        $http({
            method: 'POST',
            url: C_SERVER + 'backlog/list-personas/' + $scope.proyecto
        }).then(function successCallback(response) {
            $scope.showMessage = true;
            $scope.personas = response.data;
            if (response.data.length === 0) {

            } else {

            }
        }, function errorCallback(response) {

        });
    };
    $scope.listPersonas();

    $scope.listComplejidad = function () {
        $http({
            method: 'POST',
            url: C_SERVER + 'backlog/list-complejidad'
        }).then(function successCallback(response) {
            $scope.showMessage = true;
            $scope.complejidades = response.data;
            if (response.data.length === 0) {

            } else {

            }
        }, function errorCallback(response) {

        });
    };
    $scope.listComplejidad();

    $scope.saveBacklog = function () {
        $http({
            method: 'POST',
            url: C_SERVER + 'backlog/save',
            data: {
                'nombre': $scope.requerimiento,
                'idComplejidad': parseInt($scope.complejidad),
                'prioridad': $scope.prioridad,
                'idProyecto': parseInt($scope.proyecto)
            }
        }).then(function successCallback(response) {
            if (response.data.success) {
                $scope.message = response.data.message;
                $scope.success = response.data.success;
                $scope.list();
                $('#modal-nuevo-req').modal('hide');
                $scope.requerimiento = '';
                $scope.complejidad = '';
                $scope.prioridad = '';
            }
        }, function errorCallback(response) {

        });
    };

    $scope.openEliminarBacklog = function (id) {
        $scope.idBacklog = id;
    };

    $scope.removeBacklog = function () {
        $http({
            method: 'POST',
            url: C_SERVER + 'backlog/remove',
            data: {
                'idBacklog': parseInt($scope.idBacklog)
            }
        }).then(function successCallback(response) {
            if (response.data.success) {
                $scope.message = response.data.message;
                $scope.success = response.data.success;
                $scope.list();
                $('#modal-eliminar-req').modal('hide');
            }
        }, function errorCallback(response) {

        });
    };
});