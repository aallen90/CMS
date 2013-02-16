<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to call PHP's session object to access it through CI

class Home extends CI_Controller
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
			$data['tasks'] = $this->user->showtask();
			$data['emps'] = $this->user->viewemployees();
			$data['clients'] = $this->user->viewclients();
			$this->load->view('home_view', $data);
			$this->load->view('calendartask_view', $data);
		}
		else
		{
		//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	
	function calendar()
	{
		
	}
	
	function assigntask()
	{
		$this->load->model('user');
		$this->user->assigntask();
		redirect('home', 'refresh');
	}
	
	function verifytask()
	{
		$this->load->model('user');
		$this->user->verifytask();
		redirect('home', 'refresh');
	}
	
	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('login', 'refresh');
	}
}?>
