<?php
include 'includes/charts.php';
?>
<div class="main">
    <div class="row">
        <h3 class="light">Dashboard</h3>
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col-lg-8" id="studentsPerGrade">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Students Per Grade</h5>
                    <?php foreach ($studentGradeArray as $key => $value) { ?>
                        <div class="d-flex row progress-row">
                            <div class="d-flex col-sm-9 bar-info justify-content-center">
                                <div class="d-flex justify-content-center">
                                    <?php echo getGrade($key) ?>
                                </div>
                            </div>
                            <div class="d-flex col-sm-3 bar-info justify-content-end">
                                <div class="d-flex justify-content-end">
                                    <?php echo $value ?>
                                </div>
                            </div>

                        </div>
                        <div class="progress">
                            <!-- <p><?php echo $key; ?></p> -->
                            <div class="progress-bar" role="progressbar" style="width: <?php echo ($value / max($studentGradeArray) * 100); ?>%;" aria-valuenow="<?php echo ($value / max($studentGradeArray) * 100); ?>" aria-valuemin="0" aria-valuemax="<?php echo max($studentGradeArray); ?>">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Alerts</h5>
                    <hr>
                    <h6 class="alerts-title"><i class="bi bi-apple"></i>Apple Repairs</h6>
                    <p class="card-text"> There are currently 7 devices out for repair.</p>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col-lg-8" id="classSizeHistory">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Class Size History</h5>
                    <div>
                        <canvas id="classSizeHistoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    classSizeHistoryChart()
</script>