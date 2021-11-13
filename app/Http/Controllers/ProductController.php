<?php

namespace App\Http\Controllers;

use App\Models\Image;
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

        $request->validate([
            'name'        => 'required',
            'description' => 'required',
            'price'       => 'required',
            'category_id' => 'required',
        ]);
        $frd = $request->all();
//        dd($frd);
//        if ($request->hasFile('image')) {
            //  Let's do everything here
        if ($request->hasFile('image')) {
            //  Let's do everything here
            $za = 1;
            if ($request->file('image')->isValid()) {
                //
                $validated = $request->validate([
                    'new_image_name' => 'string|max:40',
                    'image' => 'mimes:jpeg,png|max:1014',
                ]);
//                dd('1');
                $extension = $request->image->extension();
                $request->image->storeAs('/public', $validated['new_image_name'].".".$extension);
                $url = Storage::url($validated['new_image_name'].".".$extension);
                //dd($url);
                $file = Image::create([
                    'picture' => $url,
                ]);
//                dd($url);
                Session::flash('success', "Success!");
                $arrayProduct = [
                    'name'        => $frd['name'] ?? '',
                    'description' => Arr::get($frd, 'description'),
                    'price'       => Arr::get($frd, 'price'),
                    'category_id' => Arr::get($frd, 'category_id'),
                    'image_id'    => (string)$file->getKey(),
                ];
                $product = new Product($arrayProduct);
                $product->save();
            }
        }
        else {
            $arrayProduct = [
                'name'        => $frd['name'] ?? '',
                'description' => Arr::get($frd, 'description'),
                'price'       => Arr::get($frd, 'price'),
                'category_id' => Arr::get($frd, 'category_id'),
                'image_id'    => null,
            ];
            $product = new Product($arrayProduct);
            $product->save();
        }

        return redirect()->route('images.index');
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
    public function show(Request $request, Product $product, Image $image)
    {
        $imagePicture = '';
        $image = Image::whereIn('id', [$product->getImageId()])->get();
//        dd($image->first());
        if ($image->first() !== null)
        {
            $imagePicture = $image->first()->getPicture();
        }
        return view('products.show', compact('product', 'imagePicture'));
        //
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, Product $product)
    {
        $productCategories = ProductCategory::get();

        return view('products.edit', compact('product', 'productCategories'));
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
        return redirect()->back();
        //
    }
}
