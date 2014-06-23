@extends("layouts.admin.index")

@section("content")
<div class="row">
    <div class="col-md-4">

    {{ Form::open(array("route" => "users.store", "method" => "post", "role" => "form")) }}
      <div class="form-group{{ $errors->first("username", " has-error") }}">
        {{ Form::label("username", "Nombre de usuario") }}
        {{ Form::text("username", null, array("class" => "form-control")) }}
        <p class="help-block"><small><i>Requerido</i></small></p>
        @if($errors->has("username"))
        <p class="help-block"><small><i>{{ $errors->first("username") }}</i></small></p>
        @endif
      </div>
      <div class="form-group{{ $errors->first("email", " has-error") }}">
        {{ Form::label("email", "Correo electr&oacute;nico") }}
        {{ Form::text("email", null, array("class" => "form-control")) }}
        <p class="help-block"><small><i>Requerido</i></small></p>
        @if($errors->has("email"))
        <p class="help-block"><small><i>{{ $errors->first("email") }}</i></small></p>
        @endif
      </div>
      <div class="form-group">
        {{ Form::label("first_name", "Nombre") }}
        {{ Form::text("first_name", null, array("class" => "form-control")) }}
      </div>
      <div class="form-group">
        {{ Form::label("last_name", "Apellido") }}
        {{ Form::text("last_name", null, array("class" => "form-control")) }}
      </div>
      <div class="form-group">
        {{ Form::label("url", "Web") }}
        {{ Form::text("url", null, array("class" => "form-control")) }}
      </div>
      <div class="form-group">
        {{ Form::label("role_id", "Perfil") }}
        {{ Form::select("role_id", $roles, null, array("class" => "form-control")) }}
      </div>
      <div class="form-group">
         <div class="checkbox">
          {{ Form::checkbox("send_pass", 1) }}
          {{ Form::label("send_pass", "Enviar contrase&ntilde;a a usuario por email") }}
        </div>
      </div>
      <div class="form-group{{ $errors->first("password", " has-error") }}">
        {{ Form::label("password", "Contrase&ntilde;a") }}
        {{ Form::password("password", array("class" => "form-control")) }}
        <p class="help-block"><small><i>Requerido</i></small></p>
        @if($errors->has("password"))
        <p class="help-block"><small><i>{{ $errors->first("password") }}</i></small></p>
        @endif
      </div>
      <div class="form-group{{ $errors->first("password_confirmation", " has-error") }}">
        {{ Form::label("password_confirmation", "Confirmar contrase&ntilde;a") }}
        {{ Form::password("password_confirmation", array("class" => "form-control")) }}
        <p class="help-block"><small><i>Requerido</i></small></p>
        @if($errors->has("password_confirmation"))
        <p class="help-block"><small><i>{{ $errors->first("password_confirmation") }}</i></small></p>
        @endif
      </div>
      {{ Form::submit("A&ntilde;adir nuevo usuario", array("class" => "btn btn-primary")) }}
      <a href="{{ route("users.index") }}" class="btn btn-sm btn-link">Cancelar y volver</a>
    {{ Form::close() }}

    </div>
</div>
@stop