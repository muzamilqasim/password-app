<?php

namespace App\Http\Controllers\Admin;

use Image;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $pageTitle = 'General Setting';
        return view('admin.setting.general', compact('pageTitle'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->only('site_title', 'email_from', 'copyright_text'), [
            'site_title' => 'nullable|string|max:50',
            'email_from' => 'nullable|string|max:50|email',
            'copyright_text' => 'nullable|string|max:100',
        ]);
        if($validator->passes()) {
            $general = gs();
            $general->site_title = $request->site_title;
            $general->email_from = $request->email_from;
            $general->copyright_text = $request->copyright_text;
            $general->save();
            return response()->json([
                'status' => true,
                'redirect' => route('admin.setting.index'),
                'message' => 'General Setting Updated Succesfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input field',
                'errors' => $validator->errors()
            ]);
        }
    }

    public function logoIcon()
    {
        $pageTitle = 'Logo & Favicon';
        return view('admin.setting.logo_icon', compact('pageTitle'));
    }

    public function logoIconUpdate(Request $request)
    {
        $validator = Validator::make($request->only('logo', 'favicon'), [
            'logo' => ['image', new FileTypeValidate(['jpg','jpeg','png'])],
            'favicon' => ['image', new FileTypeValidate(['png'])],
        ]);
        if($validator->passes()) {
            if ($request->hasFile('logo')) {
                try {
                    $path = getFilePath('logoIcon');
                    if (!file_exists($path)) {
                        mkdir($path, 0755, true);
                    }
                    Image::make($request->logo)->save($path . '/logo.png');
                } catch (\Exception $exp) {
                    return response()->json([
                        'status' => false,
                        'redirect' => route('admin.setting.logo.icon'),
                        'message' => 'Couldn\'t upload the logo.'
                    ]);
                }
            }
            if ($request->hasFile('favicon')) {
                try {
                    $path = getFilePath('logoIcon');
                    if (!file_exists($path)) {
                        mkdir($path, 0755, true);
                    }
                    $size = explode('x', getFileSize('favIcon'));
                    Image::make($request->favicon)->resize($size[0], $size[1])->save($path . '/favicon.png');
                } catch (\Exception $exp) {
                    return response()->json([
                        'status' => false,
                        'redirect' => route('admin.setting.logo.icon'),
                        'message' => 'Couldn\'t upload the favicon.'
                    ]);
                }
            }
            return response()->json([
                'status' => true,
                'redirect' => route('admin.setting.logo.icon'),
                'message' => 'Logo / Icon Updated Succesfully.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please fill the required input field',
                'errors' => $validator->errors()
            ]);
        }
    }
}
