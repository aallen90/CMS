<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to call PHP's session object to access it through CI

class Reports extends CI_Controller
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
			$this->load->helper('date');
			$data['tasks'] = $this->user->showtask();
			$data['clients'] = $this->user->viewclients();
			$data['logs'] = $this->user->showservicelogs();
			$this->load->view('reports_view', $data);
			$this->load->view('footer_view', $data);
		}
		else
		{
		//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	
	function verifytask()
	{
		$this->load->model('user');
		$this->user->verifytask();
		redirect('reports', 'refresh');
	}
	
	function showservicelogrange($first_date, $second_date)
	{
		$this->load->model('user');
		$emps = $this->user->viewemployees();
		$clients = $this->user->viewclients();
		$logs = $this->user->showservicelogrange($first_date, $second_date);
		if( $logs == TRUE)
		{
		?>
		<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>Date</th>
						<th>Client Site</th>
						<th>Hours</th>
						<th>Category</th>
						<th>Tech</th>
						<th>Description</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach( $logs as $log) { 
					if ( $log->status == 'verified' ) { ?>
					<tr>
						<td><?php echo $log->finishdate ?></td>
						<td><?php echo $log->client; ?></td>
						<td><?php echo $log->hours; ?></td>
						<td><?php echo $log->tasktype; ?></td>
						<td><?php echo $log->firstname; ?></td>
						<td><?php echo $log->description; ?></td>
						<td><a href="#editLog<?php echo $log->taskid; ?>" role="button" class="btn btn-small btn-info" data-toggle="modal">Edit</a><!-- Modal Trigger --></td>
					</tr>
				<?php } } ?>
				</tbody>
			</table><br><br><br><br><br>
			
			<?php foreach($logs as $task) { ?>
				<div id="editLog<?php echo $task->taskid ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabelverify" aria-hidden="true">
					<form class="form-horizontal" action="reports/verifytask" method="post">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
							<h3 id="myModalLabelverify">Edit</h3>
						</div>
						<div class="modal-body">
							<h5><?php echo $task->firstname ?>'s task</h5>
							<div class="control-group">
								<label class="control-label" for="clientassign">Select a Client</label>
								<div class="controls">
									<input name="taskid" type="hidden" value="<?php echo $task->taskid ?>">
									<input name="techverify" type="hidden" value="<?php echo $task->tech ?>">
									<select name="clientassign" id="clientassign<?php echo $emp->id ?>">
										<?php foreach($clients as $client) {
											if($client->finishdate == 'Active') { ?>
												<option <?php if($task->client == $client->username){ echo 'selected';} ?> value="<?php echo $client->username, '">', $client->firstname, '</option>'; 
											}
										} ?>
									</select>
								</div> <!-- /Controls -->
							</div>
							<div class="control-group">
								<label class="control-label" for="startdate">On</label>
								<div class="controls">
									<div  id="startdate" class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
									<input name="startdate" class="span2" type="date" value="<?php echo $task->activation ?>"></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="starttime">Start Time</label>
								<div name="starttime" id="starttime" class="controls">
									<input name="starttime" type="time" class="span2" value="<?php echo $task->starttime ?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="finishdate">Till</label>
								<div class="controls">
									<div id="finishdate" class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
									<input name="finishdate" class="span2" type="date" value="<?php echo $task->finishdate ?>"></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="finishtime">Finish Time</label>
								<div name="finishtime" id="finishtime" class="controls">
									<input name="finishtime" type="time" class="span2" value="<?php echo $task->finishtime ?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="tasktype">Type</label>
								<div class="controls">
									<select name="tasktype" id="tasktype">
										<option <?php if($task->tasktype == 'Project'){ echo 'selected';} ?>>Project</option>
										<option <?php if($task->tasktype == 'Maintenance'){ echo 'selected';} ?>>Maintenence</option>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="descripcomplete">Description</label>
								<div class="controls">
								<textarea name="descripcomplete" id="descripcomplete" rows="8"><?php echo $task->description; ?></textarea>
								</div>
							</div>
						</div> <!-- /Modal body -->
						<div class="modal-footer">
							<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
							<input type="submit" value="Save Changes" class="btn btn-success">
						</div> <!-- /Modal footer -->
					</form>
				</div> <!-- /Modal -->
		<?php
		}
		}
		else
		{
			?><h5>No logs  are available for this date range.</h5><br><br><br><br><br><br><br><br><br><br><br><br><br><br><?php
		}
	}

}