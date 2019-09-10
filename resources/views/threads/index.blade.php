@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @forelse ($threads as $thread)
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="d-flex bd-highlight">
                            <h4 class="bd-highlight">
                                <a href="{{ $thread->path() }}">
                                    @if ($thread->hasUpdatesFor(auth()->user()))
                                        <strong>
                                            {{ $thread->title }}
                                        </strong>
                                    @else
                                        {{ $thread->title }}
                                    @endif
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
            @empty
                <p>There are no relevant results at this time.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
