<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HelperController extends Controller
{
    // Save file.
    public function uploadFile(Request $request)
    {
        $this->validate($request, [
            'upload_file' => 'required|image',
            'path' => 'required'
        ]);

        // Save image to storage and get path.
        $path = '';
        $success = false;
        if ($request->hasFile('upload_file') && $request->upload_file->isValid()) {
            $path = Storage::url($request->upload_file->storeAs('images/' . $request->path . '/' . Carbon::now()->timestamp, $request->upload_file->getClientOriginalName(), 'public'));
            $success = true;
        }

        return collect([
            'success' => $success,
            'msg' => '上传失败，请重试。',
            'file_path' => $path
        ])->toJson();
    }
}
