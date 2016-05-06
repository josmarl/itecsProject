app.controller("ctrlCredencial", function($scope, $http) {
  $scope.isBusy=false;
  //loading=$("#loading");
  $scope.dni='';
  $scope.showContent=true;
  $scope.showMessage=false;
  $scope.message='';
  $scope.success='';
  $scope.repeat='';
  $scope.mmesas=[];

  $scope.add=function(){
    $scope.isBusy=true;
    //loading.html(LOADING_GIF);
    $http({
      method: 'POST',
      url: C_SERVER+'credencial/search',
      data:{'dni':$scope.dni}
    }).then(function successCallback(response) {
      //loading.html('');
      if(response.data.success){
        $scope.list();
      }
      $scope.isBusy=false;
      $scope.showMessage=true; 
      $scope.message=response.data.message;
      $scope.success=response.data.success;
      $scope.repeat=response.data.repeat;
      $scope.dni='';
    }, function errorCallback(response) {
      //loading.html('');
      $scope.isBusy=false;
    });
  }

  $scope.remove = function(dni){
    $http({
      method: 'POST',
      url: C_SERVER+'credencial/remove',
      data:{'dni':dni}
    }).then(function successCallback(response) {
      $('#modalDeleteCredencial').modal('toggle');
      if(response.data.success){
        $scope.list();        
      }
      $scope.showMessage=true; 
      $scope.message=response.data.message;
      $scope.dni='';
    }, function errorCallback(response) {
    });
  }

  $scope.list = function(){
    $http({
      method: 'POST',
      url: C_SERVER+'credencial/list',
    }).then(function successCallback(response) {
      $scope.showMessage=true;
      $scope.mmesas=response.data;
      if(response.data.length==0){
        $scope.showContent=false;
      }else{
        $scope.showContent=true;
      }
    }, function errorCallback(response) {
    });
  }
   $scope.list();
  
});
