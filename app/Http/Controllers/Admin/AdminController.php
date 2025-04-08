<?php

namespace App\Http\Controllers\Admin;

use App\Models\PasswordManager;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules\FileTypeValidate;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pageTitle = 'Dashboard';
        $totalPassword = PasswordManager::count();
        return view('admin.dashboard', compact('pageTitle', 'totalPassword'));
    }

    public function profile()
    {
        $pageTitle = 'Profile';
        $admin = auth('admin')->user();
        return view('admin.profile', compact('pageTitle', 'admin'));
    }

    public function profileUpdate(Request $request)
    {
        $admin = auth('admin')->user();
        $validator = $this->profileValidator($request->only(['name', 'email', 'username', 'image']), $admin->id);
        if ($validator->passes()) {
            if ($request->hasFile('image')) {               
                $old = $admin->image;
                $admin->image = fileUploader($request->image, getFilePath('adminProfilePic'), getFileSize('adminProfilePic'), $old);
            }
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
            ]);
            return response()->json([
                'status'=> true,
                'redirect' => route('admin.profile'),
                'message' => 'Profile Updated Succesfully.'
            ]);
        } else {
            return response()->json([
                'status'=> false,
                'message' => 'Please fill the required input field',
                'errors'=> $validator->errors()
            ]);
        }
    }

    public function password()
    {
        $pageTitle = 'Password Setting';
        $admin = auth('admin')->user();
        return view('admin.password', compact('pageTitle', 'admin'));
    }

    public function passwordUpdate(Request $request)
    {
        $validator = Validator::make($request->only('old_password', 'new_password', 'confirm_password'), [
            'old_password' => 'required|min:4',
            'new_password' => 'required|min:4',
            'confirm_password' => 'required|same:new_password',
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input field',
                'errors' => $validator->errors() 
            ]);
        }
        $admin = auth('admin')->user();
        if (!Hash::check($request->old_password, $admin->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Your old password is incorrect.'
            ]);
        }
        $admin->password = Hash::make($request->new_password);
        $admin->save();
        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully.'
        ]);
    }

    private function profileValidator($data, $id = null)
    {
        $rules = [
            'name' => 'required',
            'email' => [ 'required', 'email', Rule::unique('admins')->ignore($id) ],
            'username' => ['required', 'string', Rule::unique('admins')->ignore($id) ],
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ];
        $messages = [
            'name.required' => 'The Name field is required.',
            'email.required' => 'The Email field is required.',
            'email.email' => 'The Email must be a valid Email.',
            'email.unique' => 'The Email already used.',
            'username.unique' => 'The Username already used.',
            'username.required' => 'The Username field is required.',
        ];
        return Validator::make($data, $rules, $messages);
    }
}
