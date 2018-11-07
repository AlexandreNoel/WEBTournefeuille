
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

<script>
    function fetchproductdata(param1) {

        $.ajax({
            type: 'POST',
            url: 'fetch-statistiques.php',
            data: "idutilisateur=" + param1,
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
    fetchproductdata(3)
</script>
