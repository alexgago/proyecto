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