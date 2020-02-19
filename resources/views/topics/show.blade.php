@extends('layouts.app')

@section('content')
    <div class="container">
       <div class="card">
           <div class="card-body">
               <h5 class="card-title">{{ $topic->title }}</h5>
               <p>{{ $topic->content }}</p>

                   <div class="d-flex justify-content-between align-items-center">
                       <small>Posté le {{$topic->created_at->format('d/m/Y à H:m')}}</small>
                       <span class="badge badge-primary">{{ $topic->user->name }}</span>
                   </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        @can('delete-users')
                       <a href="{{ route('topics.edit',$topic) }}" class="btn btn-primary">Editer ce topic</a>
                        @endcan
                        <form action="{{ route('topics.destroy', $topic) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @can('delete-users')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                @endcan
                        </form>

                            <form >
                                @csrf

                                @can('edit-users')
                                    <button type="submit" class="btn btn-warning">Signaler le Topic</button>
                                @endcan
                            </form>

                    </div>

           </div>

       </div>
        <hr>
        <h5>Commentaires</h5>
        @forelse($topic->comments as $comment)
            <div class="card mt-3">
                <div class="card-body " >
                    {{ $comment->content }}
                    <div class="d-flex justify-content-between align-items-center">
                        <small>Posté le {{$comment->created_at->format('d/m/Y à H:m')}}</small>
                        <span class="badge badge-primary">{{ $comment->user->name }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div>Aucun commentaire</div>
        @endforelse
        <form action="{{ route('comments.store' , $topic) }}" method="POST" class="mt-3">
            @csrf
            <div class="form-group">
                <label for="content">Votre commentaire</label>
                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="5"></textarea>
                @error('content')
                <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Commenter</button>
        </form>

    </div>
@endsection
