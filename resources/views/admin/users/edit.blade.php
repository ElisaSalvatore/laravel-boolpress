@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Modifica dettagli utente
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                    @csrf
                    @method("patch")

                    {{-- Nome utente --}}
                    <div class="mb-3">
                        <label>Nome utente</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Inserisci il tuo nome" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Inserisci la tua email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Telefono --}}
                    <div class="mb-3">
                        <label>Numero di telefono:</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                        placeholder="Inserisci il tuo numero di telefono" value="{{ old('phone', $user->infoUser->phone ?? null) }}">
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Indirizzo --}}
                    <div class="mb-3">
                        <label>Indirizzo:</label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                        placeholder="Inserisci il tuo indirizzo" value="{{ old('address', $user->infoUser->address ?? null) }}">
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Immagine profilo --}}
                    <div class="mb-3">
                        <label>Immagine del profilo:</label>
                        <input type="text" name="avatar" class="form-control @error('avatar') is-invalid @enderror"
                        placeholder="Inserisci la tua immagine profilo" value="{{ old('avatar', $user->infoUser->avatar ?? null) }}">
                        @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Bottoni --}}
                    <div class="form-group">
                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-secondary">Annulla</a>
                        <button type="submit" class="btn btn-success">Salva post</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection