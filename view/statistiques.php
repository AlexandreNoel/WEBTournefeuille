
<head>
    <!-- HEADER !-->
    <?php require_once(__DIR__ . '/partials/header.php'); ?>
</head>
<body class="main-body">
<!-- NAVBAR !-->
<?php require_once(__DIR__ . '/partials/navbar.php'); ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin:auto;margin-top: 100px"></div>
<div id="container2" style="min-width: 310px; height: 400px; max-width: 600px; margin:auto;margin-top: 100px"></div>

<script>
    function fetchproductdata() {

        $.ajax({
            type: 'POST',
            url: 'fetch-statistiques.php',
            data: "methode=piechart" ,
            success: function (data) {
                var obj = JSON.parse(data);

                chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'container',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                    },
                    title: {
                        text: 'Répartition des achats par produit',
                        percentageDecimals: 1

                    },
                    tooltip: {
                        format: '{series.name}: <b>{point.y:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                }
                            }
                        }
                    },

                    series: [{
                        type: 'pie',
                        name: 'Répartition achats',
                        data: obj
                    }]
                });
            }
        });
    }
    function fetchsolde() {
        var options = {
            chart: {
                renderTo: 'container2',
                type: 'line',

            },
            title: {
                text: 'Fruit Consumption'
            },
            xAxis:{
                type:'datetime'
            },
            yAxis: {
                title: {
                    text: 'Fruits Amount'
                }
            },
            series: [{}]
        };
        $.ajax({
            type: 'POST',
            url: 'fetch-statistiques.php',
            data: "methode=chart",
            success: function (data) {
                data=JSON.parse(data);
                console.log(data);
                // var data = [
                //     [1531972144000, 20.94],
                //     [1531972204000, 20.94],
                //     [1531972264000, 20.85],
                //     [1531972324000, 20.94],
                //     [1531972384000, 21.21]
                //     ];

                options.series[0].data = data;
                var chart = new Highcharts.Chart(options);

            }

        });
    }
    fetchproductdata();
    fetchsolde();
</script>
