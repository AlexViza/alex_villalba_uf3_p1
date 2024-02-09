@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h1 class="mb-0">{{$title}}</h1>
                </div>

                <div class="card-body">
                    <h1 class="mb-4">{{$totalactors}}</h1>

                    {{-- Aquí puedes agregar más contenido según sea necesario --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection