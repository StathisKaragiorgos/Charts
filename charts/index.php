<?php
    $con=mysqli_connect();
    if($con){
        echo "Connection succeed!!";
    }
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Month', 'Income (Millions)'],
          <?php
            $sql="SELECT * FROM milton_athens";
            $fire=mysqli_query($con,$sql);
                while($result = mysqli_fetch_assoc($fire)){
                    echo "['".$result["Month"]."',".$result['Income (Millions)']."],";
                }
          ?>

            ]);
        var options = {
          title: ' Milton Athens Hotel incomes!'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Income (Millions)', 'Outcome (Millions)', 'Profit'],
         <?php
            $sql="SELECT * FROM milton_athens";
            $fire=mysqli_query($con,$sql);
                while ($result=mysqli_fetch_assoc($fire)){
                    $Profit=$result['Income (Millions)']-$result['Outcome (Millions)'];
                    echo "['".$result['Month']."',".$result['Income (Millions)'].",".$result['Outcome (Millions)'].",".$Profit."],";
                }
         ?>
        ]);

        var options = {
          chart: {
            title: 'Incomes, Outcomes and Company profits',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
    <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
  </body>
</html>