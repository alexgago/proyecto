$(document).ready(function () {
    longitud = $(".chk-box").length;
    $("#modalvias").click(function () {
        $('#mostrarModal').modal('show');
        //muestra todos los values de los checkbox que estan checked
        for (let index = 0; index < longitud; index++) {
            if ($("#" + (index + 1)).prop('checked')) {
                for (let i = 0; i < longitud; i++) {
                    if ($("#" + (i + 1)).val() == $("#" + $(".chk-box")[index].id).val()) {
                        $("#" + $(".chk-box")[index].id).prop("checked", true);

                    }
                }
            }
        }
    });
    //comprobamos que checkbox esta seleccionado.
    $("#enviar1").click(function () {
        vias_predefinidas = [];
        vias_seleccionadas = [];
        pa_actual = $("#v_pa").val();
        localStorage.setItem("pa_actual", pa_actual);
        formulacion_actual = $("#v_formu").val();
        localStorage.setItem("formulacion_actual", formulacion_actual);

        for (let index = 0; index < longitud; index++) {
            //guardamos las vias que estaba seleccionadas previamente
            localStorage.setItem("vias_predefinidas", vias_predefinidas);
            vias_predefinidas.push($("#" + (index + 1)).val());
            if (!($("#" + $(".chk-box")[index].id).prop("checked"))) {
                for (let i = 0; i < longitud; i++) {
                    if ($("#" + (i + 1)).val() == $("#" + $(".chk-box")[index].id).val()) {

                        $("#" + (i + 1)).prop("checked", false);
                    }
                }
            } else {
                $("#" + (index + 1)).prop("checked", true);
                //guardamos las vias seleccionadas
                localStorage.setItem('vias_selecccionadas', vias_seleccionadas);
                vias_seleccionadas.push($("#" + (index + 1)).val());
            }
        }
        console.log($("#pa").val());
        $.ajax({
            url:"conexion/conexionCrud.php",
            type:"POST",
            datatype:"json",
            data: {
                vias_predefinidas: vias_predefinidas,
                vias_seleccionadas: vias_seleccionadas,
                formulacion_actual: formulacion_actual,
                pa_actual: pa_actual
            },
        })
        $("#pa").val($("#v_pa").val());
        $("#medicamento").val($("#v_formu").val());
        $('#mostrarModal').modal('hide');
    });

    $("#close").click(function () {
        $('#mostrarModal').modal('hide');
    });
    $("agregarCambios1").click(function () {
        var campo = document.getElementById("input");
        if (campo.value === '') {
            campo.style.backgroundColor = "red";
        }
        else {
            campo.style.backgroundColor = "green";
        }
    });
});
function Color(ele) {
    if ($(ele).val() == "") {
        $(ele).css("background-color", "red");
    }
}

function myFunction() {

}