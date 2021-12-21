<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\TraitImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        //dd($frd);
        $products = Product::filter($frd)->get();

        return view('products.index', compact('products', 'frd'));
        //
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $productCategories = ProductCategory::get();

        return view('products.create', compact('productCategories'));
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $authUser = auth()->user()->getAuthIdentifier();
        $request->validate([
            'name'        => 'required',
            'price'       => 'required',
            'category_id' => 'required',
        ]);
        $frd = $request->all();
//        dd($frd);
        $fileBefore = TraitImage::create([
            'alt' => 'Кртинки нет',
            'url' => '1',
            'size' => '1',
            'imageable_id' => '0',
            'imageable_type' => 'product',
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
                $newProduct = Product::create([
                    'name'               => $frd['name'] ?? '',
                    'product-trixFields' => request('product-trixFields'),
                    'attachment-product-trixFields' => request('attachment-product-trixFields'),
                    'description'        => Arr::get($frd, 'name'),
                    'price'              => Arr::get($frd, 'price'),
                    'category_id'        => Arr::get($frd, 'category_id'),
                    'image_id'           => (string)$fileBefore->getKey(),
                ]);
//                dd();
                TraitImage::where('id', (string)$fileBefore->getKey())
                    ->update(['imageable_id' => $newProduct->getKey(),]);
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
            Product::create([
                'name'               => $frd['name'] ?? '',
                'product-trixFields' => request('product-trixFields'),
                'attachment-product-trixFields' => request('attachment-product-trixFields'),
                'description'        => Arr::get($frd, 'name'),
                'price'              => Arr::get($frd, 'price'),
                'category_id'        => Arr::get($frd, 'category_id'),
                'image_id'           => null,
            ]);
//            $product = new Product($arrayProduct);
//            $product->save();
        }
        return redirect()->route('products.index');
//        dd($za);
//        abort(500, 'Could not upload image :(');
        //
        //$productCategory = ProductCategory::create($frd);
        //        $frd = $request->all();
//        dd($frd);
//        return redirect()->route('products.index');
        //запись в базу данных при создании
        //
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request, Product $product)
    {
//        dd($product->getImagePicture());
        return view('products.show', compact('product'));
        //
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, Product $product)
    {
        $productCategoryName = '';
        $productCategories = ProductCategory::get();
        $productCategory = ProductCategory::whereIn('id', [$product->getCategoryId()])->get();
//        dd($productCategory->first()->getName());
        if ($productCategory->first() !== null) {
            $productCategoryName = $productCategory->first()->getName();
        }
        return view('products.edit', compact('product', 'productCategories', 'productCategoryName'));
        //
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        $frd = $request->all();
        //dd($frd);
        $product->update([
            'name'        => $frd['name'] ?? '',
            'description' => Arr::get($frd, 'description'),
            'price'       => Arr::get($frd, 'price'),
            'category_id' => Arr::get($frd, 'category_id'),
            'image_id'    => Arr::get($frd, 'image_id'),
        ]);
        return redirect()->route('products.index');
        //обновление пользователя
        //
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, Product $product)
    {
        $frd = $request->all();
        //dd($frd);
        $product->delete();
        $product->trixRichText->each->delete();
        return redirect()->back();
        //
    }
}
