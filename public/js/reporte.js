
app.directive('dynamic', function ($compile) {
  return {
    restrict: 'A',
    replace: true,
    link: function (scope, ele, attrs) {
      scope.$watch(attrs.dynamic, function(html) {
        ele.html(html);
        $compile(ele.contents())(scope);
      });
    }
  };
});

app.controller("ctrlReporte", function($scope, $http) {
	$scope.option='';
	$scope.change=function(){
		//$("#reportContainer").css('display','none');
		if($scope.option!==''){
			$http({
		  		method: 'GET',
		  		url: $scope.option
		  	}).then(function successCallback(response) {
		  		$scope.html = response.data;
		  		$("#reportContainer").hide().fadeIn(2000);
		  		//$('#reportContainer').fadeIn(2000);
		  	}, function errorCallback(response) {
		  	});	
		}else{
			$scope.html = '';
		}
	}
});

