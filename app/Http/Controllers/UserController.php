<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use function React\Promise\all;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        //просмотр всех записей
        $users = User::filter($frd)->get();

        return view('users.index', compact('users', 'frd'));
    }

    /**
     * @param Request $request
     */
    public function create(Request $request)
    {
        $roles = Role::get();
        return view('users.create', compact('roles'));
        //страница с полями ввода для создания
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'password' => 'required',
            'email'    => 'required|unique:users',
        ]);
        $frd = $request->all();
        //dd($frd);
        $frd['password'] = \Hash::make(Arr::get($frd, 'password'));
        //$user = User::create($frd);
        $user = new User($frd);
        $user->save();
        return redirect()->route('users.index');
        //запись в базу данных при создании
    }

    /**
     * @param Request $request
     * @param User $user
     */
    public function show(Request $request, User $user)
    {
        $frd = $request->all();
        //dd($frd);
        return view('users.show', compact('user'));
        //просмотр определенной записи
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, User $user)
    {
        $array[] = '';
        $roles = Role::get();
        foreach ($roles as $role) {
            if ($user->hasRole($role->getName()) === false) {
                array_push($array, (string)$role->getKey());
            }
        }
//        dd($array);
        $choosedRoles = Role::whereNotIn('id', $array)->get();
//        dd($choosedRoles);
        return view('users.edit', compact('user', 'roles', 'choosedRoles'));
        //страница редактирования пользователя
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $frd = $request->all();
//        dd($frd);
        $user->update([
            'name'     => $frd['name'] ?? '',
            'email'    => Arr::get($frd, 'email'),
            'password' => Arr::get($frd, 'password'),
        ]);
//        $roleIds = $frd['chroles'];
//        dd($roleIds);
//        foreach ($frd['list'] as $item)
//            dd($item);
            $user->attachRole($frd['list']);
//        /**
//         * @var Role $role
//         */
//        $role = Role::find($roleId);
//        $user->attachRole($roleId);
//        $user->detachRole('test');
        return redirect()->route('users.index');
        //обновление пользователя
    }

    /**
     * @param Request $request
     * @param User $user
     */
    public function destroy(Request $request, User $user)
    {
        $frd = $request->all();
        //dd($frd);
        $user->delete();
        return redirect()->back();
        //удаление пользователя
    }
}
