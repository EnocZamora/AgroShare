<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProfileChange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'preferred_language' => 'required|in:es,miskito,creole',
            'department' => 'nullable|string|max:100',
            'municipality' => 'nullable|string|max:100',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $validated['profile_photo'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        // 1. Actualizar los datos actuales del usuario
        $user->update($validated);

        // 2. Guardar el registro del cambio en la tabla de historial (profile_changes)
        ProfileChange::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'preferred_language' => $user->preferred_language,
            'department' => $user->department,
            'municipality' => $user->municipality,
            'profile_photo' => $user->profile_photo,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('profile.show')->with('success', 'Perfil actualizado y registrado exitosamente.');
    }
}