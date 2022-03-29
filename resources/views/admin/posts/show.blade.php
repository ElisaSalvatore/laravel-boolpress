@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
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
                    {{-- post image --}}
                    @if ($post->coverImg)
                        <img src="{{ asset("storage/" . $post->coverImg ) }}" alt="" class="img-fluid mb-3">
                    @else
                        <img src="https://blumagnolia.ch/wp-content/uploads/2021/05/placeholder-126.png" alt="" class="img-fluid mb-3" style="width:1024px; height:380px;">
                    @endif

                    {{-- {{ $post->content }} --}}
                    <p class="lead">
                        {!! $post->content !!}
                    </p>
          
                    <div class="my-3">
                        @php
                            // * Se utilizzo il metodo inline o la data pura di Php, 
                            // NON mi serve importare la libreria Carbon da Php
                            use Carbon\Carbon;

                            // Creo una variabile per il formato data 
                            $dateFormat = "d-m-Y H:i";
                        @endphp

                        Data creazione: {{ $post->created_at->format($dateFormat) }}
                        <br>
                        Data ultima modifica: {{ $post->updated_at->format($dateFormat) }} ( {{ $post->updated_at->diffForHumans(Carbon::now()) }} )
                        {{-- metodo inline * : {{ $post->updated_at->diffForHumans(Carbon\Carbon::now()) }} --}}
                        {{-- data pura da PHP * : {{ $post->updated_at->diffForHumans(date(0)) }} --}}
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
                            Categoria: <span class="text-success">{{ $post->category->code }}</span>
                            <br>
                            Descrizione: {{ $post->category->description}}
                        @endif
                        
                        {{-- Essendo nullable, se esiste stampa il blocco categoria sennò non stampare niente --}}
                        @if ($post->category !== null)
                            <div class="my-3">
                                Tags:
                                @foreach ($post->tags as $tag)
                                <span class="bg-warning p-1 rounded">{{ $tag->name }}</span>
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