<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        //dd($frd);
        $articles = Article::filter($frd)->get();

        return view('articles.index', compact('articles', 'frd'));
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        return view('articles.create');
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'posted_at' => 'required',
        ]);
        $frd = $request->all();
//        dd($frd);
        //$user = User::create($frd);
        $arrayArticle = [
            'name'                          => $frd['name'],
            'slug'                          => Str::slug($frd['name']),
            'is_super'                      => Arr::has($frd, 'is_super'),
            'description'                   => $frd['name'],
            'posted_at'                     => $frd['posted_at'],
            'article-trixFields'            => request('article-trixFields'),
            'attachment-article-trixFields' => request('attachment-article-trixFields'),
        ];
        $article = new Article($arrayArticle);
        $article->save();
        return redirect()->route('articles.index');
        //запись в базу данных при создании
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request, Article $article)
    {
        return view('articles.show', compact('article'));
        //
    }

    /**
     * @param Request $request
     * @param Article $article
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, Article $article)
    {
        $checked = $article->isSuper();
        return view('articles.edit', compact('article', 'checked'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $frd = $request->all();
        //dd($frd);
        $article->update([
            'name'                          => $frd['name'],
            'slug'                          => Str::slug($frd['name']),
            'is_super'                      => Arr::has($frd, 'is_super'),
            'description'                   => $frd['name'],
            'posted_at'                     => $frd['posted_at'],
            'article-trixFields'            => request('article-trixFields'),
            'attachment-article-trixFields' => request('attachment-article-trixFields'),
        ]);
        return redirect()->route('articles.index');
        //обновление пользователя
        //
    }

    /**
     * @param Request $request
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, Article $article)
    {
        $frd = $request->all();
        //dd($frd);
        $article->delete();
        return redirect()->back();
        //удаление пользователя
        //
    }
}
