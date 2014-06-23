@extends("layouts.admin.index")

@section("content")
<div class="row">
    <div class="col-md-4">

    {{ Form::model($user, array("route" => array("users.update", $user->id), "method" => "patch", "role" => "form")) }}
      <div class="form-group{{ $errors->first("username", " has-error") }}">
        {{ Form::label("username", "Nombre de usuario") }}
        <p class="form-control-static">{{ $user->username }}</p>
        <p class="help-block"><small><i>No puede cambiar el nombre de usuario</i></small></p>
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
        {{ Form::label("display_name", "Mostrar este nombre publicamente") }}
        {{ Form::text("display_name", null, array("class" => "form-control")) }}
      </div>
      <div class="form-group">
        {{ Form::label("description", "Bio") }}
        {{ Form::textarea("description", null, array("class" => "form-control")) }}
      </div>
      <div class="form-group">
        {{ Form::label("url", "Web") }}
        <div class="input-group">
        <span class="input-group-addon">http://</span>
        {{ Form::text("url", null, array("class" => "form-control")) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label("fb_profile", "Facebook") }}
        <div class="input-group">
        <span class="input-group-addon">https://facebook.com/</span>
        {{ Form::text("fb_profile", null, array("class" => "form-control")) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label("tw_profile", "Twitter") }}
        <div class="input-group">
        <span class="input-group-addon">http://twitter.com/</span>
        {{ Form::text("tw_profile", null, array("class" => "form-control")) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label("gp_profile", "Google+") }}
        <div class="input-group">
        <span class="input-group-addon">http://plus.google.com/</span>
        {{ Form::text("gp_profile", null, array("class" => "form-control")) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label("role_id", "Perfil") }}
        {{ Form::select("role_id", $roles, null, array("class" => "form-control")) }}
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
      {{ Form::submit("Editar usuario", array("class" => "btn btn-primary")) }}
      <a href="{{ route("users.index") }}" class="btn btn-sm btn-link">Cancelar y volver</a>
    {{ Form::close() }}

    </div>
</div>
@stop