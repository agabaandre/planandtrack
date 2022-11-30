<?php session_start();
include('connect.php');

include('header.php');


$name = $_SESSION['name'];

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];
$access = $_SESSION['access'];
$string =  implode(", ", $access);

function nice_number($n)
{
    // first strip any formatting;
    if ($n == 'NULL' || $n == '' || $n == '0') {
        $n = 0;
        return ($n);
    } else {
        $n = (0 + str_replace(",", "", $n));
        // is this a number?
        if (!is_numeric($n)) return false;
        // now filter it;
        if ($n > 1000000000000) return round(($n / 1000000000000), 2) . 'T';
        // elseif ($n > 1000000000) return round(($n/1000000000), 2).' billion doses';
        elseif ($n > 1000000) return round(($n / 1000000), 2) . 'M ';
        elseif ($n > 1000) return round(($n / 1000), 2) . 'K';
        return number_format($n);
    }
}
?>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--start header wrapper-->
        <div class="header-wrapper">
            <!--start header -->
            <?php

            include('top_header.php');


            ?>
            <!--end header -->
            <!--navigation-->
            <div class="nav-container primary-menu">
                <div class="mobile-topbar-header">
                    <div>
                        <img src="images/africacdc_2.jpeg" class="logo-icon" alt="logo icon">
                    </div>


                </div>
                <?php include("sidebar.php"); ?>
            </div>
            <!--end navigation-->
        </div>
        <!--end header wrapper-->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">



                <form method="post">
                </form>
                <?php
                if ($role == 'admin_all') { ?>
                    <table class="table table-striped table-bordered table-hover">
                        <tbody>
                            <form method="post" autocomplete="off">
                                <td>
                                    <div class="form-group">
                                        <select class="form-control select2bs4" style="width: 100%;" name="division_id">
                                            <option value="">Select Division </option>
                                            <?php
                                            $sql2 = "SELECT * FROM divisions ORDER BY division";
                                            $result2 = mysqli_query($mysqli, $sql2);
                                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                            ?>
                                                <option value=<?php echo $row2['division_id'] . '>' . $row2['division']; ?></option>
                                                <?php
                                            }
                                                ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <button type="submit" name="Apply" class="btn btn-success">Apply</button>
                                </td>
                            </form>
                        </tbody>
                    </table>
                    <?php

                    //print_r($uri_segment);
                    ?>
                <?php
                    if (isset($_POST['Apply'])) {
                        $division_id = $_POST['division_id'];
                        $nonEmpty = array();
                        if ($division_id != '') {
                            $nonEmpty[0] = "d.division_id";
                        }
                        $noOfElements = sizeof($nonEmpty);
                        if ($noOfElements > 0) {
                            $count = 1;
                            $query = "AND ";
                            foreach ($nonEmpty as $value) {
                                if ($count == $noOfElements) {
                                    $values = explode(".", $value);
                                    $query = $query . " " . $value . " LIKE '" . $_POST[$values[1]] . "'";
                                } else {
                                    $values = explode(".", $value);
                                    $query = $query . " " . $value . " LIKE '" . $_POST[$values[1]] . "' AND";
                                }
                                $count++;
                            }
                            $sql1 = "SELECT SUM(original) AS original FROM  budget WHERE unit_id IN (SELECT unit_id FROM units WHERE division_id=$division_id)";
                            $result1 = mysqli_query($mysqli, $sql1);
                            $row1 = mysqli_fetch_assoc($result1);
                            $sql2 = "SELECT SUM(original_released) AS released FROM  budget WHERE unit_id IN (SELECT unit_id FROM units WHERE division_id=$division_id)";
                            $result2 = mysqli_query($mysqli, $sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                            $sql3 = "SELECT SUM(approved_cost) AS used FROM  expenditures WHERE budget_id IN (SELECT budget_id FROM budget WHERE unit_id IN (SELECT unit_id FROM units WHERE division_id=$division_id))";
                            $result3 = mysqli_query($mysqli, $sql3);
                            $row3 = mysqli_fetch_assoc($result3);
                            $b_rate = ($row3['used'] / $row2['released']) * 100;
                            $sql5 = "SELECT d.division,SUM(approved_cost) AS total FROM  expenditures e,budget b,units u,divisions d WHERE e.budget_id=b.budget_id AND b.unit_id=u.unit_id AND d.division_id=u.division_id ";
                            $sql5 =  $sql5 . " " . $query . " GROUP BY d.division";
                            $result5 = mysqli_query($mysqli, $sql5);
                            $dataPoint = array();
                            while ($row5 = mysqli_fetch_assoc($result5)) {
                                $division = $row5['division'];
                                $total = $row5['total'];
                                $dataPoint[] = array("name" => $division, "y" => $total);
                            }
                            $sql6 = "SELECT d.division,SUM(original) AS original,SUM(original_released) AS released,SUM(approved_cost) AS total FROM  expenditures e,budget b,units u,divisions d WHERE e.budget_id=b.budget_id AND b.unit_id=u.unit_id AND d.division_id=u.division_id ";
                            $sql6 =  $sql6 . " " . $query . " GROUP BY d.division";
                            $result6 = mysqli_query($mysqli, $sql6);
                            $original2 = array();
                            $released2 = array();
                            $divisions = array();
                            $used2 = array();
                            while ($row6 = mysqli_fetch_assoc($result6)) {
                                $divisions[] = $row6['division'];
                                $released2[] = $row6['released'];
                                $original2[] = $row6['original'];
                                $used2[] = $row6['total'];
                            }
                        }
                    } else {
                        $sql1 = "SELECT SUM(original) AS original FROM  budget WHERE unit_id IN (SELECT unit_id FROM units WHERE division_id IN ($string))";
                        $result1 = mysqli_query($mysqli, $sql1);
                        $row1 = mysqli_fetch_assoc($result1);
                        $sql2 = "SELECT SUM(original_released) AS released FROM  budget WHERE unit_id IN (SELECT unit_id FROM units WHERE division_id IN ($string))";
                        $result2 = mysqli_query($mysqli, $sql2);
                        $row2 = mysqli_fetch_assoc($result2);
                        $sql3 = "SELECT SUM(approved_cost) AS used FROM  expenditures e,budget b WHERE e.budget_id=b.budget_id AND unit_id IN (SELECT unit_id FROM units WHERE division_id IN ($string))";
                        $result3 = mysqli_query($mysqli, $sql3);
                        $row3 = mysqli_fetch_assoc($result3);
                        $b_rate = ($row3['used'] / $row2['released']) * 100;
                        $sql5 = "SELECT d.division,SUM(approved_cost) AS total FROM  expenditures e,budget b,units u,divisions d WHERE e.budget_id=b.budget_id AND b.unit_id=u.unit_id AND d.division_id=u.division_id AND d.division_id IN ($string) GROUP BY d.division";
                        $result5 = mysqli_query($mysqli, $sql5);
                        $dataPoint = array();
                        while ($row5 = mysqli_fetch_assoc($result5)) {
                            $division = $row5['division'];
                            $total = $row5['total'];
                            $dataPoint[] = array("name" => $division, "y" => $total);
                        }
                        $sql6 = "SELECT d.division,SUM(original) AS original,SUM(original_released) AS released,SUM(approved_cost) AS total FROM  expenditures e,budget b,units u,divisions d WHERE e.budget_id=b.budget_id AND b.unit_id=u.unit_id AND d.division_id=u.division_id AND d.division_id IN ($string) GROUP BY d.division";
                        $result6 = mysqli_query($mysqli, $sql6);
                        $original2 = array();
                        $released2 = array();
                        $divisions = array();
                        $used2 = array();
                        while ($row6 = mysqli_fetch_assoc($result6)) {
                            $divisions[] = $row6['division'];
                            $released2[] = $row6['released'];
                            $original2[] = $row6['original'];
                            $used2[] = $row6['total'];
                        }
                    }
                } else {
                    $sql1 = "SELECT SUM(original) AS original FROM  budget WHERE unit_id IN (SELECT unit_id FROM units WHERE division_id IN ($string))";
                    $result1 = mysqli_query($mysqli, $sql1);
                    $row1 = mysqli_fetch_assoc($result1);
                    $sql2 = "SELECT SUM(original_released) AS released FROM  budget WHERE unit_id IN (SELECT unit_id FROM units WHERE division_id IN ($string))";
                    $result2 = mysqli_query($mysqli, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    $sql3 = "SELECT SUM(approved_cost) AS used FROM  expenditures e,budget b WHERE e.budget_id=b.budget_id AND unit_id IN (SELECT unit_id FROM units WHERE division_id IN ($string))";
                    $result3 = mysqli_query($mysqli, $sql3);
                    $row3 = mysqli_fetch_assoc($result3);
                    $b_rate = ($row3['used'] / $row2['released']) * 100;
                    $sql5 = "SELECT d.division,SUM(approved_cost) AS total FROM  expenditures e,budget b,units u,divisions d WHERE e.budget_id=b.budget_id AND b.unit_id=u.unit_id AND d.division_id=u.division_id AND d.division_id IN ($string) GROUP BY d.division";
                    $result5 = mysqli_query($mysqli, $sql5);
                    $dataPoint = array();
                    while ($row5 = mysqli_fetch_assoc($result5)) {
                        $division = $row5['division'];
                        $total = $row5['total'];
                        $dataPoint[] = array("name" => $division, "y" => $total);
                    }
                    $sql6 = "SELECT d.division,SUM(original) AS original,SUM(original_released) AS released,SUM(approved_cost) AS total FROM  expenditures e,budget b,units u,divisions d WHERE e.budget_id=b.budget_id AND b.unit_id=u.unit_id AND d.division_id=u.division_id AND u.unit_id IN (SELECT unit_id FROM units WHERE division_id IN ($string)) GROUP BY u.unit_id";
                    $result6 = mysqli_query($mysqli, $sql6);
                    $original2 = array();
                    $released2 = array();
                    $divisions = array();
                    $used2 = array();
                    while ($row6 = mysqli_fetch_assoc($result6)) {
                        $divisions[] = $row6['division'];
                        $released2[] = $row6['released'];
                        $original2[] = $row6['original'];
                        $used2[] = $row6['total'];
                    }
                    $sql7 = "SELECT u.unit,SUM(approved_cost) AS total FROM  expenditures e,budget b,units u WHERE e.budget_id=b.budget_id AND b.unit_id=u.unit_id AND u.division_id IN ($string) GROUP BY u.unit";
                    $result7 = mysqli_query($mysqli, $sql7);
                    $dataPoint7 = array();
                    while ($row7 = mysqli_fetch_assoc($result7)) {
                        $unit = $row7['unit'];
                        $total7 = $row7['total'];
                        $dataPoint7[] = array("name" => $unit, "y" => $total7);
                    }
                    $sql8 = "SELECT u.unit AS unit,original,released,total FROM  budget_released b,used_budget u WHERE b.unit_id=u.unit_id AND b.division_id IN ($string) GROUP BY u.unit";
                    $result8 = mysqli_query($mysqli, $sql8);
                    $original8 = array();
                    $released8 = array();
                    $units = array();
                    $used8 = array();
                    while ($row8 = mysqli_fetch_assoc($result8)) {
                        $units[] = $row8['unit'];
                        $released8[] = $row8['released'];
                        $original8[] = $row8['original'];
                        $used8[] = $row8['total'];
                    }
                }
                ?>

                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">

                    <div class="col">
                        <!--<div class="card rounded-4 bg-gradient-rainbow">-->
                        <div class="card rounded-4" style="background:rgba(52, 143, 65, 1);">
                            <div class=" card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h5>
                                            <p class="mb-0 text-white">Approved Budget</p>
                                        </h5>
                                        <h3 class="my-1 text-white"><?php echo nice_number($row1['original']); ?> </h3>
                                    </div>
                                    <div class="fs-1 text-white"><i class='bx bxs-cart'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <!--<div class="card rounded-4 bg-gradient-worldcup">-->
                        <div class="card rounded-4" style=" background:#4a4a4a;">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h5>
                                            <p class="mb-0 text-white">Released Budget</p>
                                        </h5>
                                        <h3 class="my-1 text-white"><?php echo nice_number($row2['released']); ?> </h3>
                                    </div>
                                    <div class="fs-1 text-white"><i class='bx bxs-cart'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <!--<div class="card rounded-4 bg-gradient-smile">-->
                        <div class="card rounded-4" style=" background:#b4a269;">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h5>
                                            <p class="mb-0 text-white">Used Budget</p>
                                        </h5>
                                        <h3 class="my-1 text-white"><?php echo nice_number($row3['used']); ?> </h3>
                                    </div>
                                    <div class="fs-1 text-white"><i class='bx bxs-wallet'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <!--<div class="card rounded-4 bg-gradient-pinki">-->
                        <div class="card rounded-4" style=" background:#9F2241;">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h5>
                                            <p class="mb-0 text-white">Burn Rate</p>
                                        </h5>
                                        <h3 class="my-1 text-white"><?php echo round($b_rate, 1) . '%'; ?> </h3>
                                    </div>
                                    <div class="fs-1 text-white"><i class='bx bxs-bar-chart-alt-2'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->


                <?php if ($role == 'admin_all') {
                ?>
                    <div class="row">
                        <div class="col-12 col-lg-6 d-flex">
                            <div class="card rounded-4 w-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-cente">
                                        <div>
                                            <h6 class="mb-0">Proportion of Used By Division</h6>
                                        </div>

                                    </div>
                                    <div>
                                        <figure class="highcharts-figure">
                                            <div id="container"></div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 d-flex">
                            <div class="card rounded-4 w-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6 class="mb-0">Division Usage</h6>
                                        </div>

                                    </div>
                                    <div>
                                        <figure class="highcharts-figure">
                                            <div id="container2"></div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                <?php
                } else { ?>


                    <div class="row">
                        <div class="col-12 col-lg-6 d-flex">
                            <div class="card rounded-4 w-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-cente">
                                        <div>
                                            <h6 class="mb-0">Proportion of Used Budget By Workstream</h6>
                                        </div>

                                    </div>
                                    <div>
                                        <figure class="highcharts-figure">
                                            <div id="container3"></div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 d-flex">
                            <div class="card rounded-4 w-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6 class="mb-0">Workstream Usage</h6>
                                        </div>

                                    </div>
                                    <div>
                                        <figure class="highcharts-figure">
                                            <div id="container4"></div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                <?php
                } ?>

            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <?php


        include("footer.php");

        ?>
    </div>
    <!--end wrapper-->
    <!--start switcher-->
    <div class="switcher-wrapper">
        <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
        </div>
        <div class="switcher-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
                <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
            </div>
            <hr />
            <h6 class="mb-0">Theme Styles</h6>
            <hr />
            <div class="d-flex align-items-center justify-content-between">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
                    <label class="form-check-label" for="lightmode">Light</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
                    <label class="form-check-label" for="darkmode">Dark</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
                    <label class="form-check-label" for="semidark">Semi Dark</label>
                </div>
            </div>
            <hr />
            <div class="form-check">
                <input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
                <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
            </div>
            <hr />
            <h6 class="mb-0">Header Colors</h6>
            <hr />
            <div class="header-colors-indigators">
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <div class="indigator headercolor1" id="headercolor1"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor2" id="headercolor2"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor3" id="headercolor3"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor4" id="headercolor4"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor5" id="headercolor5"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor6" id="headercolor6"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor7" id="headercolor7"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor8" id="headercolor8"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end switcher-->
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <script src="assets/plugins/chartjs/js/Chart.min.js"></script>
    <script src="assets/plugins/chartjs/js/Chart.extension.js"></script>
    <script src="assets/js/index2.js"></script>
    <!--app JS-->
    <script src="assets/js/app.js"></script>

    <script>
        Highcharts.setOptions({
            colors: ['#348F41', '#B4A269', '#9F2241 ', '#522B39', '#a3a3a3', '#4a4a4a', '#D0F7D9']
        });
        // Radialize the colors
        var pieColors = (function() {
            var colors = [],
                base = Highcharts.getOptions().colors[0],
                i;
            for (i = 0; i < 10; i += 1) {
                // Start out with a darkened base color (negative brighten), and end
                // up with a much brighter color
                colors.push(Highcharts.color(base).brighten((i - 3) / 7).get());
            }
            return colors;
        }());
        // Build the chart
        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    size: '80%',
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Percentage',
                data: <?php echo json_encode($dataPoint, JSON_NUMERIC_CHECK); ?>
            }],
            credits: {
                enabled: false
            }
        });
    </script>

    <script>
        Highcharts.chart('container2', {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: <?php echo json_encode($divisions, JSON_NUMERIC_CHECK); ?>,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Amount (USD)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Approved',
                data: <?php echo json_encode($original2, JSON_NUMERIC_CHECK); ?>
            }, {
                name: 'Released',
                data: <?php echo json_encode($released2, JSON_NUMERIC_CHECK); ?>
            }, {
                name: 'Used',
                data: <?php echo json_encode($used2, JSON_NUMERIC_CHECK); ?>
            }],
            credits: {
                enabled: false
            }
        });
    </script>
    <script>
        Highcharts.setOptions({
            colors: ['#348F41', '#B4A269', '#9F2241 ', '#522B39', '#a3a3a3', '#4a4a4a', '#D0F7D9']
        });
        // Radialize the colors
        var pieColors = (function() {
            var colors = [],
                base = Highcharts.getOptions().colors[0],
                i;
            for (i = 0; i < 10; i += 1) {
                // Start out with a darkened base color (negative brighten), and end
                // up with a much brighter color
                colors.push(Highcharts.color(base).brighten((i - 3) / 7).get());
            }
            return colors;
        }());
        // Build the chart
        Highcharts.chart('container3', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    size: '80%',
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Percentage',
                data: <?php echo json_encode($dataPoint7, JSON_NUMERIC_CHECK); ?>
            }],
            credits: {
                enabled: false
            }
        });
    </script>

    <script>
        Highcharts.chart('container4', {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: <?php echo json_encode($units, JSON_NUMERIC_CHECK); ?>,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Amount (USD)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Approved',
                data: <?php echo json_encode($original8, JSON_NUMERIC_CHECK); ?>
            }, {
                name: 'Released',
                data: <?php echo json_encode($released8, JSON_NUMERIC_CHECK); ?>
            }, {
                name: 'Used',
                data: <?php echo json_encode($used8, JSON_NUMERIC_CHECK); ?>
            }],
            credits: {
                enabled: false
            }
        });
    </script>
</body>

</html>