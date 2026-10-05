<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Summary;
use App\Models\BasicDepartment;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function show(User $user)
    {
        $userSummariesCount = $user->summaries()->count();

        $savedCount = $user->savedSummaries()->count();

        $likesCount = $user->likedSummaries()->count();

        $downloadsCount = $user->downloads()->count();


        $totalLikes = Summary::where('user_id', $user->id)
            ->where('status' , 'accepted')
            ->withCount('likers')
            ->get()
            ->sum('likers_count');

        if ($user->role === 'admin') {
            abort(403, 'لا يمكن عرض ملف تعريف المسؤول.');
        }
        return view('user.profile', compact(
            'user',
            'userSummariesCount',
            'savedCount',
            'likesCount',
            'downloadsCount',
            'totalLikes'
        ));
    }



    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $BasicDepartment = BasicDepartment::all();
        $names = explode(' ', $request->user()->name, 2);
        $firstName = $names[0] ?? '';
        $lastName = $names[1] ?? '';
        return view('settings', [
            'user' => $request->user(),
            'firstName' => $firstName,
            'lastName' => $lastName,
            'basic_departments' => $BasicDepartment,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validatedData = $request->validated();
        // $validatedData['name'] = $validatedData['first_name'] . ' ' . $validatedData['last_name'];
        // unset($validatedData['first_name'], $validatedData['last_name']);

        // if($request->hasfile('avatar')){
        //     $path = $request->file('avatar')->store('avatars', 'public');
        //     $user->avatar = $path;
        // }
        // unset($validatedData['avatar']);
        $user->fill($validatedData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();

        return Redirect::route('settings')->with('success', 'تم تعديل الملف الشخصي بنجاح.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function destroyAvatar()
    {
        $user = auth()->user();

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->avatar = null;
        $user->save();

        return back()->with('success', 'تم حذف الصورة بنجاح.');
    }
    public function storeAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('avatar')) {
            // امسح الصورة القديمة لو موجودة
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
            $user->save();
        }

        return back()->with('success', 'تم رفع الصورة بنجاح.');
    }
}
