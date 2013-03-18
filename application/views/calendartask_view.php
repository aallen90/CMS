		<div class="span4"><h2>Tasks</h2>
			<h4 id="selectedDay"><?php $selectedday=getdate();
				echo "$selectedday[month] $selectedday[mday], $selectedday[year]" ?></h4>
				<div id="dailytasks">
				
				<?php if($todaytasks == TRUE) {
				if($username == 'admin')
				{ $hrs = 0; $hrsbilled = 0 ?>
				<h5>Jerry</h5>

				<?php foreach ($todaytasks as $task) {?>
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
					<?php foreach ($todaytasks as $task) {?>
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
					<a href="#assignModal<?php echo $emp->id ?>" role="button" class="btn btn-small btn-inverse" data-toggle="modal">Assign a task</a><!-- Modal Trigger -->
				<?php } } } ?>
				
				<!-- If employee-->
				
				<?php if($usertype == 'employee') {
				foreach ($emps as $emp) { ?>
					<h5><?php if($emp->finishdate == "Active"  && $emp->username == $username){echo $emp->firstname;} ?></h5>
					<?php foreach ($todaytasks as $task) {?>
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
				foreach ($todaytasks as $task) {
					if($task->status == 'verified' && $task->client == $username)
						{
							?><i class="icon-check"></i> <?php echo $task->firstname, ' - ', $task->description, ' - ', $task->tasktype; ?><strong><?php echo ' - ', $task->hours, 'hrs. billed'; ?></strong><br><?php
						}
					}
				}
				}
				?>
				</div> <!-- /dailytasks-->
		</div> <!-- /Tasks -->
	</div> <!-- /Row -->

<!-- Assign Modal -->  
<?php foreach($emps as $emp) { ?>
<div id="assignModal<?php echo $emp->id ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabelassign<?php echo $emp->id ?>" aria-hidden="true">
	<form class=" form-horizontal" action="home/assigntask" method="post">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h3 id="myModalLabelassign<?php echo $emp->id ?>">Assign task to <?php echo $emp->firstname ?></h3>
		</div>
		<div class="modal-body">
			<h5>Fill out the form below to assign a task to <?php echo $emp->firstname ?>.</h5>
			<div class="control-group">
				<label class="control-label" for="clientassign">Select a Client</label>
				<div class="controls">
					<input type="hidden" name="techassign" value="<?php echo $emp->username ?>">
					<select name="clientassign" id="clientassign<?php echo $emp->id ?>">
					<?php foreach($clients as $client) {
						if($client->finishdate == 'Active') {
							echo '<option value="', $client->username, '">', $client->firstname, '</option>'; 
						}
					} ?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="descripassign">Description</label>
				<div class="controls">
					<textarea name="descripassign" id="descripassign<?php echo $emp->id ?>" rows="8" placeholder="Please enter in a description..."></textarea>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="dateassign">Activate on</label>
				<div class="controls">
					<div id="dateassign" class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
						<input class="span2" name="dateassign" type="date">
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			<input type="submit" value="Assign" class="btn btn-primary" />
		</div>
	</form> 
</div>
<?php } ?>

<!-- Verify Modal -->
<?php foreach($tasks as $task) { ?>
<div id="verifyTask<?php echo $task->taskid ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabelverify" aria-hidden="true">
	<form class="form-horizontal" action="home/verifytask" method="post">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h3 id="myModalLabelverify">Verify</h3>
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
				<textarea name="descripcomplete" id="descripcomplete" rows="8"><?php echo $task->description ?></textarea>
					<table class="span3">
						<tr><td>
							<label class="checkbox" id="build" rel="tooltip" data-placement="bottom" title="Taking out of box, setup on desk. Configured PC to Domain. Registered PC, Ran Updates, etc..."><input type="checkbox" > PC-Build</label>
							</td><td>
							<label class="checkbox" id="backup" rel="tooltip" data-placement="bottom" title="Backed up user data to the cloud/external"><input type="checkbox" checked> Backup</label>
						</td></tr>
					</table>
				</div>
			</div>
		</div> <!-- /Modal body -->
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			<input type="submit" value="Verify" class="btn btn-success">
		</div> <!-- /Modal footer -->
	</form>
</div> <!-- /Modal -->

<?php } ?>
</div> <!-- /Container-->