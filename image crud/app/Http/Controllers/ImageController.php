<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Validator;
use Illuminate\Support\Facades\File;
class ImageController extends Controller
{
    //index page 
    public function showPage(){
        $imagesView=Image::all();
        return view("image.index",["imageView"=>$imagesView]);
    }

    // inert page image 
    public function insertImage(Request $request){
      $validation=Validator::make($request->all(),[
        "name"=>"required",
        "profile_image"=>"mimes:jpeg,jpg,png,gif|required|max:10000",
      ]);
      if($validation->fails()){
        return redirect()->back()->withErrors($validation);
      }

      $imageFile=$request->hasFile("profile_image");
      if($imageFile){
        $imageUpload=$request->file("profile_image"); // this is for uploading file 
        $extension=$imageUpload->getClientOriginalExtension(); // this is for extension 
        $imageNaming=time().".".$extension;
       $imageUpload->move("images",$imageNaming); // we are using variable imageUploard beacuae its taking uploaded file
        
      }
      $imageData=new Image;
      $imageData->name=$request->name;
      $imageData->profile_image=$imageNaming;
      $imageData->save();

       return redirect()->back()->with("status","data inserted successfully");
    }

    // to show image
    public function editImage($id){
        
        $images=Image::find($id);
        return view("image.edit",compact("images"));
    }

// Now to update image data 
public function imageUpdate(Request $request,$id){

      $validation=Validator::make($request->all(),[
         "name"=>"required",
         "profile_image"=>"required"
      ]);
   
   if($validation->fails()){
   
     return redirect()->back()->withInput()->withErrors($validation);
   }
     $imageUpdate= Image::find($id);
    // to check file exist in it use File class
    $imageFile=$request->hasFile("profile_image");

        if($imageFile){
          // to check file in storage then delete it 
          // default path is public only
            $destination="images/".$imageUpdate->profile_image; // it is taking destination
                     if(File::exists($destination)){

                          File::delete($destination);
                       }
         $imageUpload=$request->file("profile_image"); // this is for uploading file 
         $extension=$imageUpload->getClientOriginalExtension(); // this is for extension 
        $imageNaming=time().".".$extension;
          $imageUpload->move("images",$imageNaming); // we are using variable imageUploard beacuae its taking uploaded file
  
        }

           $imageUpdate->name=$request->name;
           $imageUpdate->profile_image=$imageNaming;
        $imageUpdate->save();   
     return redirect("show-page")->with("update-message","image and name updated successfully");
}

           // Now we are deleting image data
            public function deleteImageData($id){
                  $deleteData=Image::find($id);
                 
                    // to check file in storage then delete it 
                      $destination="images/".$deleteData->profile_image; // it is taking destination
                               if(File::exists($destination)){
          
                                    File::delete($destination);
                                 }
                  $deleteData->delete();
                  return redirect()->back()->with("delete-message","Record deleted successfully");
           }

}
