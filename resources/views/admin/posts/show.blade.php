@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{-- Dettagli post {{ $post->title }} --}}
                    <div>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-link">
                            <i class="fa-solid fa-arrow-left"></i>
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
                        @php
                            use Carbon\Carbon;
                        @endphp

                        Data creazione: {{ $post->created_at->format("d-m-Y H:i") }}
                        <br>
                        Data ultima modifica: {{ $post->updated_at->diffForHumans(Carbon::now()) }}
                        <br>
                        Slug: {{ $post->slug }}
                    </div>

                    <div class="my-3">
                        Creato da: {{ $post->user->name }}
                        <br>
                        Email utente: {{ $post->user->email }}
                    </div>

                    <div class="my-3">
                        {{-- Essendo nullable, se esiste stampa il blocco categoria sennò non stampare niente --}}
                        @if (isset($post->category))
                            Categoria: {{ $post->category->code }}
                            <br>
                            Descrizione: {{ $post->category->description}}
                        @endif
                        
                        {{-- Essendo nullable, se esiste stampa il blocco categoria sennò non stampare niente --}}
                        @if ($post->category !== null)
                            <div class="my-3">
                                Tags:
                                @foreach ($post->tags as $tag)
                                <span class="bg-light">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection