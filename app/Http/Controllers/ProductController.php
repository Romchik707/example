<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
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
        //dd($frd);
        //$productCategory = ProductCategory::create($frd);
        $product = new Product($frd);
        $product->save();
        return redirect()->route('products.index');
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
