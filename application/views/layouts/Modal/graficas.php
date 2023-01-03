

<?php 
	if($grafica  == "tipoPagoMes"){      
 ?>

<script>    
  
    //    <?php var_dump('entramos'); ?>
       Highcharts.chart('pagosMesAnio', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Ventas por tipo pago, <?= $pagosMes['mes'].' '.$pagosMes['anio'] ?>',
         

        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [
                  <?php 
                        foreach ($pagosMes['tipospago'] as $pagos) {
                        echo "{name:'".$pagos->tipopago."',y:".$pagos->total."},";
                  }
                     ?>          
               ]
            }]
      }); 
  
</script>
<?php } ?>
<?php 
	if($grafica  =="ventasMes"){      
 ?>
 <script>
  Highcharts.chart('graficaMes', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Ventas de <?= $ventasMDia['mes']?> de <?= $ventasMDia['anio'] ?>'
            },
            subtitle: {
                text: 'Total Ventas <?= SMONEY.'. '.formatMoney($ventasMDia['total']) ?> '
            },
            xAxis: {
               categories: [
                           <?php 
                                 foreach ($ventasMDia['ventas'] as $dia) {

                                    echo $dia['dia'].",";
                                 }
                          ?>                          
                        ]              
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Dato',
                data: [
                  <?php                  
                    if($ventasMDia['total'] == 0){
                         echo  [0].",";
                     }else{
                        echo $ventasMDia['total'].",";
                     }        
                  ?>
                ]
            }]
      });   

 </script>
<?php } ?>
<?php 
	if($grafica  == "ventasAnio"){      
 ?>
 <script>
    Highcharts.chart('graficaAnio', {
         chart: {
            type: 'column'
         },
         title: {
            text: 'Ventas del año <?= $ventasAnio['anio'] ?>'
         },
         subtitle: {
            text: 'Esdística de ventas por mes'
         },
         xAxis: {
            type: 'category',
            labels: {
                  rotation: -45,
                  style: {
                     fontSize: '13px',
                     fontFamily: 'Verdana, sans-serif'
                  }
            }
         },
         yAxis: {
            min: 0,
            title: {
                  text: ''
            }
         },
         legend: {
            enabled: false
         },
         tooltip: {
            pointFormat: 'Population in 2021: <b>{point.y:.1f} millions</b>'
         },
         series: [{
            name: 'Population',
            data: [
             
                  <?php 
                    foreach ($ventasAnio['meses'] as $mes) {                               
                     //  echo "['".$mes['mes']."',".$mes['venta']."],";
                     if($mes['venta'] == ""){
                        echo  "['".$mes['mes']."', 0],";
                     }else{
                       echo  "['".$mes['mes']."',".$mes['venta']."],";
                     }
                   
                    }
                  ?>  
            ],
            dataLabels: {
                  enabled: true,
                  rotation: -90,
                  color: '#FFFFFF',
                  align: 'right',
                  format: '{point.y:.1f}', // one decimal
                  y: 10, // 10 pixels down from the top
                  style: {
                     fontSize: '13px',
                     fontFamily: 'Verdana, sans-serif'
                  }
            }
         }]
      });
 </script>
<?php } ?>