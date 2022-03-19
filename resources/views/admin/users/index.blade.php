@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            Lista degli utenti
          </div>

          <table class="table">
            <thead>
              <tr>
                <th class="col-4">Nome</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                    <div class="d-flex justify-content-end">
                      <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-link" title="Mostra" >
                        <i class="fa-solid fa-eye"></i>
                      </a>
                      <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-secondary-dark" title="Modifica">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection