<?php

namespace App\Constants;

class FileInfo
{

    /*
    |--------------------------------------------------------------------------
    | File Information
    |--------------------------------------------------------------------------
    |
    | This class basically contain the path of files and size of images.
    | All information are stored as an array. Developer will be able to access
    | this info as method and property using FileManager class.
    |
    */

    public function fileInfo(){
        $data['default'] = [
            'path'      => 'assets/images/default.png',
        ];
        $data['logoIcon'] = [
            'path'      => 'assets/images/logoIcon',
        ];
        $data['favIcon'] = [
            'size'      => '128x128',
        ];
        $data['errors'] = [
            'path'      => 'assets/images/errors',
            'size'      => '200x200',
        ];
        $data['image'] = [
            'path'      => 'assets/admin/images/password',
        ];
        $data['adminProfilePic'] = [
            'path'      => 'assets/admin/images/profile',
            'size'      => '400x400',
        ];
        return $data;
	}

}
