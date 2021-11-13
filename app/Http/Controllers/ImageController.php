<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        //просмотр всех записей
        $images = Image::filter($frd)->get();
        return view('images.index', compact('images', 'frd'));
        //
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
//    public function viewUploads () {
//        $images = Image::all();
//        return view('view_uploads')->with('images', $images);
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('images.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
//        $frd = $request->all();
//        dd($frd);
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
                Session::flash('success', "Success!");
                return redirect()->route('images.index');
            }
        }
//        dd($za);
//        abort(500, 'Could not upload image :(');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Image $image)
    {
        $frd = $request->all();
        //dd($frd);
        return view('images.show', compact('image'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            //  Let's do everything here
            $za = 1;
            if ($request->file('image')->isValid()) {
                //
                $validated = $request->validate([
                    'name'  => 'string|max:40',
                    'image' => 'mimes:jpeg,png|max:1014',
                ]);
//                dd('1');
                $extension = $request->image->extension();
                $request->image->storeAs('/public', $validated['name'] . "." . $extension);
                $url = Storage::url($validated['name'] . "." . $extension);
                //dd($url);
                $file = Image::up([
                    'picture' => $url,
                ]);
                Session::flash('success', "Success!");
                return redirect()->route('images.index');
                //
            }
        }
    }

    /**
     * @param Request $request
     * @param Image $image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, Image $image)
    {
        $frd = $request->all();
//        dd($frd);
        $image->delete();
        return redirect()->back();
        //
    }
}
