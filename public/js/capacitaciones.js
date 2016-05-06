'use strict';

var app = angular
        .module("app", ['angularFileUpload'], function ($interpolateProvider) {
            $interpolateProvider.startSymbol('[[');
            $interpolateProvider.endSymbol(']]');
        });


app.controller("ctrlCapacitacion", ['$scope', 'FileUploader', '$http', function ($scope, FileUploader, $http) {

        $scope.message = '';
        $scope.messageUpload = '';
        $scope.showCarga = false;
        $scope.showProgressComplete = false;
        $scope.totalRowsUploaded = '';

        var uploader = $scope.uploader = new FileUploader({
            url: "../capacitaciones/doUploadExcel"
        });

        uploader.filters.push({
            name: 'customFilter',
            fn: function (item /*{File|FileLikeObject}*/, options) {
                return this.queue.length < 10;
            }
        });

        // CALLBACKS
        uploader.onWhenAddingFileFailed = function (item /*{File|FileLikeObject}*/, filter, options) {
            //console.info('onWhenAddingFileFailed', item, filter, options);
        };
        uploader.onAfterAddingFile = function (fileItem) {
            //console.info('onAfterAddingFile', fileItem);
        };
        uploader.onAfterAddingAll = function (addedFileItems) {
            //console.info('onAfterAddingAll', addedFileItems);
        };
        uploader.onBeforeUploadItem = function (item) {
            $scope.showProgressComplete = true;
        };
        uploader.onProgressItem = function (fileItem, progress) {

        };
        uploader.onProgressAll = function (progress) {

        };
        uploader.onSuccessItem = function (fileItem, response, status, headers) {
            //console.info('onSuccessItem', fileItem, response, status, headers);
        };
        uploader.onErrorItem = function (fileItem, response, status, headers) {
            //console.info('onErrorItem', fileItem, response, status, headers);
        };
        uploader.onCancelItem = function (fileItem, response, status, headers) {
            //console.info('onCancelItem', fileItem, response, status, headers);
        };
        uploader.onCompleteItem = function (fileItem, response, status, headers) {

            $scope.dataExcelCap = response.data;
            $scope.uploadComplete = 'Completo';
            $scope.messageUpload = response.message;
            $scope.totalRowsUploaded = response.totalRegistry;
            $scope.submitMe = function () {

            };

        };
        uploader.onCompleteAll = function () {

        };

        $scope.importFileCap = false;
        $scope.inputImportCap = '';

        $scope.lstTipoCapacitacion = function () {

            $http.get(C_SERVER + "capacitaciones/lstTiposCapacitacion").
                    success(function (data, status, headers, config) {
                        $scope.listTipoCap = data.data;
                    });
        };

        $scope.lstTipoCapacitacion();

        $scope.showInputFile = function (idCap) {
            $scope.idCapResult = idCap;
            if ($scope.idCapResult !== '') {
                $scope.importFileCap = true;
            }
        };

    }]);
