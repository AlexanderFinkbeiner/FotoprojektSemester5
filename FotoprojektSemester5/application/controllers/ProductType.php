<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
include_once (dirname ( __FILE__ ) . "/UserRole.php");
class ProductType extends CI_Controller {
	public function index() {
		$this->load->template ( 'product/single_product_type_view' );
	}
	public function showSingleProductType($prty_id) {
		$this->load->model ( 'product_type_model' );
		$data ['product_type'] = $this->product_type_model->get_product_type_by_id ( $prty_id );
		$this->load->template ( 'product/single_product_type_view', $data );
	}
	public function product_types() {
		$this->load->model ( 'product_type_model' );
		$this->load->model ( 'User_model' );
		$data ['product_types'] = ProductType::getAllProductType ();
		
		$user_id = $this->session->userdata ( 'user_id' );
		$user = $this->User_model->get_user_by_id ( $user_id );
		if ($user [0]->user_role_id == UserRole::Admin)
			$users = $this->User_model->getAllPhotographer ( true );
		else
			$users = $user;
		$data ['users'] = $users;
		$this->load->template ( 'admin/product_type_view', $data );
	}
	public static function getAllProductType() {
		$CI = & get_instance ();
		$CI->load->model ( 'product_type_model' );
		$user_id = $CI->session->userdata ( 'user_id' );
		$user = $CI->User_model->get_user_by_id ( $user_id );
		if ($user [0]->user_role_id == UserRole::Admin)
			$product_types = $CI->product_type_model->getAllProductType ();
		else
			$product_types = $CI->product_type_model->getAllProductTypeForUser ( $user_id );
		
		return $product_types;
	}
	public function addProductType() {
		$this->form_validation->set_rules ( 'prty_description', 'prty_description', 'trim|required|min_length[3]|max_length[30]' );
		if ($this->form_validation->run () == FALSE) {
			// fails
			$this->load->view ( 'ProductType\product_types' );
		} else {
			$this->load->model ( 'product_type_model' );
			$prpr_id = $this->input->post ( 'prpt_prpr_id' );
			$prty_description = $this->input->post ( 'prty_description' );
			$prty_type = $this->input->post ( 'prty_type' );
			$prty_height = $this->input->post ( 'prty_height' );
			$prty_width = $this->input->post ( 'prty_width' );
			$prty_user_id = $this->input->post ( 'prty_user_id' );
			
			$data = array (
					'prty_description' => $prty_description,
					'prty_type' => $prty_type,
					'prty_height' => $prty_height,
					'prty_width' => $prty_width,
					'prty_user_id' => $prty_user_id 
			);
			
			$price_profile = $this->product_type_model->insert_product_type ( $data );
			redirect ( 'ProductType\product_types' );
		}
	}
}
abstract class ProductPrintType {
	const undefined = 0;
	const print = 1;
	const download = 2;
	const mixed = 3;
	const article = 4;
}