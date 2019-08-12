@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h1>
                            {{ $profileUser->name }}
                            <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
                        </h1>
                    </div>
            
                    <div class="card-body">
                        @foreach ($threads as $thread)
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex bd-highlight">
                                        <div class="bd-highlight">
                                            <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> posted: {{ $thread->title }}
                                        </div>
                                        <div class="ml-auto bd-highlight">
                                            {{ $thread->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{ $thread->body }}
                                </div>
                            </div>
                        @endforeach

                        {{ $threads->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection