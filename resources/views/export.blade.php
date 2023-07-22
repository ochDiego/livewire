<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Fecha de contratación</th>
            <th>Cargo</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($empleados as $empleado)
            <tr>
                <td>{{$empleado->id}}</td>
                <td>{{$empleado->nombre}}</td>
                <td>{{$empleado->apellido}}</td>
                <td>{{$empleado->email}}</td>
                <td>{{$empleado->fecha_contratacion}}</td>
                <td>{{$empleado->cargo}}</td>
            </tr>
        @endforeach
    </tbody>
</table>