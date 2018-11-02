
<!-- NAVBAR !-->
<?php require_once(__DIR__ . '/partials/header.php'); ?>


<body class="main-body">
<!-- NAVBAR !-->
<?php require_once(__DIR__ . '/partials/navbar.php'); ?>

<script>
    function fetchproductdata(param1) {

        $.ajax({
            type: 'POST',
            url: 'fetch-statistiques.php',
            data: "idutilisateur=" + param1,
            success: function (data) {
                console.log(data);
                var obj = jsonParse(data);
                $.each(obj, function (itemNo, item) {
                    series = new Array();
                    if (itemNo == 0) {
                        series.data = item.data;
                        series.name = item.name;
                        series.type = item.type;
                    } else if (itemNo == 1) {
                        series.type = item.type;
                        series.data = item.data;
                        series.name = item.name;
                        series.center = item.center;
                        series.size = item.size;
                        series.showInLegend = item.showInLegend;
                    }
                    options.series.push(series);
                });

                chart = new Highcharts.Chart(options);
                console.log(options);
            }
        });
    }
    fetchproductdata(3)
</script>
