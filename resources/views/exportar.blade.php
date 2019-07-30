<table>
    <tr>
        <td></td>
        <td></td>
        <td>
            <h1>Carreras {{ $datos['mes'] }}/{{ $datos['anio'] }}</h1>
        </td>
    </tr>
</table>

<table >
    <thead>
        <tr>
            <th style="background-color: #fff7ad; vertical-align: middle">No</th>
            <th style="background-color: #fff7ad; vertical-align: middle">ID</th>
            <th style="background-color: #fff7ad; vertical-align: middle">Taxi</th>
            <th style="background-color: #fff7ad; vertical-align: middle">Taxista</th>
            <th style="background-color: #fff7ad; vertical-align: middle">Zona</th>
            <th style="background-color: #fff7ad; vertical-align: middle">Fecha ini</th>
            <th style="background-color: #fff7ad; vertical-align: middle">Por</th>
            <th style="background-color: #fff7ad; vertical-align: middle">Celular llamado</th>
            <th style="background-color: #fff7ad; vertical-align: middle">Dirección encuentro</th>
            <th style="background-color: #fff7ad; vertical-align: middle">Estado</th>
            <th style="background-color: #fff7ad; vertical-align: middle">Fecha fin</th>
            <th style="background-color: #fff7ad; vertical-align: middle">Creada</th>
            <th style="background-color: #fff7ad; vertical-align: middle">Modificada</th>
        </tr>
    </thead>
    <tbody>
        @foreach($carreras as $key=>$carrera)
        <tr>
            <td>{{++$key}}</td>
            <td>{{$carrera->id}}</td>
            <td>{{$carrera->numero}}</td>
            <td>{{$carrera->nombres}} {{$carrera->apellidos}}</td>
            <td>{{$carrera->zona}}</td>
            <td>{{$carrera->fecha_ini}}</td>
            <td>{{$carrera->registrada_por}}</td>
            <td>{{$carrera->cell_llamado}}</td>
            <td>{{$carrera->lugar_ini}}</td>

            @if($carrera->estado == 'Cancelada')
                <td style="background-color: #fff7ad; vertical-align: middle; font-weight: bold">Cancelada</td>
            @else
                <td>{{$carrera->estado}}</td>
            @endif
            
            <td>{{$carrera->fecha_fin}}</td>
            <td>{{$carrera->created_at}}</td>
            <td>{{$carrera->updated_at}}</td>
        </tr>
        @endforeach
    </tbody>
</table>