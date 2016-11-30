<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'html'));
		$this->load->library('session');
	}
	

	public function index()
	{	

		$this->load->view('general/header_view');
		$this->load->view('general/navbar_visitor_view');
		$this->load->view('start_view');
		$this->load->view('general/footer_view');
	}

}