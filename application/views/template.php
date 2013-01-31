<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?= $title &middot; YIT Works ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Le styles -->
<link href="<?php echo base_url('assets/css/bootstrap.css') ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/bootstrap-fullcalendar.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap-responsive.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/datepicker.css') ?>" rel="stylesheet">
<link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.ico') ?>">
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Le scripts -->
<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

<script>
$(document).ready(function() {
$('#calendar').fullCalendar({})
});
</script>	
</head>
<body>
<?= $nav ?>	
<div class="container">
<?= $content ?>
</div>
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
    
<script src="<?php echo base_url('assets/js/bootstrap.js') ?>"></script>
<script src="<?php echo base_url('assets/js/gcal.js') ?>"></script>
<script type='text/javascript' src="<?php echo base_url('assets/js/fullcalendar.js') ?>"></script>
<script type='text/javascript' src="<?php echo base_url('assets/js/bootstrap-datepicker.js') ?>"></script>
<script>
	$(function(){
		$('#dp1, #dp2, #dp3').datepicker({
			format: 'mm-dd-yyyy'
		});
	});
</script>
</body>
</html>
