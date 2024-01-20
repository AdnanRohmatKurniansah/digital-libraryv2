<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'min:3', 'max:255'],
            'username' => 'required|min:3|max:255|unique:users',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'alamat' => 'required|min:5',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/dashboard/peminjam/peminjamanku')->with('success', 'Berhasil registrasi');
    }

    public function listUser() {
        return view('dashboard.user.index', [
            'users' => User::where('role', 'petugas')->orderBy('id', 'desc')->paginate(20)
        ]);
    }

    public function addNewUser() {
        return view('dashboard.user.create');
    }

    public function addNewUserStore(Request $request) {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'min:3', 'max:255'],
            'username' => 'required|min:3|max:255|unique:users',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'alamat' => 'required|min:5',
            'role' => 'required',
            'password' => 'required',
        ]);

        User::create($data);

        return redirect('/dashboard/user')->with('success', 'Berhasil menambahkan user baru');
    }
}
