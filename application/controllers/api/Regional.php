<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
// require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Regional extends REST_Controller {

    protected $methods = [
            'kodepos_get' => ['level' => 1]
        ];

    public function __construct($config = 'rest') {
    	parent::__construct();
    	$this->load->model('regional_model');
    }

    public function kodepos_get()
    {
      $search = $this->get('desa');
      if(!$search) {
        $search = $this->get('kelurahan');
      }

      if(!$search){
        $this->response([
            'status' => FALSE,
            'message' => 'tidak ada keyword untuk pencarian desa/kelurahan'
        ], REST_Controller::HTTP_BAD_REQUEST);
      } else {
        $kodepos = $this->regional_model->getKodePosByDesa( $search );
        $this->response( $kodepos, REST_Controller::HTTP_OK );
      }
    }

}

?>