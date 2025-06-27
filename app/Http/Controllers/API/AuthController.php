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
            'name' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string|max:20',
        ]);

        // Crear usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Buscar rol cliente
        $rolCliente = Rol::where('name', 'cliente')->firstOrFail();

        // Crear persona asociada
        Persona::create([
            'user_id' => $user->id,
            'nombre' => $request->name,
            'apellido' => $request->apellido,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'rol_id' => $rolCliente->id,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Credenciales incorrectas'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['success' => true]);
    }

    public function me(Request $request)
    {
        $user = $request->user()->load('persona.rol');

        return response()->json([
            'user' => $user,
            'persona' => $user->persona,
            'rol' => $user->persona->rol->name ?? null
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $user->update($request->only(['name', 'email']));

        if ($user->persona) {
            $user->persona->update($request->only(['nombre', 'apellido', 'direccion', 'telefono']));
        }

        return response()->json([
            'success' => true,
            'user' => $user->load('persona.rol')
        ]);
    }
}
