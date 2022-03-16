@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    Lista dei post

                    {{-- Bottone per la creazione di un nuovo post --}}
                    <a class="ml-4" href="{{ route("admin.posts.create") }}">Crea post</a>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ( $posts as $post)
                            {{-- <li class="list-group-item">{{$post->title}}
                                {{-- Per leggere i dati in pagina di uno slug 
                                <a class="ml-4"href="{{ route('admin.posts.show', $post->slug) }}">Mostra</a>
                            </li> --}}

                            <li class="list-group-item d-flex align-items-center">
                                <div>
                                  {{ $post->title }}
                                  <br>
                                  <small class="fst-italic">{{ $post->created_at }}</small>
                                </div>
              
                                <a class="ms-auto" href="{{ route('admin.posts.show', $post->slug) }}">Mostra</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection