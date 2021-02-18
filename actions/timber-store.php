<?php
require_once '../config.php';

use BookWorms\Model\Timber;
use BookWorms\Model\Image;
use BookWorms\Model\FileUpload;
use BookWorms\Model\User;

if ($request->is_logged_in()) {
  $role = $request->session()->get("role");
}



try {
  $category = [
    "Hardwood", "Softwood"
  ];

  $rules = [
    "title" => "present|minlength:2|maxlength:64",
    "description" => "present|minlength:20|maxlength:2000",
    "category" => "present|in:" . implode(',', $category),
    "price" => "present",
    "minimum_order" => "present"
  ];

  $request->validate($rules);
  if ($request->is_valid()) {
    $file = new FileUpload("profile");
    $filename = $file->get();
    $image = new Image();
    $image->filename = $filename;
    $image->save();

    $timber = new Timber();
    $timber->title = $request->input("title");
    $timber->description = $request->input("description");
    $timber->category = $request->input("category");
    $timber->price = $request->input("price");
    $timber->minimum_order = $request->input("minimum_order");
    $timber->image_id = $request->input("image_id");
    /*Insert the value for the image object we've created above.*/
    $timber->image_id = $image->id;
    $timber->save();

    $request->session()->set("flash_message", "The timber product was successfully added to the database");
    $request->session()->set("flash_message_class", "alert-info");
    $request->session()->forget("flash_data");
    $request->session()->forget("flash_errors");

    $request->redirect("/views" . "/" . $role . "/home.php");
  } else {
    $request->session()->set("flash_data", $request->all());
    $request->session()->set("flash_errors", $request->errors());
    $request->redirect("/views" . "/" . $role . "/home.php");
  }
} catch (Exception $ex) {
  $request->session()->set("flash_message", $ex->getMessage());
  $request->session()->set("flash_message_class", "alert-warning");
  $request->session()->set("flash_data", $request->all());
  $request->session()->set("flash_errors", $request->errors());
  $request->redirect("/home.php");
}
