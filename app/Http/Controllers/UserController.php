<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use function React\Promise\all;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        //просмотр всех записей
        $users = User::get();

        return view('users.index', compact('users'));
    }

    /**
     * @param Request $request
     */
    public function create(Request $request)
    {
        return view('users.create');
        //страница с полями ввода для создания
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
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
    public function closeshow()
    {
        return redirect()->route('users.index');
        //просмотр определенной записи
    }

    /**
     * @param Request $request
     * @param User $user
     */
    public function edit(Request $request, User $user)
    {
        return view('users.edit', compact('user'));
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
        //dd($frd);
        $user->update([
            'name'=>$frd['name'] ?? '',
            'email'=>Arr::get($frd, 'email'),
            'password'=>Arr::get($frd, 'password'),
        ]);
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
