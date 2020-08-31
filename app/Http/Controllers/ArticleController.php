<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$articles = Article::all();
        //$articles = Article::paginate(10);
        $articles = Article::orderBy('created_at', 'DESC')->paginate(10);


        return view('article.index')->with([
            'articles' => $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:20',
            'description' => 'required|min:25|max:500'
        ]);

        $article = new Article([
            'title' => $request['title'],
            'description' => $request['description'],
            'user_id' => auth()->id()
        ]);
        $article->save();

//        return $this->index()->with([
//            'message_success' => 'Article <b>' . $article->title . ' </b>created with success'
//        ]);
        return redirect('/article');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('article.show')->with([
            'article' => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //dd($article);
        //Route Model Bind RMB
        return view('article.edit')->with([
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|min:5|max:20',
            'description' => 'required|min:25|max:500'
        ]);

        $article->update([
            'title' => $request['title'],
            'description' => $request['description'],
        ]);

//        return $this->index()->with([
//            'message_success' => 'Article <b>' . $article->title . ' </b>updated with success'
//        ]);
        return redirect('/article');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $toDelete = $article->title;
        $article->delete();

//        return $this->index()->with([
//            'message_success' => 'Article <b>' . $toDelete . ' </b>deleted with success'
//        ]);
        return redirect('/article');
    }
}
