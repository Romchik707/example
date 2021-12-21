<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\TraitImage;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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
        $authUser = auth()->user()->getAuthIdentifier();
////        dd($authUser);
//        $request->validate([
//            'name'      => 'required',
//            'posted_at' => 'required',
//        ]);
//        $frd = $request->all();
////        dd($frd);
//        //$user = User::create($frd);
//        $arrayArticle = [
//            'name'                          => $frd['name'],
//            'slug'                          => Str::slug($frd['name']),
//            'is_super'                      => Arr::has($frd, 'is_super'),
//            'description'                   => $frd['name'],
//            'posted_at'                     => $frd['posted_at'],
//            'article-trixFields'            => request('article-trixFields'),
//            'attachment-article-trixFields' => request('attachment-article-trixFields'),
//        ];
//        $article = new Article($arrayArticle);
//        $article->save();
////        return redirect()->route('articles.index');
//        //запись в базу данных при создании
//        //
        ////////////////////////////////////////////////////////////////////////////////////////////////////
        $request->validate([
            'name'      => 'required',
            'posted_at' => 'required',
        ]);
        $frd = $request->all();
//        dd($frd);
        $fileBefore = TraitImage::create([
            'alt' => 'Картинки нет',
            'url' => '1',
            'size' => '1',
            'imageable_id' => '0',
            'imageable_type' => 'article',
            'user_id' => $authUser,
        ]);
//        dd($fileBefore);
//        dd(array_first(Arr::get($frd, 'product-trixFields')));
//        if ($request->hasFile('image')) {
        //  Let's do everything here
        if ($request->hasFile('image')) {
            //  Let's do everything here
            $za = 1;
            if ($request->file('image')->isValid()) {
                //
                $validated = $request->validate([
                    'new_image_name' => 'string|max:40',
                    'image'          => 'mimes:jpeg,png|max:1014',
                ]);
//                dd('1');
                $extension = $request->image->extension();
                $request->image->storeAs('/public', (string)$fileBefore->getKey().'-'.$validated['new_image_name'] . "." . $extension);
                $url = Storage::url((string)$fileBefore->getKey().'-'.$validated['new_image_name'] . "." . $extension);
//                dd($url);
//                Image::where('id', (string)$fileBefore->getKey())->update(['picture'=>$url]);
                TraitImage::where('id', (string)$fileBefore->getKey())
                    ->update(['title' => (string)$validated['new_image_name'], 'url' => $url,
                              'description' => (string)$url, 'size' => (integer)$frd['image']->getSize()]);
//                $file = $fileBefore::update([
//                    'picture' => $url,
//                ]);
//                dd($url);
                Session::flash('success', "Success!");
//                dd(request()->all());
//                Product::create(request()->all());
//                dd();
                $newArticle = Article::create([
                    'name'                          => $frd['name'],
                    'slug'                          => Str::slug($frd['name']),
                    'is_super'                      => Arr::has($frd, 'is_super'),
                    'description'                   => $frd['name'],
                    'posted_at'                     => $frd['posted_at'],
                    'article-trixFields'            => request('article-trixFields'),
                    'attachment-article-trixFields' => request('attachment-article-trixFields'),
                ]);
//                dd($newArticle);
                TraitImage::where('id', (string)$fileBefore->getKey())
                    ->update(['imageable_id' => $newArticle->getKey(),]);
//                $arrayProduct = [
//                    'name'        => $frd['name'] ?? '',
//                    'product-trixFields' => request('product-trixFields'),
//                    'description' => Arr::get($frd, 'name'),
//                    'price'       => Arr::get($frd, 'price'),
//                    'category_id' => Arr::get($frd, 'category_id'),
//                    'image_id'    => (string)$file->getKey(),
//                ];
//                $product = new Product($arrayProduct);
//                $product->save();
            }
        } else {
//            dd(request()->all());
            Article::create([
                'name'                          => $frd['name'],
                'slug'                          => Str::slug($frd['name']),
                'is_super'                      => Arr::has($frd, 'is_super'),
                'description'                   => $frd['name'],
                'posted_at'                     => $frd['posted_at'],
                'article-trixFields'            => request('article-trixFields'),
                'attachment-article-trixFields' => request('attachment-article-trixFields'),
            ]);
//            $product = new Product($arrayProduct);
//            $product->save();
        }
        return redirect()->route('articles.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request, Article $article)
    {
        $images = TraitImage::get();
        $image = TraitImage::whereIn('imageable_id', [$article->getKey()])->get();
        if ($image->first() !== null) {
            $imageUrl = $image->first()->getUrl();
        }
        return view('articles.show', compact('article', 'imageUrl'));
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
