@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($threads as $thread)
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="d-flex bd-highlight">
                            <h4 class="bd-highlight">
                                <a href="{{ $thread->path() }}">
                                    {{ $thread->title }}
                                </a>
                            </h4>

                            <a href="{{ $thread->path() }}" class="ml-auto bd-highlight">
                                {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="body">{{ $thread->body }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
