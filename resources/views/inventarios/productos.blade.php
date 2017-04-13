<html>
    
    <td colspan="3" style="text-align: center"> <h1>Productos</h1> </td>

    <table border="1px">
        <tr style="text-align: center">
            <td style="border: 1px solid #000;"><b>No</b></td>
            <td style="border: 1px solid #000;"><b>Nombre</b></td>
            <td style="border: 1px solid #000;"><b>Costo</b></td>
            <!-- Images 
            <td><img src="images/perfil/user_1/logo_hunter.jpg" style="width: 20px; height: 20px" /></td>
            -->
        </tr>
        @foreach ($productos as $i => $producto)
            <tr>

            @php
                $color = '#ccc';
                if ($i % 2 == 0) $color = '#fff';
            @endphp


                <td style="border: 1px solid #000; background-color: {{ $color  }}">{{ $producto->id }}</td>
                <td style="border: 1px solid #000; background-color: {{ $color  }}">{{ $producto->nombre }}</td>
                <td style="border: 1px solid #000; background-color: {{ $color  }}">{{ $producto->precio_costo }}</td>


            </tr>
        @endforeach

    </table>

</html>
