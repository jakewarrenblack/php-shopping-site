<?php
require_once '../config.php';
use BookWorms\Model\Timber;
use BookWorms\Model\Image;
use BookWorms\Model\FileUpload;

try {
    $categories = [
        "1", "2"
    ];

    $rules = [
        "title" => "present|minlength:2|maxlength:64",
        "description" => "present|minlength:10|maxlength:2000",
        "price" => "present|minlength:1|maxlength:2000",
        "category_id" => "present|minlength:1|maxlength:1000",
        "minimum_order" => "present|minlength:1|maxlength:2000"
    ];

    $request->validate($rules);
    if ($request->is_valid()) {
        $image = null;
        if (FileUpload::exists('profile')) {
            $file = new FileUpload("profile");  
            $filename = $file->get();          
            $image = new Image();
            $image->filename = $filename;
            $image->save();
        }
        $timber = Timber::findById($request->input("timber_id"));
        $timber->title = $request->input("title");
        $timber->description = $request->input("description");
        $timber->category_id = $request->input("category_id");
        $timber->price = $request->input("price");
        $timber->minimum_order = $request->input("minimum_order");
        /*If not null, the user must have uploaded an image, so reset the image id to that of the one we've just uploaded.*/
        if ($image !== null) {
            $timber->image_id = $image->id;
        }
        $timber->save();
        $request->session()->set("flash_message", "The timber product was successfully updated in the database");
        $request->session()->set("flash_message_class", "alert-info");
        /*Forget any data that's already been stored in the session.*/
        $request->session()->forget("flash_data");
        $request->session()->forget("flash_errors");
        $request->redirect("/index.php");
    } 
    else {
        $timber_id = $request->input("timber_id");
        $request->session()->set("flash_data", $request->all());
        $request->session()->set("flash_errors", $request->errors());
        $request->redirect("../../views/admin/products/timber-edit.php?timber_id=" . $timber_id);
        
    }
} catch (Exception $ex) {
    $request->session()->set("flash_message", $ex->getMessage());
    $request->session()->set("flash_message_class", "alert-warning");
    $request->session()->set("flash_data", $request->all());
    $request->session()->set("flash_errors", $request->errors());

    $request->redirect("/index.php");
}