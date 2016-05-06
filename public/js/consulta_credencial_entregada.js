app.controller("ctrlConsultaCredencial", function($scope, $http) {

  var d = new Date();
  var month = d.getMonth()+1;
  var day = d.getDate();
  var output = (day<10 ? '0' : '') + day  + '/' +
  (month<10 ? '0' : '') + month + '/' + d.getFullYear();
  $scope.isBusy=false;
  loading=$("#loading");
  $scope.style={'visibility':'visible'};
  
  
  $scope.ambito='0';
  $scope.ubigeo='0';
  $scope.usuario='0';
  $scope.entregada=true;
  $scope.fechaIni=output;
  $scope.fechaFin=output;
  $scope.ubigeos={};
  $scope.showContent=false;
  $scope.showMessage=false;
  $scope.message='';
  $scope.lista=[];
  $scope.filterLista = [];
  $scope.currentPage = 1;
  $scope.numPerPage=NUM_PER_PAGE;
  $scope.maxSize = MAX_PAGE;
  $scope.totalItems = 0;
  $scope.showPagination=false;
  


  
  $scope.getUbigeos=function(){
    $http({
      method: 'GET',
      url: C_SERVER+'ubigeo/fetch/'+$scope.ambito
    }).then(function successCallback(response) {
      $scope.ubigeos=response.data;
    }, function errorCallback(response) {

    });
  }

  $scope.exportar=function(){
    var data ={
        'ambito':$scope.ambito,
        'ubigeo':$scope.ubigeo,
        'usuario':$scope.usuario,
        'fechaIni':$scope.fechaIni,
        'fechaFin':$scope.fechaFin,
        'entregada':$scope.entregada,
    }
    data=serializeObj(data);
    location.href=C_SERVER+"consulta/cred-entregada/exporta?"+data;
  }

  $scope.habilita= function(){
      $scope.style=($scope.entregada?{'visibility':'visible'}:{'visibility':'hidden'});
      $scope.usuario='0';
  }

  $scope.consultar=function(){
    $scope.isBusy=true;
    $scope.showContent=false;
    loading.html(LOADING_GIF);
    $http({
      method: 'POST',
      url: C_SERVER+'consulta/cred-entregada',
      data:{
        'ambito':$scope.ambito,
        'ubigeo':$scope.ubigeo,
        'usuario':$scope.usuario,
        'fechaIni':$scope.fechaIni,
        'fechaFin':$scope.fechaFin,
        'entregada':$scope.entregada,
      }
    }).then(function successCallback(response) {
      loading.html('');
      $scope.currentPage = 1;
      $scope.showContent=true;
      $scope.showMessage=!response.data.success;
      $scope.message=response.data.message;
      $scope.totalItems = response.data.data.length;
      if(response.data.success){
        $scope.lista=response.data.data;
        $scope.filtering();
                if ($scope.lista.length >= 25) {
                    $scope.msgRegistros = MSG_MAX_REG;
                } else {
                    $scope.msgRegistros = '';
                }
      }else{
        $scope.lista=[];
        $scope.filterLista=[];
      }
      //$scope.showPagination=$scope.lista.length>$scope.numPerPage;
      $scope.isBusy=false;
    }, function errorCallback(response) {
      loading.html('');
      $scope.isBusy=false;
    });
  }

  $scope.$watch("currentPage + numPerPage", function() {
      $scope.filtering();
  });
  $scope.filtering=function(){
    var begin = (($scope.currentPage - 1) * $scope.numPerPage), end = begin + $scope.numPerPage;
    $scope.filterLista = $scope.lista.slice(begin, end);
  }


});

