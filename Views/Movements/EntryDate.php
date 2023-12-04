<?php 
include_once "./Core/config.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Entradas por rango de fecha - Cruz Roja</title>
    <link rel="stylesheet" href="styles/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <?php
    include_once "./Views/charts.php";
    ?>
</head>

<body>
    <?php 
 require_once "./Views/NavbarScreen.php";
?>
    <div class="row mx-5 mt-5">
        <h2 style="text-align:center" class="display-6">Entradas por rango de fecha</h5>
            <h6 class="display-6"> <?=$_SESSION['areaBuffer']['Nombre'];?>: <?=$_SESSION['dataBuffer']['Nombre']?>
                <?=$_SESSION['dataBuffer']['Apellido']?></h6>
            <div class="row mt-3">
                <form method="post" id="filterForm" onsubmit="return validateForm();">
                    <div class="col-md-8">
                        <div id="warningMessage" class="text-danger py-3 my-2" style="display: none;"></div>
                        <div class="input-group">
                            <input type="date" name="inicial" class="col-md-3 form-control" id="inicial">
                            <input type="date" name="final" class="col-md-3 form-control" id="final">
                            <input type="submit" title="Buscar" id="search" name="search" value="Buscar"
                                onclick="searchDate()" class="col-md-2 btn btn-outline-danger">
                            <input type="button" id="clean" title="Limpiar" value="Limpiar" onclick="cleanData()"
                                class="col-md-2 btn btn-outline-danger">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col ml-5">
                <div class="row mt-3">
                    <?php
                    
                    if(isset($datos)&& !empty($datos))
                    {
                    ?>
                    <div class="col-md-8 offset-2 mt-3">
                        <div class="chart" id="chart">

                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <table class="table table-bordered " id="datatable">
                        <thead class="Te" style="background-color: #FF8B8B">
                            <tr>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Artículo</th>
                                <th class="text-center">Entrada</th>
                                <th class="text-center">Saldo resultante</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    foreach($productos as $producto)
                    {
                        ?>
                            <tr id="id_<?=$producto['Id_Correlativo']?>">
                                <td class="text-center"><?=$producto['F_Movimiento']?></td>
                                <td class="text-center"><?=$producto['NombreA']?></td>
                                <td class="text-center"><?=$producto['Entrada']?></td>
                                <td class="text-center"><?=$producto['SaldoResultante']?></td>
                            </tr>
                            <?php
                     }
                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
    </script>

    <script>
    function searchDate() {
        var initialDate = document.getElementById('inicial').value;
        var finalDate = document.getElementById('final').value;

        if (initialDate === '' || finalDate === '') {
            return;
        }

        $.ajax({
            url: '<?=PATH?>Movements/EntryByDate',
            type: 'POST',
            data: {
                inicial: initialDate,
                final: finalDate,
                ajax: true
            },
            success: function(data) {
                $('#datatable tbody').empty();
                for (var i = 0; i < data.length; i++) {
                    var row = '<tr id="id_' + data[i]['Id_Correlativo'] + '">';
                    row += '<td class="text-center">' + data[i]['F_Movimiento'] + '</td>';
                    row += '<td class="text-center">' + data[i]['NombreA'] + '</td>';
                    row += '<td class="text-center">' + data[i]['Entrada'] + '</td>';
                    row += '<td class="text-center">' + data[i]['SaldoResultante'] + '</td>';
                    row += '</tr>';
                    $('#datatable tbody').append(row);
                }
            },
            error: function(error) {
                console.log('Error en la solicitud AJAX:', error);
            }
        });
    }

    function validateForm() {
        var initialDate = document.getElementById('inicial').value;
        var finalDate = document.getElementById('final').value;

        if (initialDate === '' || finalDate === '') {
            $('#warningMessage').text('- Debes seleccionar un rango de fechas.').show();
            return false;
        }

        return true;
    }

    function cleanData() {
        document.getElementById('inicial').value = '';
        document.getElementById('final').value = '';
        buscarDatos();
    }
    </script>


    <script>
    Highcharts.chart('chart', {
        chart: {
            type: 'pie'
        },
        title: {
            text: ''
        },
        tooltip: {
            valueSuffix: '%'
        },
        subtitle: {
            text: '<?php echo "Productos recibidos durante el periodo de ".$initialDate." al ".$finalDate;  ?>'
        },
        plotOptions: {
            series: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: [{
                    enabled: true,
                    distance: 20
                }, {
                    enabled: true,
                    distance: -40,
                    format: '{point.percentage:.1f}%',
                    style: {
                        fontSize: '1.2em',
                        textOutline: 'none',
                        opacity: 0.7
                    },
                    filter: {
                        operator: '>',
                        property: 'percentage',
                        value: 10
                    }
                }]
            }
        },
        series: [{
            name: 'Percentage',
            colorByPoint: true,
            data: [
                <?php
                    foreach($datos as $dato)
                    {
                        echo "{name:'".$dato['NombreA']."',y:".$dato['CantidadTotal']."},";
                    }    
                    ?>
            ]
        }]
    });
    </script>
</body>

</html>