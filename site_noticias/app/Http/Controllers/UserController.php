<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
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
                    'user' => $user
                ], 201);
            }
        } catch (\Exception $e) {
            // Retornar erro genérico
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => [
                'required',
                'string',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'sex' => 'required|string',
            'level' => 'required|integer',
        ]);
        try {
            $user->update([
                'name'  => $fields['name'],
                'email' => $fields['email'],
                'sex'  => $fields['sex'],
                'level' => $fields['level']
            ]);

            return response()->json([
                'message' => ' User updated successfully.',
                'user' => $user

            ], 200);
        } catch (\Exception $e) {
            // Retornar erro genérico
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function listUsers()
    {
        try {
            $users = User::all();

            return response()->json([
                'message' => ' Users.',
                'users' => $users
            ], 200);
        } catch (\Exception $e) {
            // Retornar erro genérico
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function listUser($id)
    {
        try {
            $user = User::find($id);

            return response()->json([
                'message' => ' User.',
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            // Retornar erro genérico
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }
        try {

            $user->delete();

            return response()->json([
                'message' => ' User Deleted Successfully.',
            ], 200);
        } catch (\Exception $e) {
            // Retornar erro genérico
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
