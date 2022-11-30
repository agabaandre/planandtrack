<?php session_start();
include('header.php');
if (!isset($_SESSION['user_id'])) {
?>
    <script type="text/javascript" language="javascript">
        window.location = "index.php";
    </script>
<?php
}
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];
include('connect.php');
?>



<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
			<?php
          
          include('top_header.php');
          
          
          ?>
		<!--end header -->
		<!--navigation-->
		<div class="nav-container primary-menu">
			<div class="mobile-topbar-header">
				<div>
					<img src="images/africacdc_2.jpeg" class="logo-icon" alt="logo icon" >
				</div>
				
				
			</div>
			<?php include("sidebar.php"); ?>
		</div>
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Applications</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Calendar</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						
					</div>
				</div>
				<!--end breadcrumb-->
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<div id='calendar'></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<?php include'footer.php'; ?>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			var calendarEl = document.getElementById('calendar');
			var calendar = new FullCalendar.Calendar(calendarEl, {
				headerToolbar: {
					left: 'prev,next today',
					center: 'title',
					right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
				},
				initialView: 'dayGridMonth',
				
				navLinks: true, // can click day/week names to navigate views
				selectable: true,
				nowIndicator: true,
				dayMaxEvents: true, // allow "more" link when too many events
				editable: true,
				selectable: true,
				businessHours: true,
				dayMaxEvents: true, // allow "more" link when too many events
				events: 'calendar/getevents_proposed.php',
                selectable: false,
                selectHelper: true,
                editable: false,
                // Mouse over
                success: function(calEvent) {
                    //: function(calEvent, jsEvent, view) {
                    console.log(calEvent);
                },

                eventMouseover: function(calEvent, jsEvent, view) {
                    //console.log(calEvent);

                    var tooltip = '<div class="event-tooltip">' + calEvent.activity + '</div>';
                    $("body").append(tooltip);
                    $(this).mouseover(function(e) {
                        $(this).css('z-index', 10000);
                        $('.event-tooltip').fadeIn('500');
                        $('.event-tooltip').fadeTo('10', 1.9);
                    }).mousemove(function(e) {
                        $('.event-tooltip').css('top', e.pageY + 10);
                        $('.event-tooltip').css('left', e.pageX + 20);
                    });
                },
                eventMouseout: function(calEvent, jsEvent) {
                    $(this).css('z-index', 8);
                    $('.event-tooltip').remove();

                },


            }

        );
			calendar.render();
		});
	</script>
</body>

</html>