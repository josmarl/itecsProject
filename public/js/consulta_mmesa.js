app.controller("ctrlConsultaCredMMesa", function ($scope, $http) {
    $scope.isBusy=false;
    loading=$("#loading");
    $scope.showTable = false;
    $scope.showComboOdpe = false;
    $scope.ambito='0';
    $scope.opc='1';
    $scope.ambitos=[];
    $scope.currentPage = 1;
    $scope.numPerPage=NUM_PER_PAGE;
    $scope.maxSize = MAX_PAGE;
    $scope.totalItems = 0;
    $scope.showPagination=false;
    $scope.filterLista = [];
    $scope.lista=[];
    $scope.showMessage=false;
    $scope.showContent=false;
    $scope.message='';

    $scope.opc= $("#opc").val();
    $scope.exportExcel = function () {
        var data = {
            'opc': $scope.opc, 'ambito': $scope.ambito
        };
        data = serializeObj(data);
        location.href = C_SERVER + "consulta/credencial-mmesa/exporta?" + data;
    };

    $scope.consultarCredMMEsa = function () {
        
        if ($scope.opc === '1') {
            $scope.nameFirstColumn = 'ODPE';
        } else if ($scope.opc === '2') {
            $scope.nameFirstColumn = 'DISTRITO';
        }
        $scope.isBusy=true;
        $scope.showContent=true;
        $scope.showTable=false;
        loading.html(LOADING_GIF);
        $http({
            method: 'POST',
            url: C_SERVER + 'consulta/credencial-mmesa/cred-mmesa-odpe',
            data: {'opc': $scope.opc, 'ambito': $scope.ambito}
        }).then(function successCallback(response) {
             $scope.currentPage = 1;
             $scope.totalItems = response.data.data.length;
            $scope.showMessage=!response.data.success;
            $scope.message=response.data.message;
            if (response.data.success) {
                $scope.sumTotalMesas = 0;
                $scope.sumTotalMMesa = 0;
                $scope.sumEntregadas = 0;
                $scope.sumNoEntregadas = 0;
                $scope.sumPorcEntregadas = 0;
                $scope.showTable = true;
                $scope.lista=response.data.data;
                //$scope.showPagination=$scope.lista.length>$scope.numPerPage;
                $scope.filtering();
                    angular.forEach($scope.lista, function (val, key) {
                        $scope.sumTotalMesas = $scope.sumTotalMesas + parseInt(val.total_mesas);
                        $scope.sumTotalMMesa = $scope.sumTotalMMesa + parseInt(val.tota_mm);
                        $scope.sumEntregadas = $scope.sumEntregadas + parseInt(val.entregadas);
                        $scope.sumNoEntregadas = $scope.sumNoEntregadas + parseInt(val.no_entregadas);
                        //console.log((parseFloat($scope.sumEntregadas)+parseFloat($scope.sumNoEntregadas)));
                    });

                    $scope.sumPorcEntregadas = (parseFloat($scope.sumEntregadas)/(parseFloat($scope.sumEntregadas)+parseFloat($scope.sumNoEntregadas)))*100;
            } else {
                $scope.showTable = true;
            }
            $scope.isBusy=false;
            loading.html('');
        }, function errorCallback(response) {
            $scope.isBusy=false;
            loading.html('');
        });
    };

      $scope.$watch("currentPage + numPerPage", function() {
          $scope.filtering();
      });
      $scope.filtering=function(){
        var begin = (($scope.currentPage - 1) * $scope.numPerPage), end = begin + $scope.numPerPage;
        $scope.filterLista = $scope.lista.slice(begin, end);
      }

    $scope.enableCombo = function () {
        $scope.showComboOdpe = true;
        $scope.showTable = false;

    };
    $scope.disableCombo = function () {
        $scope.showComboOdpe = false;
        $scope.showTable = false;
    };

});

