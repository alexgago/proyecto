$(document).ready(function(){
    var id_rol, opcion;
    opcion = 3;
    tablaUsuarios = $('#tablaUsuarios').DataTable({  
    /*    searching: false,
        paging: false, 
        info: false, */
        "ajax":{            
            "url":"./conexion/conexionCrud.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion}, //enviamos opcion 3para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data":"id_rol"},
            {"data":"nombre"},
            {"data":"grupo"},
            {"data":"descripcion_medicamento"},
            {"data":"estado"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button></div></div>"}
        ],
  
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
   

    $("#btnNuevo").click(function(){
        opcion = 1; //alta           
        id_rol=null;
        $("#formUsuarios2").trigger("reset");
        $(".modal-header").css("background-color","#17a2b8");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Alta de Rol");
        $('#modalNuevo').modal('show');	    
    });
    
    //Editar        
    $(document).on("click", ".btnEditar", function(){		        
        opcion = 2;//editar
        fila = $(this).closest("tr");	        
        id_rol=parseInt(fila.find('td:eq(0)').text());
        nombre = fila.find('td:eq(1)').text(); //capturo el ID		            
        grupo = fila.find('td:eq(2)').text();
        descripcion_medicamento = fila.find('td:eq(3)').text();
        if(fila.find('td:eq(4)').text() == "si"){
            estado= $('#estado').prop('checked',true);
          
        }else{
            estado= $('#estado').prop('checked',false);
            
        }
        //guardamos los valores previos
      
        localStorage.setItem("id_rol", id_rol);
        localStorage.setItem("nombre", nombre);
        localStorage.setItem("grupo", grupo);
        localStorage.setItem("descripcion_medicamento", descripcion_medicamento); 
      
    
        $("#id_rol").val(id_rol);
        $("#nombre").val(nombre);
        $("#grupo").val(grupo);
        $("#descripcion_medicamento").val(descripcion_medicamento);
        $("#activo").val(estado);
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Rol");		
        $('#modalCRUD').modal('show');
        console.log($("#nombre").val(nombre));	   
    });
    
    
    $('#formUsuarios').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        id_rol = $.trim($('#id_rol').val());    
        nombre = $.trim($('#nombre').val());    
        grupo = $.trim($('#grupo').val());
        descripcion_medicamento = $.trim($('#descripcion_medicamento').val()); 
        guardar="boton guardar";
        if( $('#estado').prop('checked')){
            estado="si";
            localStorage.setItem("estado", estado);
        }else{
            estado="no"
            localStorage.setItem("estado", estado);
        } 
        valores=[];
        valores.push(localStorage.getItem("id_rol"),localStorage.getItem("nombre"),localStorage.getItem("grupo"),localStorage.getItem("descripcion_medicamento"),localStorage.getItem("estado")); 
            $.ajax({
              url:"conexion/conexionCrud.php",
              type:"POST",
              datatype:"json",    
              data:{
                      id_rol:id_rol, 
                      nombre:nombre,
                      grupo:grupo,
                      descripcion_medicamento:descripcion_medicamento,
                      estado:estado,
                      opcion:opcion,
                      guardar:guardar,
                      valores:valores
     
                    },    
              success:function(data) {     
                tablaUsuarios.ajax.reload(null, false);
               }
            });			        
        $('#modalCRUD').modal('hide');											     			
    });
    })