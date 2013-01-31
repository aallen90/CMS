 <?php if($usertype == 'admin')
 {
 echo '<!-- Task Assignment-->
		<div class="span5">
			<h2>Assign a Task</h2>
			<form class=" form-horizontal"><h5>Fill out the form below to assign a task.</h5>
				<div class="control-group">
					<label class="control-label" for="techassign">Select a Tech</label>
						<div class="controls">
						<select id="techassign">
							<option>Free-for-All</option>
							<option>Austin</option>
							<option>John</option>
							<option>Joe</option>
						</select>
						</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="clientassign">Select a Client</label>
					<div class="controls">
						<select id="clientassign">
							<option>Haggerty Buick</option>
							<option>Haggerty Chevrolet</option>
							<option>Haggerty Ford</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="descripassign">Description</label>
					<div class="controls">
						<textarea id="descripassign" rows="4" placeholder="Please enter in a description..."></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="dateassign">Activate on</label>
					<div class="controls">
						<div id="dateassign" class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
							<input class="span2" id="dp1" type="text" placeholder="Select a date"></div>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button class="btn btn-warning" href="#">Assign</button>
					</div>
				</div>
			</form>
		</div> <!-- /Assignment -->
		';
}?>
<div class="span5">
			<h2>Complete a Task</h2>
				<form class="form-horizontal"><h5>Fill out the form below to complete a task.</h5>
					<div class="control-group">
						<label class="control-label" for="clientcomplete">Select the Client</label>
						<div class="controls">
							<select id="clientcomplete">
								<option>Haggerty Buick</option>
								<option>Haggerty Chevrolet</option>
								<option>Haggerty Ford</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="startdate">Start Date</label>
						<div class="controls">
							<div id="startdate" class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
							<input class="span2" id="dp2" type="text" placeholder="Select a date"></div>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="starttime">Start Time</label>
						<div id="starttime" class="controls">
							<select class="span1">
								<option>12</option>
								<option>01</option>
								<option>02</option>
								<option>03</option>
								<option>04</option>
								<option>05</option>
								<option>06</option>
								<option>07</option>
								<option>08</option>
								<option>09</option>
								<option>10</option>
								<option>11</option>
							</select>
							<select class="span1">
								<option>00</option>
								<option>30</option>
							</select>
							<select class="span1">
								<option>AM</option>
								<option>PM</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="finishdate">Finish Date</label>
						<div class="controls">
							<div id="finishdate" class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
							<input class="span2" id="dp3" type="text" placeholder="Select a date"></div>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="finishtime">Finish Time</label>
						<div id="finishtime" class="controls">
							<select class="span1">
								<option>12</option>
								<option>01</option>
								<option>02</option>
								<option>03</option>
								<option>04</option>
								<option>05</option>
								<option>06</option>
								<option>07</option>
								<option>08</option>
								<option>09</option>
								<option>10</option>
								<option>11</option>
							</select>
							<select class="span1">
								<option>00</option>
								<option>30</option>
							</select>
							<select class="span1">
								<option>AM</option>
								<option>PM</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="tasktype">Task Type</label>
						<div class="controls">
							<select id="tasktype">
								<option>Project</option>
								<option>Maintenence</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="descripcomplete">Description</label>
						<div class="controls">
						<textarea id="descripcomplete" rows="4" placeholder="Please enter in a detailed description of what you did..."></textarea>
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
							<button class="btn btn-success" href="#">Complete</button>
						</div>
					</div>
				</form>
		</div> <!-- /Complete Task -->