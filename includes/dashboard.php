<div class="main">
    <div class="row">
        <h3 class="light">Dashboard</h3>
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Students Per Grade</h5>
                    <div>
                        <canvas id="studentsPerGradeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Alerts</h5>
                    <hr>
                    <h6 class="alerts-title"><i class="bi bi-tools"></i> Repairs</h6>
                    <p class="card-text"> Jaime really is a buttface</p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$studentGradeArray = getStudentsPerGrade();

?>

<script>
    const labels = [
        <?php
        foreach ($studentGradeArray as $key => $value) {
            echo "'".getGrade($key)."'";
            // echo "$key";

            if (next($studentGradeArray) == true) {
                echo ",";
            }
        }
        ?>
    ];
    const data = {
        labels: labels,
        datasets: [{
            barThickness: 'flex',
            axis: 'y',
            label: "Students Per Grade",
            data: [
                <?php
                foreach ($studentGradeArray as $key => $value) {
                    echo $value;
                    if (next($studentGradeArray) == true) {
                        echo ",";
                    }
                }
                ?>
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)',
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)'
            ],
            borderWidth: 1,
        }]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            indexAxis: 'y',
            scales: {
                axis:{
                    display:false,
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    },
                    ticks:{
                        callback: function(value, index, values) {
                            return value;
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    display: false
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        },
    };
</script>
<script>
    const myChart = new Chart(
        document.getElementByID = "studentsPerGradeChart",
        config
    );
</script>