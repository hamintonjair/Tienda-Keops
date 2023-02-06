
 <!--javascripts for application to work-->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/Template/Admin/js/jquery-3.3.1.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/Template/Admin/js/toastr.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/Template/Admin/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/Template/Admin/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/Template/Admin/js/main.js"></script>
    <script src="<?php echo base_url(); ?>assets/Template/Admin/js/fontawesome.js"></script>  
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?php echo base_url(); ?>assets/Template/Admin/js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/plugins/jsBarcode.all.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/plugins/chart.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/plugins/dataTables.bootstrap.min.js"></script>
   
           
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/plugins/bootstrap-select.min.js"></script>
    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/plugins/select2.min.js"></script>  -->

    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>


    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/functions_admin.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/functions_roles.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/functions_usuarios.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/functions_perfil.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libreria/sweetalert2/dist/sweetalert2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/functions_clientes.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/functions_categorias.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/functions_productos.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/functions_pedidos.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/modal.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/functions_dashboard.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/functions_contactos.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/functions_paginas.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/functions_configuracion.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/functions_fotos.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/Template/Admin/js/datepicker/jquery-ui.min.js"></script>
   
    <script>
         const base_url = "<?= base_url(); ?>";
    </script>

      <script type="text/javascript">
         $('#tableUsuarios').dataTable( {
         "language":{"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"},
         dom: 'lBfrtip',
         buttons: [
               {
                  "extend": "copyHtml5",
                  "text": "<i class='far fa-copy'></i> Copiar",
                  "titleAttr":"Copiar",
                  "className": "btn btn-secondary",
                  "exportOptions":{
                     "columns":[0,1,2,3,4,5,6]
                  } 
               },{
                  "extend": "excelHtml5",
                  "text": "<i class='fas fa-file-excel'></i> Excel",
                  "titleAttr":"Expotar a Excel",
                  "className": "btn btn-success",
                  "exportOptions":{
                     "columns":[0,1,2,3,4,5,6]
                  }
               },{
                  "extend": "pdfHtml5",
                  "text": "<i class='fas fa-file-pdf'></i> PDF",
                  "titleAttr":"Exportar a PDF",
                  "className": "btn btn-danger",
                  "exportOptions":{
                     "columns":[0,1,2,3,4,5,6]
                  } 
               },{
                  "extend": "csvHtml5",
                  "text": "<i class='faa fa-file-csv'></i> CSV",
                  "titleAttr":"Eportar",
                  "className": "btn btn-secondary",
                  "exportOptions":{
                     "columns":[0,1,2,3,4,5,6]
                  } 
               },
            
         ],
         "resonsieve":"true",
         "bDestroy": true,
         "iDisplayLength": 10,
         "order":[[0,"desc"]]
         });
      </script>

      <script type="text/javascript">
         $('#tableRoles').dataTable({
         "language":{"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"},
         dom: 'lBfrtip',
        buttons: [
          {
               "extend": "copyHtml5",
               "text": "<i class='far fa-copy'></i> Copiar",
               "titleAttr":"Copiar",
               "className": "btn btn-secondary",
               "exportOptions":{
                  "columns":[0,1,2,3]
               } 
            },{
               "extend": "excelHtml5",
               "text": "<i class='fas fa-file-excel'></i> Excel",
               "titleAttr":"Expotar a Excel",
               "className": "btn btn-success",
               "exportOptions":{
                  "columns":[0,1,2,3]
               }
            },{
               "extend": "pdfHtml5",
               "text": "<i class='fas fa-file-pdf'></i> PDF",
               "titleAttr":"Exportar a PDF",
               "className": "btn btn-danger",
               "exportOptions":{
                  "columns":[0,1,2,3]
               } 
            },{
               "extend": "csvHtml5",
               "text": "<i class='faa fa-file-csv'></i> CSV",
               "titleAttr":"Eportar",
               "className": "btn btn-secondary",
               "exportOptions":{
                  "columns":[0,1,2,3]
               } 
            }
           
          ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]
        });
      </script>
     
      <script type="text/javascript">
         $('#tableClientes').dataTable({
          "language":{"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"},
         dom: 'lBfrtip',
        buttons: [
          {
               "extend": "copyHtml5",
               "text": "<i class='far fa-copy'></i> Copiar",
               "titleAttr":"Copiar",
               "className": "btn btn-secondary",
               "exportOptions":{
                  "columns":[0,1,2,3,4,5]
               } 
            },{
               "extend": "excelHtml5",
               "text": "<i class='fas fa-file-excel'></i> Excel",
               "titleAttr":"Expotar a Excel",
               "className": "btn btn-success",
               "exportOptions":{
                  "columns":[0,1,2,3,4,5]
               }
            },{
               "extend": "pdfHtml5",
               "text": "<i class='fas fa-file-pdf'></i> PDF",
               "titleAttr":"Exportar a PDF",
               "className": "btn btn-danger",
               "exportOptions":{
                  "columns":[0,1,2,3,4,5]
               } 
            },{
               "extend": "csvHtml5",
               "text": "<i class='faa fa-file-csv'></i> CSV",
               "titleAttr":"Eportar",
               "className": "btn btn-secondary",
               "exportOptions":{
                  "columns":[0,1,2,3,4,5]
               } 
            }
           
          ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]
        });
      </script>

      <script type="text/javascript">
         $('#tableCategorias').dataTable({
            "language":{"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"},
         dom: 'lBfrtip',
        buttons: [
          {
               "extend": "copyHtml5",
               "text": "<i class='far fa-copy'></i> Copiar",
               "titleAttr":"Copiar",
               "className": "btn btn-secondary",
               "exportOptions":{
                  "columns":[0,1,2,3]
               } 
            },{
               "extend": "excelHtml5",
               "text": "<i class='fas fa-file-excel'></i> Excel",
               "titleAttr":"Expotar a Excel",
               "className": "btn btn-success",
               "exportOptions":{
                  "columns":[0,1,2,3]
               }
            },{
               "extend": "pdfHtml5",
               "text": "<i class='fas fa-file-pdf'></i> PDF",
               "titleAttr":"Exportar a PDF",
               "className": "btn btn-danger",
               "exportOptions":{
                  "columns":[0,1,2,3]
               } 
            },{
               "extend": "csvHtml5",
               "text": "<i class='faa fa-file-csv'></i> CSV",
               "titleAttr":"Eportar",
               "className": "btn btn-secondary",
               "exportOptions":{
                  "columns":[0,1,2,3]
               } 
            }
           
          ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]
        });
      </script>

      <script type="text/javascript">
         $('#tableProductos').dataTable({
            "language":{"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"},
         dom: 'lBfrtip',
         "columnDefs":[
               {'className': "textcenter", "targets": [5]}, //status
               {'className': "textright", "targets": [4]},  //precio
               {'className': "textcenter", "targets": [3]}, //stock
         ],
        buttons: [
          {
               "extend": "copyHtml5",
               "text": "<i class='far fa-copy'></i> Copiar",
               "titleAttr":"Copiar",
               "className": "btn btn-secondary",
               "exportOptions":{
                  "columns":[0,1,2,3,4,5,6,7]
               }
            },{
               "extend": "excelHtml5",
               "text": "<i class='fas fa-file-excel'></i> Excel",
               "titleAttr":"Expotar a Excel",
               "className": "btn btn-success",
               "exportOptions":{
                  "columns":[0,1,2,3,4,5,6,7]
               }
            },{
               "extend": "pdfHtml5",
               "text": "<i class='fas fa-file-pdf'></i> PDF",
               "titleAttr":"Exportar a PDF",
               "className": "btn btn-danger",
               "exportOptions":{
                  "columns":[0,1,2,3,4,5,6,7]
               }
            },{
               "extend": "csvHtml5",
               "text": "<i class='faa fa-file-csv'></i> CSV",
               "titleAttr":"Eportar",
               "className": "btn btn-secondary",
               "exportOptions":{
                  "columns":[0,1,2,3,4,5,6,7]
               } 
            }
           
          ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]
        });
      </script>

       <script type="text/javascript">
         $('#tablePedidos').dataTable({
            "language":{"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"},
         dom: 'lBfrtip',
         "columnDefs":[
               {'className': "textcenter", "targets":  [5]},  //status
               {'className': "textcenter", "targets": [4]}, //tipo de pago
               {'className': "textright", "targets":  [3]}, //precio             
               {'className': "textcenter", "targets": [2]}, //fecha
        
         ],
        buttons: [
          {
               "extend": "copyHtml5",
               "text": "<i class='far fa-copy'></i> Copiar",
               "titleAttr":"Copiar",
               "className": "btn btn-secondary",
               "exportOptions":{
                  "columns":[0,1,2,3,4,5]
               }
            },{
               "extend": "excelHtml5",
               "text": "<i class='fas fa-file-excel'></i> Excel",
               "titleAttr":"Expotar a Excel",
               "className": "btn btn-success",
               "exportOptions":{
                  "columns":[0,1,2,3,4,5]
               }
            },{
               "extend": "pdfHtml5",
               "text": "<i class='fas fa-file-pdf'></i> PDF",
               "titleAttr":"Exportar a PDF",
               "className": "btn btn-danger",
               "exportOptions":{
                  "columns":[0,1,2,3,4,5]
               }
            },{
               "extend": "csvHtml5",
               "text": "<i class='faa fa-file-csv'></i> CSV",
               "titleAttr":"Eportar",
               "className": "btn btn-secondary",
               "exportOptions":{
                  "columns":[0,1,2,3,4,5]
               } 
            }
           
          ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]
        });
      </script>
      
      <script type="text/javascript">
         $('#tableSuscriptores').dataTable({
            "language":{"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"},
         dom: 'lBfrtip',        
        buttons: [
          {
               "extend": "copyHtml5",
               "text": "<i class='far fa-copy'></i> Copiar",
               "titleAttr":"Copiar",
               "className": "btn btn-secondary",
               "exportOptions":{
                  "columns":[0,1,2,3]
               }
            },{
               "extend": "excelHtml5",
               "text": "<i class='fas fa-file-excel'></i> Excel",
               "titleAttr":"Expotar a Excel",
               "className": "btn btn-success",
               "exportOptions":{
                  "columns":[0,1,2,3]
               }
            },{
               "extend": "pdfHtml5",
               "text": "<i class='fas fa-file-pdf'></i> PDF",
               "titleAttr":"Exportar a PDF",
               "className": "btn btn-danger",
               "exportOptions":{
                  "columns":[0,1,2,3]
               }
            },{
               "extend": "csvHtml5",
               "text": "<i class='faa fa-file-csv'></i> CSV",
               "titleAttr":"Eportar",
               "className": "btn btn-secondary",
               "exportOptions":{
                  "columns":[0,1,2,3]
               } 
            }
           
          ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]
        });
      </script>

      <script type="text/javascript">
         $('#tableContactos').dataTable({
            "language":{"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"},
         dom: 'lBfrtip',        
        buttons: [
          {
               "extend": "copyHtml5",
               "text": "<i class='far fa-copy'></i> Copiar",
               "titleAttr":"Copiar",
               "className": "btn btn-secondary",
               "exportOptions":{
                  "columns":[0,1,2,3]
               }
            },{
               "extend": "excelHtml5",
               "text": "<i class='fas fa-file-excel'></i> Excel",
               "titleAttr":"Expotar a Excel",
               "className": "btn btn-success",
               "exportOptions":{
                  "columns":[0,1,2,3]
               }
            },{
               "extend": "pdfHtml5",
               "text": "<i class='fas fa-file-pdf'></i> PDF",
               "titleAttr":"Exportar a PDF",
               "className": "btn btn-danger",
               "exportOptions":{
                  "columns":[0,1,2,3]
               }
            },{
               "extend": "csvHtml5",
               "text": "<i class='faa fa-file-csv'></i> CSV",
               "titleAttr":"Eportar",
               "className": "btn btn-secondary",
               "exportOptions":{
                  "columns":[0,1,2,3]
               } 
            }
           
          ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]
        });
      </script>

     <script type="text/javascript">
      
         $('#tablePaginas').dataTable({
            "language":{"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"},
         dom: 'lBfrtip', 
         "ajax":{
         "url": " "+base_url+"Paginas/getPaginas",        
         "dataSrc":""
         },
         "columns":[
            {"data":"idpost"},
            {"data":"titulo"},
            {"data":"fecha"},
            {"data":"status"},
            {"data":"options"}
         ],
         "columnDefs": [
                    { 'className': "textcenter", "targets": [ 2 ] },
                    { 'className': "textright", "targets": [ 3 ] },              
                  ],           
        buttons: [
          {
               "extend": "copyHtml5",
               "text": "<i class='far fa-copy'></i> Copiar",
               "titleAttr":"Copiar",
               "className": "btn btn-secondary",
               "exportOptions":{
                  "columns":[0,1,2]
               }
            },{
               "extend": "excelHtml5",
               "text": "<i class='fas fa-file-excel'></i> Excel",
               "titleAttr":"Expotar a Excel",
               "className": "btn btn-success",
               "exportOptions":{
                  "columns":[0,1,2]
               }
            },{
               "extend": "pdfHtml5",
               "text": "<i class='fas fa-file-pdf'></i> PDF",
               "titleAttr":"Exportar a PDF",
               "className": "btn btn-danger",
               "exportOptions":{
                  "columns":[0,1,2]
               }
            },{
               "extend": "csvHtml5",
               "text": "<i class='faa fa-file-csv'></i> CSV",
               "titleAttr":"Eportar",
               "className": "btn btn-secondary",
               "exportOptions":{
                  "columns":[0,1,2]
               } 
            }
           
          ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]
        });
     </script>

 <!-- usuarios -->
    
    <script>
		
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
                     $dato = 0;              
                    if($ventasMDia['total'] == 0){
                         echo  $dato.",";
                     }else{
                        echo $ventasMDia['total'].",";
                     }        
                  ?>
                ]
            }]
      });   

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
<!-- clientes -->

    <script>

      Highcharts.chart('graficaMes', {
      chart: {
          type: 'line'
      },
      title: {
          text: 'Ventas de <?= $ventasMDia['mes'].' del '.$ventasMDia['anio'] ?>'
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
                  echo $ventasMDia['total'].",";
                
            ?>
          ]
      }]
  });

   </script>
    
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
         (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
         (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
         m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
         })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
         ga('create', 'UA-72504830-1', 'auto');
         ga('send', 'pageview'); 
      }
      
    </script>
  </body>
</html>
