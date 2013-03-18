<!-- Task Assignment-->
		<div class="span5">
			<h2>Assign a Task</h2>
			<form class=" form-horizontal" action="tasks/assigntask" method="post"><h5>Fill out the form below to assign a task.</h5>
				<div class="control-group">
					<label class="control-label" for="techassign">Select a Tech</label>
						<div class="controls">
						<select name="techassign" id="techassign">
							<option value="ffa">Free-for-All</option>
							<?php foreach($emps as $emp) { 
								if($emp->finishdate == 'Active') {
									echo '<option value="', $emp->username, '">', $emp->firstname, ' ', $emp->lastname, '</option>'; 
								}
							} ?>
						</select>
						</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="clientassign">Select a Client</label>
					<div class="controls">
						<select name="clientassign" id="clientassign">
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
						<textarea name="descripassign" id="descripassign" rows="8" placeholder="Please enter in a description..."></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="dateassign">Activate on</label>
					<div class="controls">
						<div id="dateassign" class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
							<input name="dateassign" class="span2" id="dp1" type="text" placeholder="Select a date"></div>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<input type="submit" value="Assign" class="btn btn-warning" />
					</div>
				</div>
			</form>
		</div> <!-- /Assignment -->