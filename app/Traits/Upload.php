<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

trait Upload
{
    public function saveFile(Request $request, $path = [])
    {
        $pathfile = './storage/files';

        $finalRequest = $request;

        foreach ($request->all() as $key => $value) {
            if ($request->hasFile($key)) {
                $filename = date('YmdHmi_') . $request->file($key)->getClientOriginalName();
                $request->file($key)->move($pathfile, $filename);
                $finalRequest = new Request(array_merge($finalRequest->all(), [$key => $filename]));
            }
        }
        return $finalRequest;
    }
}