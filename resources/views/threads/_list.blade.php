@forelse ($threads as $thread)
    <div class="card mb-3">
        <div class="card-header">
            <div class="d-flex bd-highlight">
                <div>
                    <h4 class="bd-highlight">
                        <a href="{{ $thread->path() }}">
                            @if (auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                                <strong>
                                    {{ $thread->title }}
                                </strong>
                            @else
                                {{ $thread->title }}
                            @endif
                        </a>
                    </h4>

                    <h5>Posted By: <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a></h5>
                </div>

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