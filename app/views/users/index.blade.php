@extends("layouts.admin.index")

@section("content")
    <div class="clearfix">
        <a href="{{ route("users.create") }}" class="btn btn-primary">A&ntilde;adir nuevo usuario</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre y Apellido</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->description }}</td>
                    <td>
                        {{ Form::open(array("route" => array("users.destroy", $user->id), "method" => "delete", "role" => "form")) }}
                        <div class="btn-group">
                            <a href="{{ route("users.edit", $user->id) }}" class="btn btn-link">Editar</a>
                            {{ Form::submit("Borrar", array("class" => "btn btn-link"))}}
                        </div>
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $users->links() }}
@stop