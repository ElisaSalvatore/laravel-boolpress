@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header d-flex">
            Lista contatti ricevuti
          </div>

          <table class="table">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Email</th>
                <td>Messaggio</td>
                <td>Allegato</td>
                <td>Data</td>
              </tr>
            </thead>
            <tbody>
              @foreach ($contacts as $contact)
                <tr class="">
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->message }}</td>
                    <td>
                        @if ($contact->attachment)
                            <a href="{{ asset("storage/" . $contact->attachment) }}" target="_blank"> Apri </a>
                        @endif
                    </td>
                    <td>{{ $contact->created_at->format("d/m/Y H:i ") }}</td>
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