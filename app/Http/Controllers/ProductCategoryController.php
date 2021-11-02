<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        //
        $productCategories = ProductCategory::filter($frd)->get();

        return view('product-categories.index', compact('productCategories', 'frd'));
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
        ]);
        $frd = $request->all();
        //dd($frd);
        //$productCategory = ProductCategory::create($frd);
        $productCategory = new ProductCategory($frd);
        $productCategory->save([
            'name'               => $frd['name'],
            'slug'               => Str::slug(Arr::get($frd, 'name')),
            'parent_category_id' => Arr::get($frd, 'parent_category_id'),
        ]);
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
            'slug'               => Str::slug(Arr::get($frd, 'name')),
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
