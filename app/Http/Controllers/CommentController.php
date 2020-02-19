<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Topic;
use Illuminate\Http\Request;
use test\Mockery\ReturnTypeObjectTypeHint;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Topic $topic)
    {
        request()->validate([
           'content' => 'required|min:2'
        ]);

        $comment = new Comment();
        $comment->content = request('content');
        $comment->user_id = auth()->user()->id;

        $topic->comments()->save($comment);



      /*  $data = $request->validate([

            'content' => 'required|min:10',

        ]);

        $comment = auth()->user()->topics()->comments()->create($data);
        $comment->categories()->attach($data['category_id']);

        return redirect()->route('posts.show', $post->id);*/

        return redirect()->route('topics.show', $topic);
    }
}
