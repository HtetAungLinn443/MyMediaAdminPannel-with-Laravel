<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminListController extends Controller
{
    //admin List page
    public function index()
    {
        $user = User::get();
        // dd($user->toArray());
        return view('admin.list.index', compact('user'));
    }

    //admin account delete
    public function accountDelete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Account Delete Success!']);
    }

    // admin list search
    public function adminListSearch(Request $request)
    {
        $user = User::orWhere('name', 'LIKE', '%' . $request->adminSearchKey . '%')
            ->orWhere('email', 'LIKE', '%' . $request->adminSearchKey . '%')
            ->orWhere('phone', 'LIKE', '%' . $request->adminSearchKey . '%')
            ->orWhere('address', 'LIKE', '%' . $request->adminSearchKey . '%')
            ->orWhere('gender', 'LIKE', '%' . $request->adminSearchKey . '%')
            ->get();

        return view('admin.list.index', compact('user'));
    }
}