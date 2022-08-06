<?php

namespace App\Http\Controllers\front;

use App\RC\Form;
use App\RC\Trans;
use Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Requests;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class Upload extends Controller {

    function __construct() {
        
    }

    public function delete(Request $request) {

     
        $name = $request->input("name");
        File::delete("public/files/$name");
        File::delete("public/files/thumbs/$name");
        File::delete("public/files/micro/$name");
        File::delete("public/files/larg/$name");
        DB::table('rc_upload')->where('name', '=', $name)->delete();
        echo json_encode(array("name" => $name));
    }

    public function index(Request $request) {


        $larg = 2000;
        $thumbs = 400;
        $micro = 200;

        $file = $request->file('file');
        $mark = $request->input('mark');

        $ext = strtolower($file->getClientOriginalExtension());
        $size = $file->getSize();
        $mime = $file->getMimeType();
        $title = $file->getClientOriginalName();
        $name = Str::random(13) . ".{$ext}";

        $destinationPath = 'public/files';
        $file->move($destinationPath, $name);

        if ($ext == "png" || $ext == "jpg" || $ext == "gif" || $ext == "jpeg"):
            @$this->resize($larg, $larg, asset("files/$name"), "larg/$name", $ext);
            @$this->resize($thumbs, $thumbs, asset("files/$name"), "thumbs/$name", $ext);
            @$this->resize($micro, $micro, asset("files/$name"), "micro/$name", $ext);
            if ($mark):
//                @$this->watermark(asset("files/logo.png"), asset("files/larg/$name"), "larg/$name");
            endif;
        endif;

        $value = array();
        $value["name"] = $name;
        $value["title"] = $title;
        $value["ext"] = $ext;
        $value["mime"] = $mime;
        $value["size"] = $size;
        $value["active"] = 0;
        $value["parent"] = 0;
        DB::table('rc_upload')->insert($value);

        echo json_encode(array("name" => $name));
    }

    private function resize($max_width, $max_height, $img, $out, $ext) {

        $w = $max_width;
        $h = $max_height;

        $percent = 1;
        list($width, $height) = getimagesize($img);
        if ($width > $height && $w <= $width):
            $percent = $w / $width;
        else:
            if ($h <= $height):
                $percent = $h / $height;
            endif;
        endif;

        $new_width = $width * $percent;
        $new_height = $height * $percent;

        if ($ext == "jpg" || $ext == "jpeg") {
            $original = imagecreatefromjpeg($img);
            $resized = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($resized, $original, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($resized, "public/files/$out");
        }

        if ($ext == "png") {
            $original = imagecreatefrompng($img);
            $resized = @imagecreatetruecolor($new_width, $new_height);
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            imagecopyresampled($resized, $original, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagepng($resized, "public/files/$out");
        }

        if ($ext == "gif") {
            $original = imagecreatefromgif($img);
            $resized = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($resized, $original, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagegif($resized, "public/files/$out");
        }
    }

    private function watermark($stamp, $img, $out) {

        $stamp_ext = pathinfo($stamp, PATHINFO_EXTENSION);
        $img_ext = pathinfo($img, PATHINFO_EXTENSION);

        $stamp = imagecreatefrompng($stamp);
        if ($stamp_ext == "jpg" || $stamp_ext == "jpeg"):
            $stamp = imagecreatefromjpeg($stamp);
        endif;
        if ($stamp_ext == "gif"):
            $stamp = imagecreatefromgif($stamp);
        endif;

        $im = imagecreatefrompng($img);
        if ($img_ext == "jpg" || $img_ext == "jpeg"):
            $im = imagecreatefromjpeg($img);
        endif;
        if ($img_ext == "gif"):
            $stamp = imagecreatefromgif($stamp);
        endif;

        $marge_right = 10;
        $marge_bottom = 10;

        $sx = imagesx($stamp);
        $sy = imagesy($stamp);

        imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

        if ($img_ext == "jpg" || $img_ext == "jpeg"):
            imagejpeg($im, "public/files/$out");
        endif;
        if ($img_ext == "png"):
            imagepng($im, "public/files/$out");
        endif;
        if ($img_ext == "gif"):
            imagegif($im, "public/files/$out");
        endif;
    }

    public function editor(Request $request) {


        $larg = 2000;
        $thumbs = 400;
        $micro = 200;

        $file = $request->file('file');
//        $mark = $request->input('mark');

        $ext = strtolower($file->getClientOriginalExtension());
        $size = $file->getSize();
        $mime = $file->getMimeType();
        $title = $file->getClientOriginalName();
        $name = Str::random(13) . ".{$ext}";

        $destinationPath = 'public/files';
        
        
        $file->move($destinationPath, $name);

        /*
        if ($ext == "png" || $ext == "jpg" || $ext == "gif" || $ext == "jpeg"):
            @$this->resize($larg, $larg, asset("files/$name"), "larg/$name", $ext);
            @$this->resize($thumbs, $thumbs, asset("files/$name"), "thumbs/$name", $ext);
            @$this->resize($micro, $micro, asset("files/$name"), "micro/$name", $ext);
            if ($mark):
                @$this->watermark(asset("files/logo.png"), asset("files/larg/$name"), "larg/$name");
            endif;
        endif;
         * 
         */

        $value = array();
        $value["name"] = $name;
        $value["title"] = $title;
        $value["ext"] = $ext;
        $value["mime"] = $mime;
        $value["size"] = $size;
        $value["active"] = 0;
        $value["parent"] = 0;
        DB::table('rc_upload')->insert($value);

        echo json_encode(array("link" => secure_url("files/".$name)));
    }

}
