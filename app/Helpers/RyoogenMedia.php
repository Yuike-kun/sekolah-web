<?php

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

if (! function_exists('upload_file')) {
    function upload_file($pathFileLocation, $requestFile)
    {
        (config('app.env') == 'local') ? $storage = '' : $storage = 'public/';

        $temporaryFileName = Str::uuid().'.'.
            $requestFile->getClientOriginalExtension();

        $requestFile->move($storage.$pathFileLocation, $temporaryFileName);

        return $pathFileLocation.$temporaryFileName;
    }
}

if (! function_exists('base64_to_image')) {
    function base64_to_image($img, $upload_dir = '/')
    {
        if ($img) {
            try {
                $ext = explode(';', (explode('/', $img))[1])[0];
                $img = str_replace('data:image/'.$ext.';base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $file = uniqid().'.'.$ext;

                if (! File::exists($upload_dir)) {
                    File::makeDirectory($upload_dir, 0777, true);
                }

                $success = file_put_contents($upload_dir.$file, $data);

                return $success ? $file : null;
            } catch (\Exception $e) {
                return null;
            }
        }

        return null;
    }
}

if (! function_exists('number_registration')) {
    function number_registration()
    {
        $x = true;
        while ($x) {
            $digits = 8;
            $random = substr(str_shuffle('0123456789'), 0, $digits).Carbon::parse(date('Y-m-d'))->format('dmy');

            if (! Student::where('number_registration', $random)->exists()) {
                return $random;
            }
        }
    }
}
