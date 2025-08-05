<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
 public function login(Request $request)
 {
    $credentials = $request->only('email', 'password');
    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Credenciales inválidas'], 401);
 }
    $user = Auth::user();
    $token = $user->createToken('AppToken')->plainTextToken;
    return response()->json([
    'token' => $token,
    'user' => $user
 ]);
 }
    public function perfil(Request $request)
 {
    return response()->json($request->user());
 }
 public function register(Request $request)
{
 $validator = Validator::make($request->all(), [
 'nombre' => 'required|string|max:255',
 'email' => 'required|email|unique:users,email',
 'password' => 'required|min:6',
 ]);
 if ($validator->fails()) {
 return response()->json(['errors' => $validator->errors()], 422);
 }
 $user = User::create([
 'name' => $request->nombre,
 'email' => $request->email,
 'password' => Hash::make($request->password),
 ]);
 return response()->json([
 'message' => 'Usuario registrado correctamente',
 'user' => $user
 ], 201);
}

}

