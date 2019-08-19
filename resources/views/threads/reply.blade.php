<reply :attributes="{{ $reply }}" inline-template v-cloak>
    <div id="reply-{{ $reply->id }}" class="card my-3">
        <div class="card-header">
            <div class="d-flex bd-highlight">
                <div class="bd-highlight">
                    <a href="{{ route('profile', $reply->owner) }}">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}...
                </div>
                
                <div class="ml-auto bd-highlight">
                    <favorite :reply="{{ $reply }}"></favorite>
                </div>
            </div>
        </div>
            
        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>

                <button class="btn btn-primary btn-sm" @click="update">Update</button>
                <button class="btn btn-danger btn-sm" @click="editing = false">Cancel</button>
            </div>

            <div v-else v-text="body"></div>
            
        </div>

        @can('update', $reply)
            <div class="card-footer d-flex">
                <button class="btn btn-warning btn-sm mr-1" @click="editing = true">Edit</button>
                <button class="btn btn-danger btn-sm mr-1" @click="destroy">Delete</button>
            </div>
        @endcan
    </div>
</reply>