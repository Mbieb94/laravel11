<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\UserRoles;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request['status'] = 1;
        $request->authenticate();

        $request->session()->regenerate();
        $this->generateToken();
        return redirect()->intended(route('dashboard', absolute: false))->with('success', 'Login Success ...');
    }

    public function generateToken()
    {
        $user = request()->user();
        $tokenResult = $user->createToken('Personal Access Token');
        
        $userRoles = UserRoles::with(['role_id', 'rolePrevileges'])->where('user_id', $user->id)->get()->toArray();
        $rolesList = [];
        $permissions = [];
        foreach ($userRoles as $key => $items) {
            $rolesList[] = $items['role_id']['name'];
            for ($i = 0; $i < count($items['role_previleges']); $i++) {
                $permissions[] = $items['role_previleges'][$i]['namespace'];
            }
        }

        $permissions = array_unique($permissions);

        if (count($permissions) <= 0) $permissions[] = 'dashboard';

        $setPermisson = [
            'bearer_token' => $tokenResult->plainTextToken,
            'permissions' => $permissions,
            'role_list' => $rolesList
        ];

        session($setPermisson);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('warning', 'You are now not authenticated, please login to get access ...');
    }
}
