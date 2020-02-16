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
                        @can('edit-users')
                       <a href="{{ route('topics.edit',$topic) }}" class="btn btn-primary">Editer ce topic</a>
                        @endcan
                        <form action="{{ route('topics.destroy', $topic) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @can('edit-users')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                @endcan
                        </form>

                    </div>

           </div>

       </div>

    </div>
@endsection
