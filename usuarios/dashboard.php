<?php

     $n_conciertos=$connection->query("SELECT COUNT(*) as num_conciertos FROM `eventos` WHERE TIPO = 'concierto';");
     $n_festivales=$connection->query("SELECT COUNT(*) as num_festivales FROM `eventos` WHERE TIPO = 'festival';");
     $n_monologos=$connection->query("SELECT COUNT(*) as num_monologos FROM `eventos` WHERE TIPO = 'monologo';");
     $n_musicales=$connection->query("SELECT COUNT(*) as num_musicales FROM `eventos` WHERE TIPO = 'musical';");

     $obj1=$n_conciertos->fetch_object();
     $obj2=$n_festivales->fetch_object();
     $obj3=$n_monologos->fetch_object();
     $obj4=$n_musicales->fetch_object();

     $concierto=$obj1->num_conciertos;
     $festivales=$obj2->num_festivales;
     $monologos=$obj3->num_monologos;
     $musicales=$obj4->num_musicales;



?>

     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'eventos'],
          ['Conciertos', <?php echo "$concierto"; ?>],
          ['Festivales',  <?php echo "$festivales"; ?>],
          ['Monologos',  <?php echo "$monologos"; ?>],
          ['Musicales',  <?php echo "$musicales"; ?>]

        ]);

        var options = {
          title: 'Eventos'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <div id="piechart" style="width: 400px; height: 350px;"></div>
