@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header d-flex">
            Aggiunta di un nuovo post
          </div>

          <div class="card-body">

            <form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              @method("patch")

              {{-- titolo --}}
              <div class="mb-3">
                <label>Titolo</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                  placeholder="Inserisci il titolo" value="{{ old('title', $post->title) }}" required>
                @error('title')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              {{-- cover immagine --}}
              <div class="mb-3">
                <label>Immagine di copertina del post:</label>
                <input type="file" name="coverImg" class="form-control @error('coverImg') is-invalid @enderror"
                  placeholder="Inserisci un'immagine"
                >
                <span>{{ $post->coverImg }}</span>
                @error('coverImg')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              {{-- contenuto del post --}}
              <div class="mb-3">
                <label>Contenuto</label>
                <textarea name="content" rows="10" class="form-control @error('content') is-invalid @enderror"
                  placeholder="Inizia a scrivere qualcosa..." required>{{ old('content', $post->content) }}
                </textarea>
                @error('content')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              {{-- Creo la select per le categorie --}}
              <div class="mb-3">
                <label>Categoria:</label>
                <select name="category_id" class="form-select">
                  <option value=""> -- nessuna categoria -- </option>
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if ($post->category_id === $category->id) selected @endif>
                      {{ $category->code }}
                    </option>
                  @endforeach
                </select>
              </div>

              {{-- Creo il form checkbox per i tags --}}
              <div class="mb-3">
                <label >Tags: </label>
                @foreach ($tags as $tag)
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                  id="tag_{{ $tag->id }}" name="tags[]" 
                  {{-- Se i tags di questo post contengono il tag che sto ciclando in questo momento 
                    allora `checked`, altrimenti lascio vuoto. --}}
                  {{ $post->tags->contains($tag) ? 'checked' : '' }}
                  >
                  <label class="form-check-label">{{ $tag->name }}</label>
                </div>
                @endforeach

                @error('tags')
                  <div class="text">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-secondary">Annulla</a>
                <button type="submit" class="btn btn-success">Salva post</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection