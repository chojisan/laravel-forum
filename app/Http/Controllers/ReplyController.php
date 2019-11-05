<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Reply;
use Exception;

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

    public function store($channelId, Thread $thread)
    {
        try {
            request()->validate([
                'body' => 'required|spamfree'
            ]);

            $reply = $thread->addReply([
                'body' => request('body'),
                'user_id' => auth()->id()
            ]);
        } catch (Exception $e) {
            return response(
                'Sorry, your reply could not be saved at this time.',
                422
            );
        }

        return $reply->load('owner');

        /*
        $this->validate(request(), [
            'body' => 'required'
        ]);

        $spam->detect(request('body'));

        $reply = $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        if (request()->expectsJson()) {
            return $reply->load('owner');
        }

        return back()->with('flash', 'Your reply has been left.');
        */
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
