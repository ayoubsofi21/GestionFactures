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
     * Display the public registration view.
     */
    public function create(): View
    {
        return view('auth.login', [
            'userTypes' => $this->getAllowedUserTypes()
        ]);
    }

    /**
     * Display the admin-only registration view.
     */
    public function showForm(): View
    {
        return view('register-admin', [
            'userTypes' => $this->getAllowedUserTypes()
        ]);
    }

    /**
     * Handle registration request (for both public and admin routes)
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate($this->validationRules());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
        ]);

        event(new Registered($user));

        // Only auto-login for public registration
        if ($request->is('register')) {
            Auth::login($user);
            return redirect(route('dashboard'));
        }

        // For admin-created users
        return redirect()
            ->route('dashboard')
            ->with('success', 'Utilisateur créé avec succès!');
    }

    /**
     * Get validation rules for registration
     */
    protected function validationRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_type' => ['required', 'in:Directeur,Administrateur,Employe,Financier']
        ];
    }

    /**
     * Get allowed user types with labels
     */
    protected function getAllowedUserTypes(): array
    {
        return [
            'Directeur' => 'Directeur',
            'Administrateur' => 'Administrateur',
            'Employe' => 'Employé',
            'Financier' => 'Financier'
        ];
    }
}