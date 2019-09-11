@extends('principal_errors')
@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Detalles del error</h4>
                    <p>{{ $exception->getMessage() }}</p>
                    <hr>
                    <p class="mb-0">Por favor consultar con el administrador del sistema</p>
                </div>
            </div>
        </div>
@endsection