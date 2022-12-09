//funcionalidad de las tablas
//tabla de importar_medicamento.php
$(document).ready(function(){
    tablaUsuarios = $('#tablaimportar').DataTable({  
        searching:true,
        "language":{
            "lengthMenu":"Mostrar _MENU_ registros",
            "zeroRecords":"No se encontraron resultados",
            "info":"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered":"(filtrado de un total de _MAX_ registros)",
            "sSearch":"Buscar:",
            "oPaginate":{
                "sFirst":"Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious":"Anterior"
             },
             "sProcessing":"Procesando...",
        }
    }); 

    $("#tablaimportar tbody").on("click", "tr", function () {
        var data = new Array();
        var td = $(this).find("td");
        var enlace="medicamento_importado.php"
        for (var i = 0; i < td.length; i++) {
            data.push(td.eq(i).text());
        }
       $.ajax({
        url:"abrir_ficha.php",
        type:"POST",
        datatype:"json",    
        data:  {
                datos:data
              },
        success: function(data) {     
         
           $(location).attr('href',enlace); 
        }
      }); 
    })
})


//Tabla de ficha_ordenes.php
$(document).ready(function(){
    tablaUsuarios = $('#tablaorden').DataTable({  
        searching:false,
        "language":{
            "lengthMenu":"Mostrar _MENU_ registros",
            "zeroRecords":"No se encontraron resultados",
            "info":"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered":"(filtrado de un total de _MAX_ registros)",
            "sSearch":"Buscar:",
            "oPaginate":{
                "sFirst":"Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious":"Anterior"
             },
             "sProcessing":"Procesando...",
        }
    }); 

    $("#tablaorden tbody").on("click","tr", function () {
        var data = new Array();
        var td = $(this).find("td");
        var enlace="crear_ordenes.php"
        for (var i = 0; i < td.length; i++) {
            data.push(td.eq(i).text());
        }
       $.ajax({
        url:"abrir_ficha.php",
        type:"POST",
        datatype:"json",    
        data:{
                datos:data
              },
        success: function(data) {     
         
           $(location).attr('href',enlace); 
        }
      }); 
    })
})

//Tabla de medicamentos.php
$(document).ready(function(){
    tablaUsuarios = $('#tablamedicamentos').DataTable({  
        searching:false,
        "language":{
            "lengthMenu":"Mostrar _MENU_ registros",
            "zeroRecords":"No se encontraron resultados",
            "info":"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered":"(filtrado de un total de _MAX_ registros)",
            "sSearch":"Buscar:",
            "oPaginate":{
                "sFirst":"Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious":"Anterior"
             },
             "sProcessing":"Procesando...",
        }
    }); 

    $("#tablamedicamentos tbody").on("click", "tr", function () {
        var data = new Array();
        var td = $(this).find("td");
        var enlace="fichaMed.php"
        for (var i = 0; i < td.length; i++) {
            data.push(td.eq(i).text());
        }
       $.ajax({
        url:"abrir_ficha.php",
        type:"POST",
        datatype:"json",    
        data:{
                datos:data
              },
        success:function(data) {     
         
           $(location).attr('href',enlace); 
        }
      }); 
    })
})

//Tabla de nuevaOrden.php
$(document).ready(function(){
    tablaUsuarios = $('#tablanuevaorden').DataTable({  
        searching: true,
        
        "language":{
            "lengthMenu":"Mostrar _MENU_ registros",
            "zeroRecords":"No se encontraron resultados",
            "info":"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered":"(filtrado de un total de _MAX_ registros)",
            "sSearch":"Buscar:",
            "oPaginate":{
                "sFirst":"Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious":"Anterior"
             },
             "sProcessing":"Procesando...",
        }
    }); 

    $("#tablanuevaorden tbody").on("click", "tr", function () {
        var data = new Array();
        var td = $(this).find("td");
        var enlace="crear_nuevaorden.php"
        for (var i = 0; i < td.length; i++) {
            data.push(td.eq(i).text());
        }
       $.ajax({
        url:"abrir_ficha.php",
        type:"POST",
        datatype:"json",    
        data:{
                datos:data
              },
        success: function(data) {     
         
           $(location).attr('href',enlace); 
        }
      }); 
    })
})