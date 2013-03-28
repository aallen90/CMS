<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to call PHP's session object to access it through CI

class Terms extends CI_Controller
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
            $data['terms'] = $this->user->showterms();
            $this->load->view('terms_view', $data);
            $this->load->view('footer_view', $data);
        }
        else
        {
        //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
	
	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('login', 'refresh');
	}
	
	function editterm()
	{
		$this->load->model('user');
		$this->user->editterm();
		redirect('terms', 'refresh');
	}
	
	function addterm()
	{
		$this->load->model('user');
		$this->user->addterm();
		redirect('terms', 'refresh');
	}
	
	function removeterm($id)
	{
		$this->load->model('user');
		$this->user->removeterm($id);
		redirect('terms', 'refresh');		
	}
	
	
}?>
