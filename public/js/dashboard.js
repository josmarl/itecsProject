/*app.controller("ctrlDashboard", function ($scope, $http) {

    $scope.proceso = 'EVA_EG_2016';
    $scope.modelProceso = '';
    $scope.dataProcesos = [];
    $scope.dataModulos = [];

    

    $scope.loadProcesos = function () {
        $http.get(C_SERVER + "usuario/procesos").
                success(function (data, status, headers, config) {
                    for (x = 0; x < data.length; x++) {
                        $scope.dataProcesos[x] = data[x];
                    }
                });
    };

    $scope.loadProcesos();

    $scope.changeProceso = function () {

        if ($scope.modelProceso == null) {
            $http.get(C_SERVER + "usuario/esquema/" + $scope.proceso).
                    success(function (data, status, headers, config) {
                        for (x = 0; x < data.length; x++) {
                            $scope.dataProcesos[x] = data[x];
                        }
                    });

        } else {
            $http.get(C_SERVER + "usuario/esquema/" + $scope.modelProceso).
                    success(function (data, status, headers, config) {
                        for (x = 0; x < data.length; x++) {
                            $scope.dataProcesos[x] = data[x];
                        }
                        $http.get(C_SERVER + "usuario/modulos").
                                success(function (data, status, headers, config) {
                                    for (x = 0; x < data.length; x++) {
                                        $scope.dataModulos[x] = data[x];
                                    }
                                });
                    });
        }
    };

    $scope.moduloMenu = function (param) {
        //location.href = C_SERVER + "modulos/index/" + param;
        $http({
      method: 'POST',
      url: C_SERVER+'modulos/index',
      data:{'dni':$scope.dni}
    }).then(function successCallback(response) {
      $scope.showMessage=true; 
      $scope.showContent=false;
      $scope.message=response.data.message;
    }, function errorCallback(response) {
      $scope.showContent=false;
    });
    };

});*/

$(function() {
    $('.slidedivs').hide();
    
    $('.showhide').mouseover(function() {
    $(".slidedivs").show();
    });
    $('.showhide').mouseout(function() {
    $(".slidedivs").hide();
    });
});

/*$(document).on('click', '.cerrar-sesion', function (event) {
    var data = {status:'2'};
    var url = BASE_URL + 'default/index/logout';
    $.get(url, data, function (response) {
        location.href = response.url;
    }, 'json');
});*/