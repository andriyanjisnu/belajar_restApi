<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mahasiswa extends REST_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('M_mahasiswa');

		$this->methods['index_get']['limit'] = 100;
		$this->methods['index_delete']['limit'] = 5;
	}
	
	public function index_get(){

		$id = $this->get('id');
		if ($id === null){
			$mahasiswa = $this->M_mahasiswa->getMahasiswa();
		}
		else{
			$mahasiswa = $this->M_mahasiswa->getMahasiswa($id);
		}
		

		if ($mahasiswa){
		 	$this->response([
                    'status' => TRUE,
                    'data' => $mahasiswa
                ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
		}
		else {
			$this->response([
                    'status' => FALSE,
                    'message' => 'id not found'
                ], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_delete(){

		$id = $this->delete('id');

		if ($id === null) {
			$this->response([
                    'status' => FALSE,
                    'message' => 'provide an id'
            	], REST_Controller::HTTP_BAD_REQUEST);
		}
		else {
			 if ($this->M_mahasiswa->deleteMahasiswa($id) > 0){

			 	$this->response([
                    'status' => TRUE,
                    'id' => $id,
                    'message' => 'deleted'
                ], REST_Controller::HTTP_NO_CONTENT);
			 }
			 else {

			 	$this->response([
                    'status' => FALSE,
                    'message' => 'id not found'
            	], REST_Controller::HTTP_BAD_REQUEST);
			 }
		}
	}

	public function index_post(){

		$data = [
				'nrp' => $this->post('nrp'),
				'nama' => $this->post('nama'),
				'email' => $this->post('email'),
				'jurusan' => $this->post('jurusan')
			];

		if($this->M_mahasiswa->createMahasiswa($data) > 0){

			$this->response([
                    'status' => TRUE,
                    'message' => 'new mahasiswa has been created'
                ], REST_Controller::HTTP_CREATED);
		}
		else {

			$this->response([
                    'status' => FALSE,
                    'message' => 'Failed'
            	], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function index_put(){

		$id = $this->put('id');
		$data = [
				'nrp' => $this->put('nrp'),
				'nama' => $this->put('nama'),
				'email' => $this->put('email'),
				'jurusan' => $this->put('jurusan')
			];

		if($this->M_mahasiswa->updateMahasiswa($data, $id) > 0){

			$this->response([
                    'status' => TRUE,
                    'message' => 'modify mahasiswa has been updated'
                ], REST_Controller::HTTP_NO_CONTENT);
		}
		else {

			$this->response([
                    'status' => FALSE,
                    'message' => 'Failed'
            	], REST_Controller::HTTP_BAD_REQUEST);

		}
	}
}