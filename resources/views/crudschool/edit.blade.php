@extends('layouts.app')
@section("content")
	<div class="row">
		<div class="col-12">
			<form method="POST" action="{{route('crud_schools.update', $crud_schools)}}">
				@method("PUT")
				@csrf
				<div class="form-group">
					<label class="label fw-bold">Nombre</label>
					<input required value="{{$crud_schools->name}}" autocomplete="off" name="name" class="formcontrol fw-light" type="text">
				</div>
				</br>
				<button class="btn btn-success">Guardar datos</button>
				<a class="btn btn-primary" href="{{route("crud_schools.index")}}">Volver atrás</a>
			</form>
		</div>
	</div>
@endsection
