
$(function() {    
    $('.date-picker').datepicker( {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['1 -', '2 -', '3 -', '4 -', '5 -', '6 -', '7 -', '8 -', '9 -', '10 -', '11 -', '12 -'],
        monthNamesShort: ['Enero','Febrero','Marzo','Abril', 'Mayo','Junio','Julio','Agosto','Septiembre', 'Octubre','Noviembre','Diciembre'],
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        showDays: false,
        onClose: function(dateText, inst) {
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
});
var divLoading = document.querySelector("#divLoading");

//pagos por mes y año
function fntSearchPagos(){
    let base_url = 'http://localhost/sitio-keops/';
    let fecha = document.querySelector(".pagoMes").value;
    if(fecha == ""){
        MostrarAlertaAlert("", "Seleccione mes y año" , "error");
        return false;
    }else{      

        // divLoading.style.display = "flex";   
        let request = (window.XMLHttpRequest) ? 
        new XMLHttpRequest() : 
        new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Administrador/tipoPagoMes';
        divLoading.style.display = "flex";
        let formData = new FormData();
        formData.append('fecha',fecha);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           
            if(request.readyState != 4) return;          
            if(request.status == 200){              
                $("#pagosMesAnio").html(request.responseText);
                divLoading.style.display = "none";
                return false;
            }
        }       
    }
}
//ventas por dia
function fntSearchVMes(){
    let fecha = document.querySelector(".ventasMes").value;
    let base_url = 'http://localhost/sitio-keops/';
    if(fecha == ""){
        MostrarAlertaAlert("", "Seleccione mes y año" , "error");
        return false;
    }else{
        let request = (window.XMLHttpRequest) ? 
            new XMLHttpRequest() : 
            new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Administrador/ventasMes';
        divLoading.style.display = "flex";
        let formData = new FormData();
        formData.append('fecha',fecha);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState != 4) return;
            if(request.status == 200){
                $("#graficaMes").html(request.responseText);
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}
//ventas por año
function fntSearchVAnio(){
    let anio = document.querySelector(".ventasAnio").value;
    let base_url = 'http://localhost/sitio-keops/';
    if(anio == ""){
        MostrarAlertaAlert("", "Ingrese año " , "error");
        return false;
    }else{
        let request = (window.XMLHttpRequest) ? 
            new XMLHttpRequest() : 
            new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Administrador/ventasAnio';
        divLoading.style.display = "flex";
        let formData = new FormData();
        formData.append('anio',anio);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState != 4) return;
            if(request.status == 200){
                $("#graficaAnio").html(request.responseText);
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}
function MostrarAlertaAlert(title, text, icon)
  {  
        Swal.fire({
            title,
            text,
            icon                      
         });         
		
  }