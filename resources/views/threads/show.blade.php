@extends('layouts.app')

@push('styles')
<link href="{{ asset('css/vendor/jquery.atwho.css') }}" rel="stylesheet">
@endpush

@section('content')
<thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex bd-highlight">
                            <img src="{{ $thread->creator->avatar_path }}" alt="{{ $thread->creator->name }}" height="25" width="25">

                            <div class="bd-highlight">
                                <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> posted: 
                                    {{ $thread->title }}
                            </div>

                            @can ('update', $thread)
                                <div class="ml-auto bd-highlight">
                                    <form method="POST" action="{{ $thread->path() }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                        
                                        <button type="submit" class="btn btn-danger">
                                            Delete Thread
                                        </button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>

                <replies @added="repliesCount++" @removed="repliesCount--"></replies>

                {{--{{ $replies->links() }}--}}

                
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>This thread was published {{ $thread->created_at->diffForHumans() }} by
                        <a href="#">{{ $thread->creator->name }}</a>, and currently 
                        has <span v-text="repliesCount"></span> {{ str_plural('comment', $thread->replies_count) }}.</p>

                        <p>
                            <subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}"></subscribe-button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</thread-view>
@endsection
