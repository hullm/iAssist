<script>
    <?php $colors = [
        "#fd7f6f", 
        "#7eb0d5", 
        "#b2e061", 
        "#bd7ebe", 
        "#ffb55a", 
        "#ffee65", 
        "#beb9db", 
        "#fdcce5", 
        "#8bd3c7",
        "#ef9b20", 
        "#edbf33", 
        "#ede15b", 
        "#bdcf32"
        ];
    // $test = getCountHistory(2033);
    // foreach ($test as $key => $value){
    //     echo $key."=>".$value." ";
    // }
    ?>

    function studentsPerGradeChart() {
        const labels = [
            <?php
            $studentGradeArray = getStudentsPerGrade();
            foreach ($studentGradeArray as $key => $value) {
                echo "'" . getGrade($key) . "'";
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
                borderRadius: 10,
                indexAxis: 'y',
                scales: {
                    axis: {
                        display: false,
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        },
                        display: true,
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        display: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return value;
                            }
                        },
                    },
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            },
        };

        const studentsperGradeChart = new Chart(
            document.getElementByID = "studentsPerGradeChart",
            config
        );
    }



    function classSizeHistoryChart() {
        const labels = [
            // "2015-03-15T13:03:00Z", "2015-03-25T13:02:00Z", "2015-04-25T14:12:00Z",
            // "2016-09-01 00:00:00"
        ];
        const data = {
            labels: labels,
            datasets: [
                <?php
                for ($i = 0; $i <= 5; $i++) {
                    $countHistoryArray = getCountHistory(date("Y") + $i);
                ?> {
                        label: 'Class of <?php echo date("Y") + $i; ?>',
                        borderColor: <?php echo "'" . $colors[$i] . "'"; ?>,
                        backgroundColor: <?php echo "'" . $colors[$i] . "'"; ?>,
                        data: [
                            <?php
                            foreach ($countHistoryArray as $date => $value) { ?> {
                                    x: <?php echo "'" . $date . "'"; ?>,
                                    y: <?php echo $value; ?>
                                },
                            <?php } ?>
                        ],},
                    <?php } ?>
                    
                ],
        };
        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                stacked: false,
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            format: 'yyyy-MM-dd',
                            tooltipFormat: 'yyyy-MM-dd',
                            // parser: 'yyyy-MM-dd'
                        },
                        title: {
                            display: true,
                            text: 'Date',
                        },
                    },
                    y: {
                        min: 30,
                    },
                },
            },
        };
        const classSizeHistoryChart = new Chart(
            document.getElementByID = "classSizeHistoryChart",
            config
        );
    }
</script>