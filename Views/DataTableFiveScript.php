<?php
date_default_timezone_set('America/El_Salvador');
// Obtener los valores de PHP que se utilizarán en el PDF
$areaNombre = $_SESSION['areaBuffer']['Nombre'];
$hora_actual = date('Y-m-d H:i:s');
$nombreA = $productos[0]['NombreA'];
$nombreD = $productos[0]['NombreD'];
$saldoInicial = $productos[0]['SaldoInicial']
?>

<script>
$(document).ready(function() {
    var areaNombre = <?php echo json_encode($areaNombre); ?>;
    var nombreA = <?php echo json_encode($nombreA); ?>;
    var nombreD = <?php echo json_encode($nombreD); ?>;
    var hora = <?php echo json_encode($hora_actual); ?>;
    var saldo = <?php echo json_encode($saldoInicial); ?>;

    $('#datatable').DataTable({
        dom: 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [
            'pageLength', {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr": "Copiar",
                "title": "",
                "customize": function(data) {
                    var fechaLinea = "Fecha Actual: " + hora;
                    // var NombreDepartamento = "Nombre del Departamento:" + nombreD;
                    var fechaLineaLength = fechaLinea.length;
                    // var SaldoInicial = "Saldo Inicial: " + saldo;
                    // Agregar espacios para alinear a la derecha
                    var espacios = ' '.repeat(225 - fechaLineaLength);
                    var espacios2 = ' '.repeat(260 - fechaLineaLength);
                    return "IMPRESION DE SALIDAS POR RANGO DE FECHA\n" + espacios +
                        fechaLinea + "\n" + espacios2 +
                        "\n" + data;
                }
            }, {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Exportar a Excel",
                "title": "IMPRESION DE SALIDAS POR RANGO DE FECHA",
            }, {
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Exportar a PDF",
                "orientation": "landscape",
                "title": "",
                "customize": function(doc) {
                    // Agregar texto personalizado encima de la tabla
                    doc.content.splice(0, 0, {
                        text: "IMPRESION DE SALIDAS POR RANGO DE FECHA",
                        fontSize: 10,
                        alignment: 'left',
                        margin: [0, 0, 0, 12]
                    });
                    doc.content.splice(1, 0, {
                        text: "Fecha Actual: " + hora,
                        fontSize: 10,
                        alignment: 'right',
                        margin: [0, 0, 0, 20]
                    });
                    //doc.content.splice(2, 0, {
                    //    text: "Nombre del Departamento: " + nombreD,
                    //    fontSize: 10,
                    //    alignment: 'left',
                    //    margin: [0, 0, 0, 5]
                    //});
                    // doc.content.splice(3, 0, {
                    //     text: "Saldo Inicial: " + saldo,
                    //     fontSize: 10,
                    //     alignment: 'right',
                    //     margin: [0, 0, 0, 18]
                    // });
                    doc.styles.tableHeader = {
                        fillColor: '#FF8B8B', // Reemplaza 'yourColor' con el color que desees
                        alignment: 'center'
                    };
                }
            }, {
                "extend": "csvHtml5",
                "text": "<i 'fas fa-file-csv'></i> CSV",
                "titleAttr": "Exportar a CSV"
            }, {
                "extend": "print",
                "text": "<i class='fas fa-print'></i> PRINT",
                "titleAttr": "Exportar a PRINT",
                "customize": function(win) {

                    // Eliminar la función predeterminada que agrega la fecha
                    $(win.document.body).find('title').remove();


                    // Agregar texto personalizado al documento de impresión
                    $(win.document.body).find('h1').text(
                        "IMPRESION DE SALIDAS POR RANGO DE FECHA");
                    $(win.document.body).find('h1').css({
                        "font-size": "16px",
                        "font-weight": "bold",
                        "text-align": "center"
                    });

                    // Agregar nombreA debajo de areaNombre a la izquierda
                    // var nombreAParagraph = $("<p>").text("Nombre del departamento: " + nombreD)
                    //     .css({
                    //         "position": "absolute",
                    //         "top": "12px", // Ajusta según sea necesario
                    //         "left": "0",
                    //         "margin": "0",
                    //         "font-size": "10px"
                    //     });
                    //$(win.document.body).append(nombreAParagraph);

                    // Agregar hora a la derecha
                    var horaParagraph = $("<p>").text("Fecha Actual: " + hora).css({
                        "position": "absolute",
                        "top": "0",
                        "right": "0",
                        "margin": "0",
                        "font-size": "10px"
                    });
                    $(win.document.body).append(horaParagraph);

                    // Agregar saldoInicial debajo de hora
                    // var saldoParagraph = $("<p>").text("Saldo Inicial: " + saldo).css({
                    //     "position": "absolute",
                    //     "top": "15px",
                    //     "right": "0",
                    //     "margin": "0px",
                    //     "font-size": "10px"
                    // });
                    // $(win.document.body).append(saldoParagraph);




                }
            },
        ],
    });
});
</script>