app.controller("ctrlBuscarMesa", function ($scope, $http) {   
    $scope.isBusy=false;
    loading=$("#loading");
    $scope.n_mesa = '';
    $scope.dataMesa = [];
    $scope.showMessage=false;
    $scope.message='';
    $scope.showResMesa = false;
    $scope.showPorMesa = true;
    $scope.showPorDistrito = false;    
    $scope.filtroMesas = '';    
    $scope.lOdpe = '';
    $scope.Odpe = '0';
    $scope.Distrito = '';
    $scope.Local = '';
    $scope.sOdpe = '';
    $scope.lengthAmbito = '';
    $scope.mesaNoAmbito = '';    
    $scope.botonExcelHabil = false;
    $scope.showPagination=false;
    $scope.numPerPage=NUM_PER_PAGE;
    $scope.maxSize = MAX_PAGE;
    $scope.totalItems = 0;
    $scope.lista=[];
    $scope.filterLista = [];
    $scope.msgRegistros = '';
    document.getElementById('q128').checked = true;
    
    $scope.porMesa = function () {
        $scope.Odpe = '0';
        $scope.Distrito = '';
        $scope.Local = '';
        $scope.lDistritos = '';
        $scope.lLocales = '';
        $scope.filtroMesas = '';
        $scope.showPagination=false;
        $scope.showPorDistrito = false; 
        $scope.showPorMesa = true;
        $scope.showResMesa = false;
    }
    
    $scope.porDistrito = function () {
        $scope.n_mesa = '';
        $scope.showPorMesa = false;
        $scope.showPorDistrito = true;  
        
        $scope.showResMesa = false;
        
        if(document.getElementById('ambito') != null){
            var ambito = document.getElementById('ambito').value; 
            $http.get(C_SERVER + "ubigeo/obtenerDistritos/" + ambito).
                success(function (response, status, headers, config) {
                    $scope.showResMesa = false;
                    if (response.success) {
                        $scope.lDistritos = response.data;
                    } else {

                    }
                });
        }       
    }
    
    $scope.listarOdpe = function () {
            $scope.Distrito = '';
            $scope.Local = '';
            $scope.lDistritos = '';
            $scope.lLocales = '';
            $scope.filtroMesas = '';
            $http.get(C_SERVER + "ubigeo/obtenerDistritos/" + $scope.Odpe).
                    success(function (response, status, headers, config) {
                        if (response.success) {
                            $scope.lDistritos = response.data;
                        } else {

                        }
                    }); 
        }
    
    $scope.listarLocal = function () {
            $scope.Local = '';
            $scope.lLocales = '';
            $scope.filtroMesas = '';
            $http.get(C_SERVER + "local/obtenerLocales/" + $scope.Distrito).
                    success(function (response, status, headers, config) {
                        $scope.lLocales = response.data;        
                        
                    });
    }
    
    $scope.searchMesa = function () {
        $scope.isBusy=true;
        $scope.showTable=false;
        $scope.showResMesa = false;
        $scope.botonExcelHabil=false;
        loading.html(LOADING_GIF);
        $http({
            method: 'POST',
            url: C_SERVER + 'consulta/searchMesa',
            data:{'mesa':$scope.n_mesa},
        }).then(function successCallback(response) {
            $scope.showResMesa = true;
            $scope.showMessage=!response.data.success;
            $scope.message=response.data.message;
            $scope.dataMesa = response.data;
            $scope.currentPage = 1;
            $scope.lista=response.data.data;
            $scope.totalItems = $scope.lista.length;
            //$scope.showPagination=$scope.lista.length>$scope.numPerPage;
            $scope.filtering();
            $scope.isBusy=false;
            loading.html('');
                if ($scope.lista.length >= 25) {
                    $scope.msgRegistros = MSG_MAX_REG;
                } else {
                    $scope.msgRegistros = '';
                }
        }, function errorCallback(response) {
            $scope.isBusy=false;
            loading.html('');
        });

    };
    
    $scope.searchDistrito = function () {     
        $scope.isBusy=true;
        $scope.showTable=false;
        $scope.showResMesa = false;
        loading.html(LOADING_GIF);
        $http({
            method: 'POST',
            url: C_SERVER + 'consulta/searchDistrito',
            data:{'filtroMesas':$scope.filtroMesas ,'local':$scope.Local,'ambito':$scope.Odpe},
        }).then(function successCallback(response) {
            $scope.currentPage = 1;
            $scope.totalItems = response.data.data.length;
            $scope.showResMesa = true;
            $scope.dataMesa = response.data;
            $scope.showMessage=!response.data.success;
            $scope.message=response.data.message;
            //$scope.showPagination=$scope.dataMesa.data.length>$scope.numPerPage;
            $scope.lista=response.data.data;
            //$scope.showPagination=$scope.lista.length>$scope.numPerPage;
            $scope.botonExcelHabil=$scope.lista.length>0;
            $scope.filtering();
            $scope.isBusy=false;
            loading.html('');
                if ($scope.lista.length>=25){
                    $scope.msgRegistros = MSG_MAX_REG;
                }else{
                    $scope.msgRegistros = '';
                }
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
    $scope.excelEstadoMesas = function () {
            var data = {'filtroMesas':$scope.filtroMesas ,'local':$scope.Local,'ambito':$scope.Odpe};
            data=serializeObj(data);
            location.href = C_SERVER + "consulta/buscar-mesa/exporta?" + data;
    }
    //$scope.listarOdpe();

});