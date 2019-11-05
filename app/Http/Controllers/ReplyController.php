<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Reply;
use Exception;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CreatePostRequest;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index($channelId, Thread $thread)
    {
        return $thread->replies()->paginate(20);
    }

    public function store($channelId, Thread $thread, CreatePostRequest $form)
    {
        return $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ])->load('owner');

        //return $form->persist($thread);
    }

    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);

        try {
            request()->validate([
                'body' => 'required|spamfree'
            ]);

            $reply->update(request(['body']));
        } catch (Exception $e) {
            return response(
                'Sorry, your reply could not be saved at this time.',
                422
            );
        }

        /*
        $this->validate(request(), [
            'body' => 'required'
        ]);

        $spam->detect(request('body'));

        $reply->update(request(['body']));
        */
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);
        
        $reply->delete();

        if (request()->expectsJson()) {
            return response(['status' => 'Reply deleted']);
        }

        return back();
    }
}
