<?php
date_default_timezone_set('America/El_Salvador');
// Obtener los valores de PHP que se utilizarán en el PDF
$areaNombre = $_SESSION['areaBuffer']['Nombre'];
$hora_actual = date('Y-m-d H:i:s');
$nombreA = $productos[0]['NombreA'];
$saldoInicial = $productos[0]['SaldoInicial']
?>

<script>
$(document).ready(function() {
    var areaNombre = <?php echo json_encode($areaNombre); ?>;
    var nombreA = <?php echo json_encode($nombreA); ?>;
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
                    var NombreArticulo = "Nombre del Articulo:" + nombreA;
                    var fechaLineaLength = fechaLinea.length;
                    var AreaNombre = "CENTRO DE SANGRE : : : AREA DE " + areaNombre;
                    var SaldoInicial = "Saldo Inicial: " + saldo;
                    // Agregar espacios para alinear a la derecha
                    var espacios = ' '.repeat(225 - fechaLineaLength);
                    var espacios2 = ' '.repeat(260 - fechaLineaLength);
                    return AreaNombre + "\nIMPRESION DE KARDEX POR ARTICULO\n" + espacios +
                        fechaLinea + "\n" + NombreArticulo + "\n" + espacios2 + SaldoInicial +
                        "\n" + data;
                }
            }, {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Exportar a Excel",
                "title": "IMPRESION DE KARDEX POR ARTICULO",
            }, {
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Exportar a PDF",
                "orientation": "landscape",
                "title": "",
                "customize": function(doc) {
                    // Agregar texto personalizado encima de la tabla
                    doc.content.splice(0, 0, {
                        text: "CENTRO DE SANGRE : : : AREA DE " + areaNombre,
                        fontSize: 10,
                        alignment: 'left',
                        margin: [0, 0, 0, 5]
                    });
                    doc.content.splice(1, 0, {
                        text: "IMPRESION DE KARDEX POR ARTICULO",
                        fontSize: 10,
                        alignment: 'left',
                        margin: [0, 0, 0, 5]
                    });
                    doc.content.splice(2, 0, {
                        text: "Fecha Actual: " + hora,
                        fontSize: 10,
                        alignment: 'right',
                        margin: [0, 0, 0, 5]
                    });
                    doc.content.splice(3, 0, {
                        text: "Nombre del Articulo: " + nombreA,
                        fontSize: 10,
                        alignment: 'left',
                        margin: [0, 0, 0, 5]
                    });
                    doc.content.splice(4, 0, {
                        text: "Saldo Inicial: " + saldo,
                        fontSize: 10,
                        alignment: 'right',
                        margin: [0, 0, 0, 18]
                    });

                    // Quitar colores de fondo de las celdas y filas
                    doc.styles.tableBodyOdd = {
                        fillColor: 'white',
                        textColor: 'black',
                        alignment: 'center'
                    };
                    doc.styles.tableBodyEven = {
                        fillColor: 'white',
                        textColor: 'black',
                        alignment: 'center'
                    };
                    doc.styles.tableHeader = {
                        fillColor: 'white',
                        textColor: 'black',
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
    // Agregar texto personalizado al documento de impresión
    $(win.document.body).find('h1').text(
        "CENTRO DE SANGRE : : : AREA DE " + areaNombre);
    $(win.document.body).find('h1').css({
        "font-size": "16px",
        "font-weight": "bold",
        "text-align": "center"
    });

    // Agregar hora a la derecha
    var horaParagraph = $("<p>").text("Fecha Actual: " + hora).css({
        "position": "absolute",
        "top": "0",
        "right": "0",
        "margin": "0",
        "font-size": "10px"
    });
    $(win.document.body).append(horaParagraph);
}

            },
        ],
    });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>