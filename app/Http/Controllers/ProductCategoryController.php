<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProductCategoryController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        //
        $productCategories = ProductCategory::get();

        return view('product-categories.index', compact('productCategories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $productCategories = ProductCategory::get();
        return view('product-categories.create', compact('productCategories'));
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $frd = $request->all();
        //dd($frd);
        //$productCategory = ProductCategory::create($frd);
        $productCategory = new ProductCategory($frd);
        $productCategory->save();
        return redirect()->route('product-categories.index');
        //запись в базу данных при создании
    }

    /**
     * @param Request $request
     * @param ProductCategory $productCategory
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request, ProductCategory $productCategory)
    {
        return view('product-categories.show', compact('productCategory'));
        //
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */

    /**
     * @param Request $request
     * @param ProductCategory $productCategory
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, ProductCategory $productCategory)
    {
        $productCategories = ProductCategory::get();
        return view('product-categories.edit', compact('productCategory', 'productCategories'));
        //
    }

    /**
     * @param Request $request
     * @param ProductCategory $productCategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $frd = $request->all();
        //dd($frd);
        $productCategory->update([
            'name'               => $frd['name'] ?? '',
            'slug'               => Arr::get($frd, 'slug'),
            'parent_category_id' => Arr::get($frd, 'parent_category_id'),
        ]);
        return redirect()->route('product-categories.index');
        //обновление пользователя
    }

    /**
     * @param Request $request
     * @param ProductCategory $productCategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, ProductCategory $productCategory)
    {
        $frd = $request->all();
        //dd($frd);
        $productCategory->delete();
        return redirect()->back();
        //
    }
}
