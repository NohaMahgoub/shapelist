<?php

namespace App\Http\Controllers\Api\V1;
use App\Models\Platform\Platform;

use Illuminate\Http\Request;

class PlatformController extends Controller
{
    
    //======================== index platform  ======================
    public function index()
    {
        $platform = Platform::all();
        return response()->json($platform);
    }

    //======================== create platform  ======================
    public function store(Request $request)
    {

    try{
        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/platform_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }


        $platform = new Platform;
        $platform->name= $request->name;
        $platform->image= $fileNameToStore;
        $platform->save();
        return response()->json($platform);


    } catch(\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == '1062'){
            return response()->json("this platform is already registered!" );
        }}
    }

    //======================== show platform  ======================
    
    public function show($id)
    {
        $platform = Platform::findOrFail($id);
        return response()->json($platform);
    }


    //======================== update platform  ======================

    public function update(Request $request, $id)
    {
        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/platform_images', $fileNameToStore);
        } else {
            $platform = Platform::findOrFail($id);
            $fileNameToStore = $platform->image;
        }    
              
                    $platform = Platform::findOrFail($id);
                    $platform->name= $request->name;
                    $platform->image= $fileNameToStore;
                    $platform->save();

                    return response()->json($platform);
                 }

    //======================== delete platform  ======================

    public function destroy($id)
    {
        $platform = Platform::findOrFail($id);
        $platform -> delete();  
        return response()->json("deleted successfully");
 
     }
}
