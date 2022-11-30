<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="images/africacdc_2.png" type="image/png" />
	<!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="assets/plugins/fullcalendar/css/main.min.css" rel="stylesheet" />
	<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="assets/css/dark-theme.css" />
	<link rel="stylesheet" href="assets/css/semi-dark.css" />
	<link rel="stylesheet" href="assets/css/header-colors.css" />
	<link rel="stylesheet" href="jquery-ui-1.8.7.custom/development-bundle/themes/base/jquery.ui.all.css">
	<script src="jquery-ui-1.8.7.custom/development-bundle/jquery-1.4.4.js"></script>
	<script src="jquery-ui-1.8.7.custom/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="jquery-ui-1.8.7.custom/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="jquery-ui-1.8.7.custom/development-bundle/ui/jquery.ui.datepicker.js"></script>

	<script type="text/javascript">
		(function($) {
			//jquery stuff
			$(function() {
				$(".dob1").datepicker({
					changeMonth: true,
					changeYear: true,
					showOn: "both",
					buttonImage: "images/datepicker_icon.jpg",
					buttonImageOnly: true
				});

			});
			//end jquery stuff
		})(jQuery);
		//no conflict jquery
		jQuery.noConflict();
	</script>
	<title>Africa CDC</title>
</head>
<?php
require_once("modules/universal_functions/actiive_link.php");

echo $uri_segment = uri_segment();

?>