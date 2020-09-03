<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('admin')->except(['index', 'show']);
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
        //abort_unless(Gate::allows('create'), 403);

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
            'description' => 'required|min:25|max:500',
            'image' => 'mimes:jpeg,jpg,bmp,png,gif'
        ]);

        $article = new Article([
            'title' => $request['title'],
            'description' => $request['description'],
            'user_id' => auth()->id()
        ]);
        $article->save();

        if ($request->image) {
            $this->saveImages($request->image, $article->id);
        }

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
        abort_unless(Gate::allows('update', $article), '403');

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
        abort_unless(Gate::allows('update', $article), '403');

        $request->validate([
            'title' => 'required|min:5|max:20',
            'description' => 'required|min:25|max:500',
            'image' => 'mimes:jpeg,jpg,bmp,png,gif'
        ]);

        if ($request->image) {
            $this->saveImages($request->image, $article->id);
        }

        $article->update([
            'title' => $request['title'],
            'description' => $request['description'],
        ]);

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
        abort_unless(Gate::allows('delete', $article), '403');

        $toDelete = $article->title;
        $article->delete();

        return redirect('/article');
    }

    public function saveImages($image, $article_id)
    {
        $image = Image::make($image);
        if ($image->width() > $image->height()) {
            $image
                ->widen('1200')
                ->save(public_path() . '/img/articles/' . $article_id . "_large.jpg")
                ->widen('400')->pixelate(10)
                ->save(public_path() . '/img/articles/' . $article_id . "_pixelated.jpg");
            $image = Image::make($image);
            $image
                ->widen('60')
                ->save(public_path() . '/img/articles/' . $article_id . "_thumb.jpg");
        } else {
            $image
                ->heighten('900')
                ->save(public_path() . '/img/articles/' . $article_id . "_large.jpg")
                ->heighten('400')->pixelate(10)
                ->save(public_path() . '/img/articles/' . $article_id . "_pixelated.jpg");
            $image = Image::make($image);
            $image
                ->heighten('60')
                ->save(public_path() . '/img/articles/' . $article_id . "_thumb.jpg");
        }
    }
}
