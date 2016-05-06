app.controller("ctrlConsultaCredencialCargo", function($scope, $http) {

  $scope.isBusy=false;
  loading=$("#loading");

  $scope.ambito='0';
  $scope.showPagination=false;
  $scope.showContent=false;
  $scope.showMessage=false;
  $scope.message='';
  $scope.lista=[];
  $scope.filterLista = [];
  $scope.currentPage = 1;
  $scope.numPerPage=NUM_PER_PAGE;
  $scope.maxSize = MAX_PAGE;
  $scope.totalItems = 0;

  $scope.tepre=0;
  $scope.tnepre=0;
  $scope.tesec=0;
  $scope.tnesec=0;
  $scope.teter=0;
  $scope.tneter=0;
  $scope.tepsu=0;
  $scope.tnepsu=0;
  $scope.tessu=0;
  $scope.tnessu=0;
  $scope.tetsu=0;
  $scope.tnetsu=0;
  $scope.tet=0;
  $scope.tne=0;

  $scope.exportar=function(){
    var data ={
        'ambito':$scope.ambito
    }
    data=serializeObj(data);
    location.href=C_SERVER+"consulta/cred-cargo/exporta?"+data;
  }

  $scope.consultar=function(){
    $scope.isBusy=true;
    $scope.showContent=false;
    loading.html(LOADING_GIF);
  	$http({
  		method: 'POST',
  		url: C_SERVER+'consulta/cred-cargo',
  		data:{
  			'ambito':$scope.ambito
  		}
  	}).then(function successCallback(response) {
      loading.html('');
  		$scope.currentPage = 1;
  		$scope.showPagination=false;
  		$scope.showContent=true;
  		$scope.showMessage=!response.data.success;
  		$scope.message=response.data.message;
  		$scope.totalItems = response.data.data.length;
  		if(response.data.success){

          $scope.tepre=0;
          $scope.tnepre=0;
          $scope.tesec=0;
          $scope.tnesec=0;
          $scope.teter=0;
          $scope.tneter=0;
          $scope.tepsu=0;
          $scope.tnepsu=0;
          $scope.tessu=0;
          $scope.tnessu=0;
          $scope.tetsu=0;
          $scope.tnetsu=0;
          $scope.tet=0;
          $scope.tne=0;
          
  			$scope.lista=response.data.data;
  			for(var i = 0; i < $scope.lista.length; i++){
  				var item = $scope.lista[i];
  				item.te= parseFloat(item.epre)+parseFloat(item.esec)+parseFloat(item.eter)+parseFloat(item.epsu)+parseFloat(item.essu)+parseFloat(item.etsu);
  				item.tne=parseFloat(item.nepre)+parseFloat(item.nesec)+parseFloat(item.neter)+parseFloat(item.nepsu)+parseFloat(item.nessu)+parseFloat(item.netsu);
  				item.perc= $scope.getPercentage(item.te,item.tne);
  				$scope.tepre += parseFloat(item.epre);
  				$scope.tnepre += parseFloat(item.nepre);
  				$scope.tesec+= parseFloat(item.esec);
  				$scope.tnesec+= parseFloat(item.nesec);
  				$scope.teter+= parseFloat(item.eter);
  				$scope.tneter+= parseFloat(item.neter);
  				$scope.tepsu+= parseFloat(item.epsu);
  				$scope.tnepsu+= parseFloat(item.nepsu);
  				$scope.tessu+= parseFloat(item.essu);
  				$scope.tnessu+= parseFloat(item.nessu);
  				$scope.tetsu+= parseFloat(item.etsu);
  				$scope.tnetsu+= parseFloat(item.netsu);
  				$scope.tet+=parseFloat(item.te);
  				$scope.tne+=parseFloat(item.tne);
  			}
  			$scope.filtering();
  		}else{
        $scope.filterLista=[];
      }
      $scope.isBusy=false;
  	}, function errorCallback(response) {
      loading.html('');
      $scope.isBusy=false;
  	});
  }

  $scope.$watch("currentPage + numPerPage", function() {
      $scope.filtering();
  });

  $scope.getPercentage= function(var01,var02){
  	return  (parseFloat(var01)/((parseFloat(var01)+parseFloat(var02))==0?1:(parseFloat(var01)+parseFloat(var02))) *100);
  }

  $scope.filtering=function(){
    var begin = (($scope.currentPage - 1) * $scope.numPerPage), end = begin + $scope.numPerPage;
    $scope.filterLista = $scope.lista.slice(begin, end);
  }


});

