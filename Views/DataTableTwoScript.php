<?php
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

    $('#datatable2').DataTable({
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
            }, {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Exportar a Excel",
                "title": "",
            }, {
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Exportar a PDF",
                "orientation": "landscape",
                "title": "",
                "customize": function(doc) {
                    // Agregar texto personalizado encima de la tabla
                    doc.content.splice(0, 0, {
                        text: "IMPRESIONES DE MOVIMIENTOS POR DEPARTAMETO",
                        fontSize: 10,
                        alignment: 'left',
                        margin: [0, 0, 0, 5]
                    });
                    doc.content.splice(1, 0, {
                        text: "Fecha Actual: " + hora,
                        fontSize: 10,
                        alignment: 'right',
                        margin: [0, 0, 0, 5]
                    });
                    doc.content.splice(2, 0, {
                        text: "Nombre del Departamento: " + nombreD,
                        fontSize: 10,
                        alignment: 'left',
                        margin: [0, 0, 0, 5]
                    });
                    doc.content.splice(3, 0, {
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
                "titleAttr": "Exportar a PRINT"
            },
        ],
    });
});
</script>