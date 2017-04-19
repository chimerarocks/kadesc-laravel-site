<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index($dir)
    {
    	function dirToArray($dir, $prefix) { 
   
		   $result = array(); 

		   $cdir = scandir($dir); 
		   foreach ($cdir as $key => $value) 
		   { 
		      if (!in_array($value,array(".",".."))) 
		      { 
		         if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) 
		         { 
		            $result = array_merge($result, dirToArray($dir . DIRECTORY_SEPARATOR . $value, $value . '/')); 
		         } 
		         else 
		         { 
		            $result[] = ($prefix ? $prefix : '') . $value; 
		         } 
		      } 
		   } 
		   
		   return $result; 
		} 
		$files = dirToArray(public_path('img/'. trim($dir) . '/'), false);
		return $files;
    }

    public function destroy()
    {
    	$path = request()->get('path');
    	ltrim("\\", $path);
    	$path = public_path($path);
    	if (is_dir($path) || !file_exists($path)) {
    		throw new \Exception("File not exists", 1);    		
    	} else {
    		unlink($path);
    		return 'file removed';
       	}
    }

    public function create(Request $request, $dir)
    {
    	$file = $request->file('photo');
    	$name = $file->getClientOriginalName();
    	$file->storeAs('img/'. trim($dir), $name);

    	return $name;
    }
}
