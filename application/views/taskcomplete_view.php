<div class="span5">
			<h2>Complete a Task</h2>
				<form class="form-horizontal" action="tasks/completetask" method="post"><h5>Fill out the form below to complete a task.</h5>
					<?php if ( $usertype == 'employee' )
					{ ?>
					<div class="control-group">
						<label class="control-label" for="taskid">Assigned task</label>
						<div class="controls">
							<select name="taskid">
								<option value="ffa">Free-For-All</option>
								<?php foreach($tasks as $task) {
								    if($task->tech == $username) {	
										if($task->status == 'active')
										{
											?><option value="<?php echo $task->taskid ?>"> <?php echo $task->description; ?> </option><?php
										}
									}
								} ?>
							</select>
						</div>
					</div>
					<?php } ?>
					<div class="control-group">
						<label class="control-label" for="clientcomplete">Select the Client</label>
						<div class="controls">
							<select name="clientcomplete" id="clientcomplete">
								<?php foreach($clients as $client) {
								 if($client->finishdate == 'Active') {
										echo '<option value="', $client->username, '">', $client->firstname, '</option>'; 
									}
								 } ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="startdate">Start Date</label>
						<div class="controls">
							<div id="startdate" class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
							<input name="startdate" class="span2" id="dp2" type="text" placeholder="Select a date"></div>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="starttime">Start Time</label>
						<div id="starttime" class="controls">
							<input name="starttime" type="time" class="span2"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="finishdate">Finish Date</label>
						<div class="controls">
							<div id="finishdate" class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
							<input name="finishdate" class="span2" id="dp3" type="text" placeholder="Select a date"></div>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="finishtime">Finish Time</label>
						<div id="finishtime" class="controls">
							<input name="finishtime" type="time" class="span2" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="tasktype">Task Type</label>
						<div class="controls">
							<select name="tasktype" id="tasktype">
								<option>Project</option>
								<option>Maintenence</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="descripcomplete">Description</label>
						<div class="controls">
						<textarea name="descripcomplete" id="descripcomplete" rows="8" placeholder="Please enter in a detailed description of what you did..."></textarea>
						<span class="help-block">You may also select a predefined action below to save time.</span>
							<table class="span3">
								<tr><td>
									<label class="checkbox" id="build" rel="tooltip" data-placement="bottom" title="Taking out of box, setup on desk. Configured PC to Domain. Registered PC, Ran Updates, etc...""><input type="checkbox" > PC-Build</label>
									</td><td>
									<label class="checkbox" id="backup" rel="tooltip" data-placement="bottom" title="Backed up user data to the cloud/external""><input type="checkbox" > Backup</label>
								</td></tr>
							</table>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<input type="submit" value="Complete"class="btn btn-success" />
						</div>
					</div>
				</form>
		</div> <!-- /Complete Task -->
	</div> <!-- /Row -->