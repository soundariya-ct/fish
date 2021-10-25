<?php

namespace App\Traits;
use Illuminate\Support\Str;

trait ImageTrait{

    private function file_path($file,$folder_name)
    {
        $file_name = Str::random(6).time().'.'.$file->extension();
        $db_path = 'media/'.$folder_name.'/'.$file_name;
        $path = 'media/'.$folder_name;
        return ['file_name' => $file_name,'db_path' => $db_path,'path' => $path];
    }

    public function upload_file($file,$folder_name)
    {
        $file_arr = $this->file_path($file,$folder_name);
        $file->move($file_arr['path'], $file_arr['file_name']);
        return $file_arr;
    }


}
