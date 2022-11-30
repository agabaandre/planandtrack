<?php
if ($role == "admin_all") {
  include("sidemenu_adminall.php");
} elseif ($role == "staff") {
  include("sidemenu_staff.php");
} else {
?>
  <script type="text/javascript" language="javascript">
    alert("Session Expired");
    window.location = "index.php";
  </script>
<?php
}
?>