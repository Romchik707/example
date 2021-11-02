<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RoleController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        //просмотр всех записей
        $roles = Role::filter($frd)->get();

        return view('roles.index', compact('roles', 'frd'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'display_name' => 'required',
        ]);
        $frd = $request->all();
        //dd($frd);
        $role = new Role($frd);
        $role->save();
        return redirect()->route('roles.index');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Role $role)
    {
        $frd = $request->all();
        //dd($frd);
        return view('roles.show', compact('role'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Role $role)
    {
        return view('roles.edit', compact('role'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $frd = $request->all();
        //dd($frd);
        $role->update([
            'name'=>$frd['name'] ?? '',
            'display_name'=>Arr::get($frd, 'display_name'),
            'description'=>Arr::get($frd, 'description'),
        ]);
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $role)
    {
        $frd = $request->all();
        //dd($frd);
        $role->delete();
        return redirect()->back();
        //
    }
}
