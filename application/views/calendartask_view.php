<div class="span4"><h2>Tasks</h2>
<h4><?php $selectedday=getdate();
			echo "$selectedday[month] $selectedday[mday], $selectedday[year]" ?></h4>
		<h5>Austin</h5>
		<i class="icon-chevron-right"></i> Created calendar <a href="#verifyTask" role="button" class="btn btn-small btn-info" data-toggle="modal">Verify</a><br>
		<i class="icon-check"></i> Created login<br>
		<a href="#assignModal" role="button" class="btn btn-small btn-inverse" data-toggle="modal">Assign a task</a><!-- Modal Trigger -->
		
		<h5>John</h5>
		<i class="icon-chevron-right"></i> Fixed Hag-Ford printer issues <a href="#verifyTask" role="button" class="btn btn-small btn-info" data-toggle="modal">Verify</a><br>
		<a href="#assignModal" role="button" class="btn btn-small btn-inverse" data-toggle="modal">Assign a task</a><!-- Modal Trigger -->
		
		<h5>Joe</h5>
		<i class="icon-check"></i> Fixed Fax connections in office. Setup Body shop printers and fax.<br>
		<i class="icon-check"></i> Fixed Jack's PC, internet explorer settings had changed. I set them back.<br>
		<i class="icon-check"></i> Pulled wire for 1 user, moved sales people and others to temporary spaces.<br>
		<a href="#assignModal" role="button" class="btn btn-small btn-inverse" data-toggle="modal">Assign a task</a><!-- Modal Trigger -->
		</div>
    </div>
	
	<!-- Modal -->
<div id="assignModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabelassign" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabelassign">Assign task to [Employee]</h3>
  </div>
  <div class="modal-body">
    <form class=" form-horizontal"><h5>Fill out the form below to assign a task to [Employee].</h5>
		<div class="control-group">
			<label class="control-label" for="clientassign">Select a Client</label>
			<div class="controls">
				<select name="clientassign" id="clientassign">
					<option>Haggerty Buick</option>
					<option>Haggerty Chevrolet</option>
					<option>Haggerty Ford</option>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="descripassign">Description</label>
			<div class="controls">
				<textarea name="descripassign" id="descripassign" rows="4" placeholder="Please enter in a description..."></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="dateassign">Activate on</label>
			<div class="controls">
				<div name="dateassign" id="dateassign" class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
					<input class="span2" type="date"></div>
			</div>
		</div>
	</form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary">Assign</button>
  </div>
</div>

<div id="verifyTask" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabelverify" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabelverify">Verify</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal"><h5>[FirstName]'s task</h5>
					<div class="control-group">
						<label class="control-label" for="clientcomplete">at</label>
						<div class="controls">
							<select name="clientcomplete" id="clientcomplete">
								<option>Haggerty Buick</option>
								<option>Haggerty Chevrolet</option>
								<option>Haggerty Ford</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="startdate">On</label>
						<div class="controls">
							<div name="startdate" id="startdate" class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
							<input class="span2" type="date"></div>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="starttime">Start Time</label>
						<div name="starttime" id="starttime" class="controls">
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
						<label class="control-label" for="finishdate">Till</label>
						<div class="controls">
							<div name="finishdate" id="finishdate" class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
							<input class="span2" type="date" placeholder="Select a date"></div>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="finishtime">Finish Time</label>
						<div name="finishtime" id="finishtime" class="controls">
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
						<label class="control-label" for="tasktype">Type</label>
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
						<textarea name="descripcomplete" id="descripcomplete" rows="4" placeholder="Created calendar"></textarea>
							<table class="span3">
								<tr><td>
									<label class="checkbox" id="build" rel="tooltip" data-placement="bottom" title="Taking out of box, setup on desk. Configured PC to Domain. Registered PC, Ran Updates, etc..."><input type="checkbox" > PC-Build</label>
									</td><td>
									<label class="checkbox" id="backup" rel="tooltip" data-placement="bottom" title="Backed up user data to the cloud/external"><input type="checkbox" checked> Backup</label>
								</td></tr>
							</table>
						</div>
					</div>
				</form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-success">Verify</button>
  </div>
</div>
	
	</div> <!-- /container -->
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/fullcalendar.js"></script>
	<script type="text/javascript" src="assets/js/gcal.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="assets/js/jquery-ui.custom.min.js"></script>
	<script>
		$(function(){
			$('#dp1, #dp2, #dp3').datepicker({
				format: 'mm-dd-yyyy'
			});
		});
	</script>
  </body>
</html>