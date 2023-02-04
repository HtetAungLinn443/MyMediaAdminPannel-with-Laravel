<?php

namespace App\Http\Controllers;

use app\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //profile page
    public function index()
    {
        return view('admin.profile.index');
    }

    //Update Account
    public function updateAdminAccount(Request $request, $id)
    {
        $this->userValidationCheck($request);
        $user = $this->getUserData($request);
        User::where('id', $id)->update($user);
        return back()->with(['updateSuccess' => 'Admin Account Updated!']);
    }

    //change password page
    public function changePasswordPage()
    {
        return view('admin.profile.changePassword');
    }

    //change password
    public function changePassword(Request $request)
    {
        $this->changePasswordValidation($request);

        $dbData = User::where('id', Auth::user()->id)->first();
        $dbPassword = $dbData->password;

        $hashUserPassword = Hash::make($request->newPassword);

        $updateData = [
            'password' => $hashUserPassword,
        ];

        if (Hash::check($request->oldPassword, $dbPassword)) {
            User::where('id', Auth::user()->id)->update($updateData);
            return redirect()->route('dashboard');
        } else {
            return back()->with(['fill' => 'Old Password Do not much!']);
        }
    }

    //private function
    //user data
    private function getUserData($request)
    {
        return [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'phone' => $request->adminPhone,
            'address' => $request->adminAddress,
            'gender' => $request->adminGender,
            'updated_at' => Carbon::now(),
        ];
    }

    // user validation check
    private function userValidationCheck($request)
    {
        Validator::make($request->all(), [
            'adminName' => 'required',
            'adminEmail' => 'required',
        ], [
            'adminName.required' => 'Name is Required...',
            'adminEmail.required' => 'Email is Required...',
        ])->validate();
    }

    //change password validation
    private function changePasswordValidation($request)
    {
        $validationRule = [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|max:15',
            'confirmPassword' => 'required|same:newPassword|min:8|max:15',
        ];

        $validationMessage = [
            'confirmPassword.same' => 'New Password and Confirm Password must me same!',
        ];
        Validator::make($request->all(), $validationRule, $validationMessage)->validate();

    }
}