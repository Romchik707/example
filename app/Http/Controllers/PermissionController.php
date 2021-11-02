<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PermissionController extends Controller
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
        $permissions = Permission::filter($frd)->get();
        return view('permissions.index', compact('permissions', 'frd'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('permissions.create');
        //
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
            'name'         => 'required',
            'display_name' => 'required',
        ]);
        $frd = $request->all();
        //dd($frd);
        $permission = new Permission($frd);
        $permission->save();
        return redirect()->route('permissions.index');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Permission $permission)
    {
        $frd = $request->all();
        //dd($frd);
        return view('permissions.show', compact('permission'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $frd = $request->all();
        //dd($frd);
        $permission->update([
            'name'         => $frd['name'] ?? '',
            'display_name' => Arr::get($frd, 'display_name'),
            'description'  => Arr::get($frd, 'description'),
        ]);
        return redirect()->route('permissions.index');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Permission $permission)
    {
        $frd = $request->all();
        //dd($frd);
        $permission->delete();
        return redirect()->back();
        //
    }
}
