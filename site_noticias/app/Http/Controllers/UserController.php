<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function addUser(Request $request)
    {
        // dd($request);
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email', // ou unique:usuarios,email, dependendo do nome da tabela
            'password' => ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()],
            // 'confirmPassword' => 'required|string|same:password',
            'sex' => 'required|string',
            'level' => 'required|integer',
            'photo' => 'required|string',
        ]);
    
        try {

            $user = User::create([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'password' => Hash::make($fields['password']),
                'sex' => $fields['sex'],
                'level' => $fields['level'],
                'photo' => $fields['photo'] ?? null,
                'recover_password' => ''
            ]); {
                
                return response()->json([
                    'message' => ' User Registered Successfully.',
                    'user'=>$user
                ], 201);
            }
        
        } catch (\Exception $e) {
            // Retornar erro genérico
            return response()->json(['error' => $e->getMessage()], 500);
        
        }
    }
}
