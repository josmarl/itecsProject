<?php

class CapacitacionController extends BaseController {

    private $response;
    protected $layout = 'layout.master';

    public function index() {
        Config::set('database.default', "mysql");
        return View::make('capacitaciones.index');
    }

    public function listaTipoCapacitacion() {

        $this->response = new StdClass();
        $this->response->success = false;
        $this->response->message = Messages::ERROR;

        $tipoCapacitacion = new TipoCapacitacion();
        $lista = $tipoCapacitacion->listaTipoCapac();

        if ($lista !== '') {
            $this->response->success = true;
            $this->response->message = '';
            $this->response->data = $lista;
        }
        return json_encode($this->response);
    }

    public function uploadExcelCap() {

        $this->response = new StdClass();
        $this->response->success = false;
        $this->response->message = Messages::ERROR;
        $this->response->totalRegistry = 0;
        $this->response->repeatRegistry = 0;

        $allowed = array('xls', 'xlsx', 'csv');

        if (isset($_FILES['file']['error']) != 0) {

            $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

            if (!in_array(strtolower($extension), $allowed)) {

                $this->response->message = Messages::ERROR_UPLOAD_FILE;
                $this->response->data = '';
                $this->response->success = false;
                return json_encode($this->response);
                exit;
            }
            if (move_uploaded_file($_FILES['file']['tmp_name'], $this->retornarRutaArchivos() . $_FILES['file']['name'])) {

                $archivo = $_FILES['file']['name'];
                $var = $this->retornarRutaArchivos() . $_FILES['file']['name'];

                $inputFileName = $var;
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    //$sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                } catch (Exception $e) {
                    $arregloErrores[] = null;
                    $this->response->message = Messages::ERROR_ESTRUCTURE_FILE;
                    $this->response->data = $arregloErrores;
                    $this->response->success = false;
                    return $this->response;
                }

                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
            }

            $countRow = 0;
            $repeatRegistry = 0;

            for ($row = 8; $row <= $highestRow; $row++) {

                $nro = trim($sheet->getCellByColumnAndRow(0, $row)->getValue());
                $dni = trim($sheet->getCellByColumnAndRow(1, $row)->getValue());

                if (!empty($nro) && !empty($dni)) {
                    $obj = new stdClass;
                    $obj->nro = $nro;
                    $obj->dni = $dni;
                    $data[] = $obj;
                    $countRow = $countRow + 1;
                }
            }

            $this->response->message = Messages::SUCCESS_UPLOAD_FILE;
            $this->response->data = $data;
            $this->response->success = true;
            $this->response->totalRegistry = Messages::MSG_TOTAL_REGISTRY_UPLOAD . $countRow;
            $this->response->repeatRegistry = $repeatRegistry;

            return json_encode($this->response);
        } else {
            $this->response->message = Messages::ERROR_ESTRUCTURE_FILE;
            $this->response->data = '';
            $this->response->success = false;
            return json_encode($this->response);
        }
    }

}
