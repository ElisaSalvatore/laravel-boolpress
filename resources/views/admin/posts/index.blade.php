@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
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

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                  {{ $post->title }}
                                                                                                                {{-- nello stampare la categoria facciamo un IF, perchè potrebbe non averla --}}
                                  <small class="fst-italic">{{ $post->created_at }} - {{ $post->user->name }} - {{ isset($post->category) ? $post->category->code : "senza categoria" }} </small>
                                                                                                                {{-- se c'è un actegoria selezionata stampa il code, altrimenti stampa "senza categoria"--}}
                                </div>
                                
                                <div class="ms-auto">
                                    <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-link" title="Mostra" >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.posts.edit', $post->slug) }}" class="btn btn-secondary-dark" title="Modifica">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    @include('partials.deleteBtn', [
                                        'id' => $post->id,
                                        'route' => 'admin.posts.destroy',
                                    ])
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection