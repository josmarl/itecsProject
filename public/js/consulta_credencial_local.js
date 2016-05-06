app.controller("ctrlConsultaEntregLocal", function ($scope, $http) {

    $scope.showTable = false;
    $scope.showMessage=false;
    $scope.message='';
    $scope.ambito='0';
    $scope.isBusy=false;
    $scope.credByLocal =[];

    $scope.exportExcel = function () {
        var data = {
            'ambito': $scope.ambito
        };
        data = serializeObj(data);
        location.href = C_SERVER + "consulta/credencial-mmesa/cred-entreg-local/exporta?" + data;
    };


    /*$scope.getAmbitos = function () {
        $http({
            method: 'GET',
            url: C_SERVER + 'consulta/credencial-mmesa/ambitos'
        }).then(function successCallback(response) {
            $scope.ambitos = response.data;
        }, function errorCallback(response) {

        });
    };
    $scope.getAmbitos();*/

    $scope.consultar = function () {
        $scope.isBusy=true;
        $scope.showTable = true;
        $http({
            method: 'POST',
            url: C_SERVER + 'consulta/credencial-mmesa/cred-entreg-local',
            data: {'ambito': $scope.ambito}
        }).then(function successCallback(response) {
            $scope.showMessage=!response.data.success;
            $scope.message=response.data.message;
            $scope.credByLocal = response.data.data;
            $scope.isBusy=false;
            $scope.sumTotalMesas = 0;
            $scope.sumEntregadas = 0;
            $scope.sumNoEntregadas = 0;
            $scope.sumPorcEntregadas = 0;
            $scope.presidente = 0;
            $scope.secretario = 0;
            $scope.tercer_miembro = 0;
            $scope.primer_sup = 0;
            $scope.segundo_sup = 0;
            $scope.tercer_sup = 0;
            
                angular.forEach($scope.credByLocal, function (val, key) {
                            $scope.sumTotalMesas = $scope.sumTotalMesas + parseInt(val.total_mesas);
                            $scope.presidente = $scope.presidente + parseInt(val.presidente);
                            $scope.secretario = $scope.secretario + parseInt(val.secretario);
                            $scope.tercer_miembro = $scope.tercer_miembro + parseInt(val.tercer_miembro);
                            $scope.primer_sup = $scope.primer_sup + parseInt(val.primer_sup);
                            $scope.segundo_sup = $scope.segundo_sup + parseInt(val.segundo_sup);
                            $scope.tercer_sup = $scope.tercer_sup + parseInt(val.tercer_sup);
                            $scope.sumEntregadas = $scope.sumEntregadas + parseInt(val.entregados);
                            $scope.sumNoEntregadas = $scope.sumNoEntregadas + parseInt(val.no_entregados);
                            $scope.sumPorcEntregadas = $scope.sumPorcEntregadas + parseFloat(val.porc_entregados);
                        });
        }, function errorCallback(response) {
            $scope.isBusy=false;
        });
    };
});