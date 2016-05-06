/* global C_SERVER, app */

app.controller("ctrlPersona", function ($scope, $http) {

    $scope.nombre = '';

    $scope.list = function () {
        $http({
            method: 'POST',
            url: C_SERVER + 'persona/list'
        }).then(function successCallback(response) {
            $scope.showMessage = true;
            $scope.personas = response.data;
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
            }
            $scope.nombre = '';
        }, function errorCallback(response) {
        });
        $('#modal-nuevo').modal('hide');
    };

    $scope.removeProject = function (id) {
        $http({
            method: 'POST',
            url: C_SERVER + 'proyecto/remove',
            data: {'id': id}
        }).then(function successCallback(response) {
            if (response.data.success) {
                $scope.list();
                $scope.message = response.data.message;
                $scope.success = response.data.success;
            }
            $scope.nombre = '';
        }, function errorCallback(response) {
        });
    };

});