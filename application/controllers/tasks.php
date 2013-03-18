<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to call PHP's session object to access it through CI

class Tasks extends CI_Controller
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
			$this -> load -> model('user');
			$data['tasks'] = $this->user->showtask();
			$data['emps'] = $this->user->viewemployees();
			$data['clients'] = $this->user->viewclients();
			$this->load->view('header_view', $data);
			if ($session_data['usertype'] == 'admin') //loads the task assignment if admin
			{
				$this->load->view('taskassign_view', $data);
			}
				$this->load->view('taskcomplete_view', $data);
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
	
	function assigntask()
	{
		$this->load->model('user');
		$this->user->assigntask();
		redirect('tasks', 'refresh');
	}
	
	function completetask()
	{
		$this->load->model('user');
		$this->user->completetask();
		redirect('tasks', 'refresh');
	}	
	
	
    function showtaskbydate($date)
	{
        $this->load->model('user');
        $tasks = $this->user->showtaskbydate($date);
		
		
		$session_data = $this->session->userdata('logged_in');
		$username = $session_data['username'];
		$firstname = $session_data['firstname'];
		$usertype = $session_data['usertype'];
		$this->load->model('user');
		$ffas = $this->user->showffas();
		$emps = $this->user->viewemployees();
		$clients = $this->user->viewclients();
		
		if($tasks == TRUE) {
		if($username == 'admin')
		{ 
			$hrs = 0.0; $hrsbilled = 0.0 ?>
			<h5>Jerry</h5>

			<?php foreach ($tasks as $task) {?>
				<?php if($task->tech == 'admin')
					{		
						if($task->status == 'completed')
						{
							?><i class="icon-chevron-right"></i> <strong><?php echo $task->client ?></strong><?php echo ' - ', $task->description, ' - ', $task->tasktype; ?><strong><?php echo ' - ', $task->hours, 'hrs.'; $hrs += $task->hours ?></strong> <a href="#verifyTask<?php echo $task->taskid ?>" role="button" class="btn btn-small btn-info" data-toggle="modal">Verify</a><br><?php
						}
						elseif($task->status == 'verified')
						{
							?><i class="icon-check"></i> <strong><?php echo $task->client; ?></strong><?php echo ' - ', $task->description, ' - ', $task->tasktype; ?><strong><?php echo ' - ', $task->hours, 'hrs. billed'; $hrsbilled += $task->hours ?></strong> <a href="#verifyTask<?php echo $task->taskid ?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Edit</a><br><?php
						}
					} 
				} ?>
				<?php foreach ($emps as $emp) {?>
					<h5><?php if($emp->finishdate == "Active"){echo $emp->firstname;} ?></h5>
					<?php foreach ($tasks as $task) {?>
					<?php if($task->tech == $emp->username)
						{		
							if($task->status == 'completed')
							{
								?><i class="icon-chevron-right"></i> <strong><?php echo $task->client; ?></strong><?php echo ' - ', $task->description, ' - ', $task->tasktype; ?><strong><?php echo ' - ', $task->hours, 'hrs.'; ?></strong> <a href="#verifyTask<?php echo $task->taskid ?>" role="button" class="btn btn-small btn-info" data-toggle="modal">Verify</a><br><?php
							}
							elseif($task->status == 'verified')
							{
								?><i class="icon-check"></i> <strong><?php echo $task->client; ?></strong><?php echo ' - ', $task->description, ' - ', $task->tasktype; ?><strong><?php echo ' - ', $task->hours, 'hrs. billed'; ?></strong> <a href="#verifyTask<?php echo $task->taskid ?>" role="button" class="btn btn-mini btn-success" data-toggle="modal">Edit</a><br><?php
							}
							elseif($task->status == 'active')
							{
								?><i class="icon-bell"></i> <strong><?php echo $task->client; ?></strong><?php echo ' - ', $task->description; ?><br><?php
							}
						}?>
					<?php } if($emp->finishdate == 'Active') { ?>
					&nbsp;&nbsp;<a href="#assignModal<?php echo $emp->id ?>" role="button" class="btn btn-small btn-inverse" data-toggle="modal">Assign a task</a><!-- Modal Trigger -->
				<?php } } 
		} ?>
				
				<!-- If employee-->
				
				<?php if($usertype == 'employee') {
				foreach ($emps as $emp) { ?>
					<h5><?php if($emp->finishdate == "Active"  && $emp->username == $username){echo $emp->firstname;} ?></h5>
					<?php foreach ($tasks as $task) {?>
					<?php if($task->tech == $emp->username && $task->tech == $username)
						{		
							if($task->status == 'completed')
							{
								?><i class="icon-chevron-right"></i> <strong><?php echo $task->client; ?></strong><?php echo ' - ', $task->description, ' - ', $task->tasktype; ?><strong><?php echo ' - ', $task->hours, 'hrs.'; ?></strong><br><?php
							}
							elseif($task->status == 'verified')
							{
								?><i class="icon-check"></i> <?php echo $task->client, ' - ', $task->description, ' - ', $task->tasktype, ' - ' ?><strong><?php echo $task->hours, 'hrs. billed'; ?></strong><br><?php
							}
							elseif($task->status == 'active')
							{
								?><i class="icon-bell"></i> <strong><?php echo $task->client; ?></strong><?php echo ' - ', $task->description; ?>  <a href="tasks" role="button" class="btn btn-mini btn-warning">Complete</a><br><?php
							}
						} 
					}
				} ?>
				<h5>Free-For-All</h5>
				<?php foreach ($ffas as $ffa )
				{
					?><i class="icon-bell"></i> <strong><?php echo $ffa->client; ?></strong><?php echo ' - ', $ffa->description; ?>  <a href="tasks" role="button" class="btn btn-mini btn-warning">Complete</a><br><?php
				}
				} ?>
				
				<!-- If client -->
				<?php if($usertype == 'client') {
				foreach ($tasks as $task) {
					if($task->status == 'verified' && $task->client == $username)
						{
							?><i class="icon-check"></i> <?php echo $task->firstname, ' - ', $task->description, ' - ', $task->tasktype; ?><strong><?php echo ' - ', $task->hours, 'hrs. billed'; ?></strong><br><?php
						}
					}
				}
				
		
		
        // $this->output->set_content_type('application/json')->set_output(json_encode($tasks)); FOR API Access
		}
		elseif($tasks == FALSE)
		{
			?><h5>No tasks for this day</h5><?php
		}
	}
}?>
