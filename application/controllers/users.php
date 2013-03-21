<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to call PHP's session object to access it through CI

class Users extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['firstname'] = $session_data['firstname'];
			$data['usertype'] = $session_data['usertype'];
			$this->load->model('user');
			$data['emps'] = $this->user->viewemployees();
			$data['clients'] = $this->user->viewclients();
			$this->load->view('header_view', $data);
			$this->load->view('user_view', $data);
			$this->load->view('footer_view', $data);
		}
		else
		{
		//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	
	function disable($id)
	{
		$this->load->model('user');
		$this->user->disable($id);
		redirect('users', 'refresh');
	}
	
	function enable($id)
	{
		$this->load->model('user');
		$this->user->enable($id);
		redirect('users', 'refresh');
	}
	
	function editemployee()
	{
		$this->load->model('user');
		$this->user->editemployee();
		redirect('users', 'refresh');
	}
	
	function editclient()
	{
		$this->load->model('user');
		$this->user->editclient();
		redirect('users', 'refresh');
	}
	
	function addemployee()
	{
		$this->load->model('user');
		$this->user->addemployee();
		redirect('users', 'refresh');
	}
	
	function addclient()
	{
		$this->load->model('user');
		$this->user->addclient();
		redirect('users', 'refresh');
	}	
	
	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('login', 'refresh');
	}
}?>