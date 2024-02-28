<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ImageController extends Controller {

    public static function storeImage(Request $request, $path, $fieldName = 'image') {
        try {
            $request->validate([
                $fieldName => 'required|image|mimes:png,jpg,jpeg|max:2048'
            ]);

            $imageName = Str::orderedUuid().'.'.$request->$fieldName->extension();

            // Create the directory if it doesn't exist
            if (!file_exists('storage/'.$path)) {
                mkdir('storage/'.$path, 0777, true);
            }

            // Move the image to the storage path
            if ($request->$fieldName->move(storage_path($path), $imageName)) {
                // Image upload successful
                return $imageName;
            } else {
                // Image move failed
                echo 'Image move failed';
                return false;
            }
        } catch (\Exception $e) {
            // Exception occurred during image upload
            echo 'Image upload error: ' . $e->getMessage();
            return false;
        }
    }
}
