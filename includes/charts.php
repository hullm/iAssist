<script>
    const colors = [
        '#35b2e6',
        '#00bcdd',
        '#00c3c4',
        '#00c89d',
        '#4cc86e',
        '#8ec43d',
        '#c7b901',
        '#ffa600',
    ];
    function studentsPerGradeChart() {
        const labels = [
            <?php
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
            "2016-09-01 00:00:00"
        ];
        const data = {
            labels: labels,
            datasets: [
            {
                label: 'Class of 2022',
                data: [{
                    x: '2016-09-01 00:00:00',
                    y: 78,},{
                    },{
                    x: '2018-09-01',
                    y: 75,}  
                ],
                borderColor: colors[0],
                backgroundColor: colors[0],
            },
            
        ]
        }
        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                stacked: false,
                scales: {
                    x:{
                        type: 'time',
                        time: {
                            format: 'yyyy-MM-dd',
                            tooltipFormat: 'yyyy-MM-dd',
                            // parser: 'yyyy-MM-dd'
                        },
                        title:{
                            display: true,
                            text: 'Date',
                        },
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