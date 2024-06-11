<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;


class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return Inertia::render('Admin/Members/Index', [
            'members' => $members
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Members/Create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'description' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = Storage::disk('public')->put('image', $request->file('profile_picture'));
            $validatedData['profile_picture'] = '/storage/' . $path;
        } 

        Member::create($validatedData);

        return redirect()->route('members.index');
    }

    public function edit(Member $member)
    {
        return Inertia::render('Admin/Members/Edit', [
            'member' => $member
        ]);
    }

    public function update(Request $request, Member $member)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'description' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = Storage::disk('public')->put('image', $request->file('profile_picture'));
            $validatedData['profile_picture'] = '/storage/' . $path;
        } 
        
        $member->update($validatedData);

        return redirect()->route('members.index');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index');
    }
}