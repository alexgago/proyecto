$(document).ready(function(){
    tablaPermisos=$('#tablaPermisos').DataTable({
        "aaSorting":[],
        'pageLength':30,
    });

    tablaPermisos1=$('#tablaPrincipal').DataTable({
    
     /*  "columnDefs":[{
           "targets": -1,
           "data":null,
           "defaultContent":"<div class='text-center'><div class='btn-group'><button class='btn btn-default btn-editar btnEditar' data-bs-toggle='modal' data-bs-target='#mostrarModal'> <span class='material-symbols-outlined'>edit</span></button></div></div>",
       }],*/
          
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

   tablaPermisos1=$('#tablaPrincipalPermisos').DataTable({
    
      /*"columnDefs":[{
          "targets":-1,
          "data":null,
          "defaultContent":"<div class='text-center'><div class='btn-group'><button class='btn btn-default btn-editar btnEditar' data-bs-toggle='modal' data-bs-target='#mostrarModal'> <span class='material-symbols-outlined'>edit</span></button></div></div>",
      }],*/
         
      "language": {
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


   //aqui me devuelve el nombre del roll
   var nombre_rol;
   var valor=$(document).on("click",'.btnEditar',function(){
       fila = $(this).closest("tr");
       nombre_rol=fila.find('td:eq(0)').text();
       localStorage.setItem("nombre_rol", nombre_rol);
       $.ajax({
           url:"./conexion/conexionCrud.php",
           type:"POST",
           datatype:"json",    
           data:{
                nombre_rol: nombre_rol
  
                 },    
         });	

     
   });
//simplemente muestra modal
$(".btn-editar").click(function(){
   $('#mostrarModal').modal('show');
}); 
//aqui me guarda el id de los permisos en un array  que posteriormente los enviara por ajax para ser insertados en la BD
$("#formulario").submit(function(e){
   e.preventDefault();
   cambiar="boton cambia permisos";
   var array=[];
   $('input[type=checkbox]:checked').each(function() {
       array.push($(this).prop("id"));
   });
   alert(array);
   $.ajax({
       url:"conexion/conexionCrud.php",
       type:"POST",
       datatype:"json",
       data:{
           permisos:array,
           nombre_rol:nombre_rol,
           cambiar:cambiar
       },
   })
   $('#mostrarModal').modal('hide');
   /* console.log(nombre_rol);
   console.log(array); */
})
//checkbox en el que selecciona todos anterirores
$("#Todos").change(function () {
   $("input:checkbox").prop('checked', $(this).prop("checked"));
});


});