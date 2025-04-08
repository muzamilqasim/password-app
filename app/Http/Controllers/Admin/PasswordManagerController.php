<?php

namespace App\Http\Controllers\Admin;

use Auth, Hash;
use Illuminate\Http\Request;
use App\Models\PasswordManager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PasswordManagerController extends Controller
{
    public function index() 
    {
        $pageTitle = "Website & App Password Manager";
        $data = PasswordManager::orderBy('created_at', 'desc')->paginate(getPaginate());
        return view('admin.password_manager.list', compact('pageTitle', 'data'));
    }

    public function create() 
    {
        $pageTitle = "Add Password";
        return view('admin.password_manager.add', compact('pageTitle')); 
    }

    public function store(Request $request) 
    {
        $validator = $this->fieldValidate($request->only(['app_name', 'email', 'username', 'password', 'key', 'image']));
        if ($validator->passes()) {
            $data = PasswordManager::create([
                'app_name' => $request->app_name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => base64_encode($request->password),
                'key' => base64_encode($request->key),
            ]);
            if (!empty($request->image)) {
                $imagePath = fileUploader($request->image, getFilePath('image'));
                $data->update(['image' => $imagePath]);
            }
            return response()->json([
                'status' => true,
                'message' =>  'App Password created successfully.',
                'redirect' => route('admin.app.index')
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input field',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function show($id) 
    {
        $pageTitle = "App Details";
        $data = PasswordManager::find($id);
        if(!$data) {
            return redirect()->route('admin.app.index')->withNotify('Record not found');
        }
        return view('admin.password_manager.show', compact('pageTitle', 'data'));
    }

    public function edit($id) 
    {
        $pageTitle = 'Edit Passwords';
        $data = PasswordManager::find($id);
        if(!$data) {
            return redirect()->route('admin.app.index')->withNotify('Record not found');
        }
        return view('admin.password_manager.edit', compact('pageTitle', 'data'));
    }

    public function update(Request $request, $id) 
    {
        $data = PasswordManager::find($id);
        if(!$data) {
            return response()->json([
                'status' => false,
                'message' =>  'App Password not found.',
                'redirect' => route('admin.app.index')
            ]);    
        }
        $validator = $this->fieldValidate($request->only(['app_name', 'email', 'username', 'password', 'key', 'image']), $id);
        if ($validator->passes()) {
            if ($request->hasFile('image')) {               
                $old = $data->image;
                $data->image = fileUploader($request->image, getFilePath('image'), null,$old);
            }
            $data->update([
                'app_name' => $request->app_name,
                'email' => $request->email,
                'username' => $request->username,
            ]);
            if ($request->password) {               
                $data->password = base64_encode($request->password);
            }
            if ($request->key) {
                $data->key = base64_encode($request->key);
            }
            $data->update();
            return response()->json([
                'status' => true,
                'message' =>  'App Password updated successfully.',
                'redirect' => route('admin.app.index')
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input field',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($id) 
    {
        $data = PasswordManager::find($id);
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'App Password not found.',
            ]);    
        }
        if ($data->image) { 
            $filePath = getFilePath('image'). '/' . $data->image;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $data->delete();
        return response()->json([
            'status' => true,
            'message' => 'App Password deleted successfully.',
        ]);
    }

    private function fieldValidate($data)
    {
        $rules = [
            'app_name' => 'required',
            'email' => 'nullable|email',
        ];
        $messages = [
            'app_name.required' => 'The Name field is required.',
            'email.email' => 'Must be valid email.',
        ];
        return Validator::make($data, $rules, $messages);
    }

    public function verifyAppPassword(Request $request)
    {
        $adminPassword = Auth::guard('admin')->user()->password;
        if (Hash::check($request->password, $adminPassword)) {
            $storedAppPassword = PasswordManager::where('id', $request->id)->first();
            if ($storedAppPassword) {
                if ($request->field_type === 'password') {
                    $decryptedPassword = base64_decode($storedAppPassword->password);
                } elseif ($request->field_type === 'key') {
                    $decryptedPassword = base64_decode($storedAppPassword->key);
                } else {
                    return response()->json(['valid' => false, 'message' => 'Invalid field type.']);
                }
                return response()->json(['valid' => true, 'pass' => $decryptedPassword]);
            } else {
                return response()->json(['valid' => false, 'message' => 'Record not found.']);
            }
        } else {
            return response()->json(['valid' => false, 'message' => 'Incorrect app password.']);
        }
    }

    public function search(Request $request)
    {
        $query = $request->search;
        $app = PasswordManager::where(function($q) use ($query) {
            $q->where('app_name', 'like', "%$query%");
        })->get();
        return response()->json([
            'status' => true,
            'data' => $app,
        ]);
    }
}
