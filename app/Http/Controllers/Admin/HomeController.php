<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;

class HomeController extends Controller
{

    use ImageTrait;

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function fileUploadEditor()
    {
        reset($_FILES);
        $temp = current($_FILES);

        if($temp['size'] > 10485760) { // 10 MB (this size is in bytes)
            return json_encode(['File exceeds limit of 10mb']);
        }

        // Accept upload if there was no origin, or if it is an accepted origin
        $file_name = $temp['name'];

        $file_arr =   $this->upload_file($file_name,'uploads');

        $file_path = $file_arr['path'].'/'.$file_arr['file_name'];

        move_uploaded_file($temp['tmp_name'], $file_path);

        $path = url('/').'/'.$file_arr['db_path'];

        return json_encode(['location' => $path]);
    }
}
