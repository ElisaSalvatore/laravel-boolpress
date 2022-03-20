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
                        Dettagli utente
                    </div>
                    
                    <div>
                        <a href="{{ route('admin.users.edit', $user->id) }}">Modifica profilo</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        {{-- Immagine del profilo --}}
                        <div class="col-3 text-center">
                            <img
                              src="{{ $user->infoUser->avatar ?? 'https://www.pngfind.com/pngs/m/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.png' }}"
                              class="rounded-circle w-75"
                            >
                        </div>

                        <div class="col">
                            <h4><strong>{{ $user->name }}</strong> </h3>
                            <h5>{{ $user->email }}</h4>

                            @if ($user->infoUser)
                                <div>{{ $user->infoUser->address }}</div>
                                <div>{{ $user->infoUser->phone }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection