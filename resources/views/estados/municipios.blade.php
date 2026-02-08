@extends("layauts.app")

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Municipios</title>
</head>

<body>
    <h1 class="text-center mt-4">Municipios de {{$estado["name"]}}</h1>
    <div class="card mx-4 shadow-lg p-4 mb-5 bg-body-tertiary rounded">
        <div class="card-body p-4 ">

            <table class="table table-striped " id="tableEstados">
                <thead>
                    <tr class="text-center">
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Nombre del Municipio</th>
                       
                    </tr>
                </thead>
                <tbody>
                   @foreach($municipios as $key => $municipio)
                    <tr class="text-center ">
                        <th scope="row"  >{{ $key + 1 }}</th>
                        <td >{{ $municipio }}</td>
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

    });
</script>
@endpush

