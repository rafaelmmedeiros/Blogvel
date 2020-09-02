<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($article_id)
    {
        return view('comment.create')->with([
            'article_id' => $article_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $articleToReturn = $request['article_id'];

        $request->validate([
            'commentary' => 'required|min:5|max:128'
        ]);

        $comment = new Comment([
            'commentary' => $request['commentary'],
            'article_id' => $request['article_id'],
            'user_id' => auth()->id()
        ]);
        $comment->save();

        return redirect()->to('article/' . $articleToReturn);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        abort_unless(Gate::allows('update', $comment), '403');

        return view('comment.edit')->with([
            'comment' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        abort_unless(Gate::allows('update', $comment), '403');

        $articleToReturn = $comment->article_id;

        $request->validate([
            'commentary' => 'required|min:5|max:128'
        ]);

        $comment->update([
            'commentary' => $request['commentary']
        ]);

        return redirect()->to('article/' . $articleToReturn);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        abort_unless(Gate::allows('delete', $comment), '403');

        $articleToReturn = $comment->article_id;
        $comment->delete();

//        return $this->index()->with([
//            'message_success' => 'Article <b>' . $toDelete . ' </b>deleted with success'
//        ]);
        return redirect()->to('article/' . $articleToReturn);
    }
}
