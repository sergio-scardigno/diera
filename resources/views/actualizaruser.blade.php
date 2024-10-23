@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>Resultado de la actualización de usuarios</span>
                    
                    <button type="button" class="close" aria-label="Close" onclick="window.location.href='{{ route('home') }}'">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="card-body">
                    {!! $info !!}
                </div>
            </div>
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fa fa-arrow-left"></i> Volver
                    </a>
        </div>
    </div>
</div>
@endsection
