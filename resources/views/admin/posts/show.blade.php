@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{-- Dettagli post {{ $post->title }} --}}
                    <div>
                        <a href="{{ route('admin.posts.index') }}" class="mr-2">
                            < 
                        </a>
    
                        {{ $post->title }}
                    </div>
                    
                    <div>
                        <a href="{{ route('admin.posts.edit', $post->slug) }}">Modifica</a>
                    </div>
                </div>

                <div class="card-body">
                    {{-- {{ $post->content }} --}}
                    <p class="lead">
                        {!! $post->content !!}
                    </p>
          
                    <div class="my-3">
                        Data creazione: {{ $post->created_at }}
                        <br>
                        Data ultima modifica: {{ $post->updated_at }}
                        <br>
                        Slug: {{ $post->slug }}
                    </div>

                    <div>
                        Creato da: {{ $post->user->name }}
                        <br>
                        Email utente: {{ $post->user->email }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection