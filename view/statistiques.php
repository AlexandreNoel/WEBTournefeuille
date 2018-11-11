
<head>
    <!-- HEADER !-->
    <?php require_once(__DIR__ . '/partials/header.php'); ?>
</head>
<body class="main-body">
<!-- NAVBAR !-->
<?php require_once(__DIR__ . '/partials/navbar.php'); ?>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>
<div id="Dashboard" style="">
    <div id="mainchart">
        <div id="chart" style="min-width: 800px; height: 300px; max-width: 1200px; margin:auto;margin-top: 100px">
        </div>
    </div>
    <div id="piechart" style="display:flex;">
        <div id="piechartcategorie" style="min-width: 400px; height: 300px; max-width: 600px; margin:auto"></div>
        <div class="column">
            <div class="ligne">
                <div class="card">
                    <h3><?php echo $solde?>€</h3>
                    <p>Solde actuelle</p>
                </div>
            </div>

            <div class="ligne">
                <div class="card">
                    <h3><?php echo $expensesweek?>€</h3>
                    <p>Dépensés la dernière semaine</p>
                </div>
            </div>

            <div class="ligne">
                <div class="card">
                    <h3><?php echo $expensesmonth?>€</h3>
                    <p>Dépensés le dernier mois</p>
                </div>
            </div>
        </div>
        <div id="piechartproduit" style="min-width: 400px; height: 300px; max-width: 600px; margin:auto"></div>
    </div>

</div>

<script>
    function fetchproductdata() {
        Highcharts.setOptions({
            time: {
                useUTC: false
            }
        });
        $.ajax({
            type: 'POST',
            url: 'fetch-statistiques.php',
            data: "methode=piechartproduit" ,
            success: function (data) {
                var obj = JSON.parse(data);

                chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'piechartproduit',
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
        $.ajax({
            type: 'POST',
            url: 'fetch-statistiques.php',
            data: "methode=piechartcategorie" ,
            success: function (data) {
                var obj = JSON.parse(data);

                chart2 = new Highcharts.Chart({
                    chart: {
                        renderTo: 'piechartcategorie',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                    },
                    title: {
                        text: 'Répartition des achats par Catégorie',
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
                renderTo: 'chart',
                type: 'line',

            },

            title: {
                text: 'Evolution du solde'
            },
            xAxis:{
                type:'datetime'
            },
            yAxis: {
                title: {
                    text: 'Montant en €'
                }
            },
            series: [{    name: 'Solde'
            }]
        };
        $.ajax({
            type: 'POST',
            url: 'fetch-statistiques.php',
            data: "methode=chart",
            success: function (data) {
                console.log(data);
                data=JSON.parse(data);


                var stock = Highcharts.stockChart('chart', {


                    rangeSelector: {
                        selected: 1
                    },

                    title: {
                        text: 'Evolution du Solde'
                    },
                    xAxis:{
                        type:'Date',
                        ordinal:false

                    },
                    yAxis: {
                        title: {
                            text: 'Montant en €'
                        }
                    },

                    series: [{
                        name: 'Solde',
                        data: data,
                        marker: {
                            enabled: true,
                            radius: 3
                        },
                        shadow: true,
                        tooltip: {
                            valueDecimals: 2
                        }
                    }]
                });
            }

        });
    }
    fetchproductdata();
    fetchsolde();


</script>
