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

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Inserisci la tua email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

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