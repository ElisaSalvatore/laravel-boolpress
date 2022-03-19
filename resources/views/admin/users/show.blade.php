@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-link">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                        
                        {{ $user->name }}
                    </div>
                    
                    <div>
                        <a href="{{ route('admin.users.edit', $user->id) }}">Modifica</a>
                    </div>
                </div>

                <div class="card-body">
                    <p class="lead">
                        Dettagli dell'utente
                        <br>
                        Email: {!! $user->email !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection