<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="view/css/style_admin.css">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.2/dist/chart.min.js"></script>
    <style type="text/css">
        /*Rules for sizing the icon*/
        
        .material-icons.md-18 {
            font-size: 18px;
        }
        
        .material-icons.md-24 {
            font-size: 24px;
        }
        
        .material-icons.md-36 {
            font-size: 36px;
        }
        
        .material-icons.md-48 {
            font-size: 48px;
        }
    </style>
</head>
<body>
    <?php
        echo $content;
    ?>
    <canvas id="chart" width="400" height="400"></canvas>
    <script>
        let ctx = document.getElementById('chart').getContext('2d');
        let arrTanggal = [];
        let arrCust = [];
        <?php
            foreach ($resultChart as $key=>$value){
                ?>
                arrTanggal.push(<?php echo $value["tanggal"]?>);
                arrCust.push(<?php echo $value["sum"]?>);
        <?php
            }
        ?>
        let myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: arrTanggal,
                datasets: [{
                    label: 'Data Jumlah Pengunjung per Hari ',
                    data: arrCust,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        
    </script>
</body>
</html>