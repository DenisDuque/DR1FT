<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\RacePhoto;
class ImageController extends Controller {


    public static function storeImage(Request $request, $path, $fieldName = 'image') {
        try {
            $request->validate([
                $fieldName => 'mimes:png,jpg,jpeg'
            ]);

            $image = $request->file($fieldName);

            // Generar un nombre único para la imagen
            $imageName = Str::orderedUuid().'.'.$image->extension();

            // Almacenar la imagen en el directorio storage/app/$path
            $imagePath = $image->storeAs($path, $imageName, 'public');

            // Devolver el nombre de la imagen almacenada
            return $imageName;
        } catch (\Exception $e) {
            // Manejar errores de carga aquí
            echo 'Image upload error: ' . $e->getMessage();
            return false;
        }
    }

    public static function storeImages(Request $request, $path, $fieldName = 'images') {
        try {
            $request->validate([
                $fieldName . '.*' => 'mimes:png,jpg,jpeg'
            ]);
    
            $imageNames = [];
            $images = $request->file($fieldName);
            foreach ($images as $image) {
                // Generar un nombre único para la imagen
                $imageName = Str::orderedUuid() . '.' . $image->extension();
    
                // Almacenar la imagen en el directorio storage/app/$path
                $imagePath = $image->storeAs($path, $imageName, 'public');
    
                // Agregar el nombre de la imagen a la matriz
                $imageNames[] = $imageName;
            }
    
            // Devolver un array de nombres de imágenes almacenadas
            return $imageNames;
        } catch (\Exception $e) {
            // Manejar errores de carga aquí
            echo 'Image upload error: ' . $e->getMessage();
            return false;
        }
    }
    

    public static function gallery(){

        // Obtener todas las fotos de la tabla race_photo
        $photos = RacePhoto::all();

        // Devolver la vista con las rutas de las imágenes
        return view('page.gallery', ['photos' => $photos]);
    }
}
