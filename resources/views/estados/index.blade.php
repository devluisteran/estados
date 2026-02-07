@extends("layauts.app")

<?php 
    $estados = [
        ['id' => 1, 'nombre' => 'Guerrero'],
        ['id' => 2, 'nombre' => 'Morelos'],
        ['id' => 3, 'nombre' => 'Monterrey'],
        ['id' => 4, 'nombre' => 'Monterrey'],
        ['id' => 5, 'nombre' => 'Jalisco'],
        ['id' => 6, 'nombre' => 'Nuevo León'],
        ['id' => 7, 'nombre' => 'Guerrero'],
        ['id' => 8, 'nombre' => 'Morelos'],
        ['id' => 9, 'nombre' => 'Monterrey'],
        ['id' => 10, 'nombre' => 'Monterrey'],
        ['id' => 11, 'nombre' => 'Jalisco'],
        ['id' => 12, 'nombre' => 'Nuevo León'],

    ];
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estados</title>
</head>

<body>
    <h1 class="text-center mt-4">Estados</h1>
    <div class="card mx-4 shadow-lg p-4 mb-5 bg-body-tertiary rounded">
        <div class="card-body p-4 ">

            <table class="table table-striped " id="tableEstados">
                <thead>
                    <tr class="text-center">
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Nombre del Estado</th>
                       
                    </tr>
                </thead>
                <tbody>
                   @foreach($estados as $estado)
                    <tr class="text-center ">
                        <th scope="row" id="{{$estado['id']}}" >{{ $estado['id'] }}</th>
                        <td class="clickable-row">{{ $estado['nombre'] }}</td>
                    </tr>
                   @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

@push("scripts")
<script>
    $(function(){
        $("#tableEstados").DataTable();

        $("#tableEstados tbody").on("click", "tr", function(){
            var id = $(this).find("th").attr("id");
            window.parent.location.href = "/estados/" + id;
        });

    });
</script>
@endpush

