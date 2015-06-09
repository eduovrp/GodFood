<?php

require 'functions/grafico.php';
if(isset($_SESSION['restaurante'])){

  if(isset($_SESSION['id_nivel']) == 5){
    $liquidos = mostraValoresLiquidoR($_SESSION['restaurante']);
  }

$totalPedidos8dias = mostraDadosUltimos8diasTotalR($_SESSION['restaurante']);
$maisVendidos = produtos_mais_vendidosR($_SESSION['restaurante']);

} else {

  if(isset($_SESSION['id_nivel']) == 5){
    $liquidos = mostraValoresLiquido();
  }

$totalPedidos8dias = mostraDadosUltimos8diasTotal();
}

 ?>
<script>
$(function() {
    Morris.Line({
        element: 'morris-one-line-chart',
        data: [
                <?php
                  foreach($totalPedidos8dias as $ped8){
                    echo '{ y: "'.$ped8["data"].'", a: "'.$ped8["data_count"].'" },';
                  }
                ?>
              ],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Total de Pedidos'],
        hideHover: 'auto',
        resize: true,
        lineColors: ['#1ab394'],
        pointSize:6,
        lineWidth:3,

               xLabelFormat: function (x) {
                  var IndexToMonth = [ "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12" ];
                  var month = IndexToMonth[ x.getMonth() ];
                  var date = ("0" + x.getDate()).slice(-2)
                  return date + '/' + month;
              },
                dateFormat: function (x) {
                  var IndexToMonth = [ "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro" ];
                  var month = IndexToMonth[ new Date(x).getMonth() ];
                  var date = new Date(x).getDate();
                  var year = new Date(x).getFullYear();
                  return date + '/' + month + '/' + year;
              },
    });
});
</script>
<?php if($_SESSION['id_nivel'] < 5){ ?>
 <script>
     Morris.Donut({
        element: 'morris-donut-chart',
        data: [
                <?php
                  foreach($maisVendidos as $total){
                    echo '{ label: "'.$total["nome"].'", value: "'.$total["qtd"].'" },';
                  }
                ?>
              ],
        resize: true,
        colors: ['#87d6c6', '#54cdb4','#1ab394'],
    });
</script>
<?php } if($_SESSION['id_nivel'] == 5){ ?>
 <script>
        $(document).ready(function() {

            var lineData = {
                labels: [<?php foreach($liquidos as $liq){ echo '"'.$liq['data'].'",'; } ?>],
                datasets: [
                    {
                        label: "Restaurante",
                        fillColor: "rgba(220,220,220,0.5)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [<?php foreach($liquidos as $liq){ echo $liq['liquido_rest'].','; } ?>]
                    },
                    {
                        label: "Administração",
                        fillColor: "rgba(26,179,148,0.5)",
                        strokeColor: "rgba(26,179,148,0.7)",
                        pointColor: "rgba(26,179,148,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(26,179,148,1)",
                        data: [<?php foreach($liquidos as $liq){ echo $liq['liquido_adm'].','; } ?>]
                    }
                ]
            };

            var lineOptions = {
                scaleShowGridLines: true,
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleGridLineWidth: 1,
                bezierCurve: true,
                bezierCurveTension: 0.4,
                pointDot: true,
                pointDotRadius: 4,
                pointDotStrokeWidth: 1,
                pointHitDetectionRadius: 20,
                datasetStroke: true,
                datasetStrokeWidth: 2,
                datasetFill: true,
                responsive: true,
            };


            var ctx = document.getElementById("lineChart").getContext("2d");
            var myNewChart = new Chart(ctx).Line(lineData, lineOptions);

        });
    </script>
<?php } ?>