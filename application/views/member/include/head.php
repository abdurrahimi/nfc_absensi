<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>e-Absensi</title>

	<meta name="description" content="Common form elements and layouts" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/bootstrap.css" />
	<link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/font-awesome.css" />
	<link rel="stylesheet" href="<?php echo base_url('assets') ?>/datepicker/datepicker.css" />
	<link rel="stylesheet" href="<?php echo base_url('assets') ?>/datepicker/bootstrap-clockpicker.min.css" />

	<!-- page specific plugin styles -->
	<link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/jquery-ui.custom.css" />
	<link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/chosen.css" />
	<link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/datepicker.css" />
	<link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/bootstrap-timepicker.css" />
	<link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/daterangepicker.css" />
	<link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/bootstrap-datetimepicker.css" />
	<link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/colorpicker.css" />

	<!-- text fonts -->
	<link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/ace-fonts.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets') ?>/tippedJs/css/tipped/tipped.css" />

	<!--[if lte IE 9]>
			<link rel="stylesheet" href="../assets/css/ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->

	<!--[if lte IE 9]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.css" />
		<![endif]-->

	<!-- inline styles related to this page -->

	<!-- ace settings handler -->
	<script src='<?php echo base_url('assets') ?>/js/jquery.js'></script>
	<!-- <script type="text/javascript">
		window.jQuery || document.write("<script src='<?php echo base_url('assets') ?>/js/jquery.js'>" + "<" + "/script>");
	</script> -->
	<script src="<?php echo base_url('assets') ?>/js/ace-extra.js"></script>
	<script src="<?php echo base_url('assets') ?>/js/autoNumeric.js"></script>

	<link rel="styleSheet" href="<?php echo base_url('assets') ?>/dtree/dtree.css" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url('assets') ?>/dtree/dtree.js"></script>
	<script src="<?php echo base_url('assets') ?>/js/jstree/dist/jstree.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url('assets') ?>/js/jstree/dist/themes/default/style.min.css" />
	<link rel="stylesheet" href="<?php echo base_url('assets') ?>/jOrgChart/css/jquery.jOrgChart.css" />
	<script src="<?php echo base_url('assets') ?>/jOrgChart/jquery.jOrgChart.js"></script>
	<script src="<?php echo base_url('assets') ?>/datepicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url('assets') ?>/datepicker/bootstrap-clockpicker.min.js"></script>


	<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

	<!--[if lte IE 8]>
		<script src="../assets/js/html5shiv.js"></script>
		<script src="../assets/js/respond.js"></script>
		<![endif]-->
	<script>
		function confirmBox() {

			var txt;
			var r = confirm("Anda yakin ingin menghapus data ini ? ");
			if (r == true) {
				return true;
			} else {
				return false;
			}

		}
	</script>
</head>