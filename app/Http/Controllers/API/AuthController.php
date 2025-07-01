<?php


namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Persona;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:6|confirmed',
            'avatar'     => 'nullable|string',
            'address'    => 'nullable|string',
            'phone'      => 'nullable|string|max:20',
        ]);

        // Crear persona
        $persona = Persona::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'avatar'     => $request->avatar,
            'address'    => $request->address,
            'phone'      => $request->phone,
        ]);

        // Obtener el rol "cliente"
        $rolCliente = Rol::where('name', 'cliente')->firstOrFail();

        // Crear usuario
        $user = User::create([
            'id_person' => $persona->id_person,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'id_rol'    => $rolCliente->id_rol,
        ]);

        // Generar token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'user'    => $user->load('persona', 'rol'),
            'token'   => $token,
        ]);
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'id_person' => 'required|exists:personas,id_person',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|confirmed',
            'id_rol'    => 'required|exists:roles,id_rol',
        ]);

        $user = User::create([
            'id_person' => $request->id_person,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'id_rol'    => $request->id_rol,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'user'    => $user->load('persona', 'rol'),
            'token'   => $token,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Incorrect credentials'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'user'    => $user->load('persona', 'rol'),
            'token'   => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['success' => true]);
    }

    public function me(Request $request)
    {
        $user = $request->user()->load('persona', 'rol');

        return response()->json([
            'success' => true,
            'user'    => $user,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'email'      => 'sometimes|email|unique:users,email,' . $user->id_user . ',id_user',
            'first_name' => 'sometimes|string',
            'last_name'  => 'sometimes|string',
            'avatar'     => 'nullable|string',
            'address'    => 'nullable|string',
            'phone'      => 'nullable|string|max:20',
        ]);

        if ($request->filled('email')) {
            $user->update(['email' => $request->email]);
        }

        if ($user->persona) {
            $user->persona->update($request->only([
                'first_name', 'last_name', 'avatar', 'address', 'phone'
            ]));
        }

        return response()->json([
            'success' => true,
            'user'    => $user->load('persona', 'rol')
        ]);
    }
}