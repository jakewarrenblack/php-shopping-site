<?php
require_once '../config.php';

use BookWorms\Model\Timber;
use BookWorms\Model\Image;
use BookWorms\Model\FileUpload;
use BookWorms\Model\User;
use BookWorms\Model\Related_Image;
use BookWorms\Model\Timber_Related_Image;
use BookWorms\Model\Attribute;
use BookWorms\Model\Timber_Attribute;

$attributes = array();

$attr = Attribute::findAll();
foreach ($attr as $at) {
  $attributes[] = $at->name;
}

if ($request->is_logged_in()) {
  $role = $request->session()->get("role");
}



try {
  $rules = [
    "title" => "present|minlength:2|maxlength:64",
    "description" => "present|minlength:10|maxlength:2000",
    "price" => "present|minlength:1|maxlength:2000",
    "category_id" => "present|minlength:1|maxlength:1000",
    "minimum_order" => "present|minlength:1|maxlength:2000",
    "attributes" => "present|subset:" . implode(",", $attributes)
  ];

  $request->validate($rules);
  if ($request->is_valid()) {
    $attributes = $request->input("attributes");
    if (count($attributes) > 2) {
      $request->session()->set("flash_message", "Please select a maximum of 2 attributes.");
      $request->session()->set("flash_message_class", "alert-warning");
      $request->session()->set("flash_data", $request->all());
      $request->session()->set("flash_errors", $request->errors());
      $request->redirect("/views" . "/" . $role . "/timber-create.php");
    }

    $file = new FileUpload("profile");
    $filename = $file->get();
    $image = new Image();
    $image->filename = $filename;
    $image->save();

    // now same as above but for related images
    $related1 = new FileUpload("related_image_1");
    $relatedfilename1 = $related1->get();
    $relatedimage1 = new Related_Image();
    $relatedimage1->filename = $relatedfilename1;
    $relatedimage1->save();

    $related2 = new FileUpload("related_image_2");
    $relatedfilename2 = $related2->get();
    $relatedimage2 = new Related_Image();
    $relatedimage2->filename = $relatedfilename2;
    $relatedimage2->save();

    $related3 = new FileUpload("related_image_3");
    $relatedfilename3 = $related3->get();
    $relatedimage3 = new Related_Image();
    $relatedimage3->filename = $relatedfilename3;
    $relatedimage3->save();

    // end saving related images

    $timber = new Timber();
    $timber->title = $request->input("title");
    $timber->description = $request->input("description");
    $timber->category_id = $request->input("category_id");
    $timber->price = $request->input("price");
    $timber->minimum_order = $request->input("minimum_order");
    $timber->image_id = $request->input("image_id");
    /*Insert the value for the image object we've created above.*/
    $timber->image_id = $image->id;
    $timber->save();

    $timber_related_image1 = new Timber_Related_Image;
    $timber_related_image1->related_image_id = $relatedimage1->id;
    $timber_related_image1->timber_id = $timber->id;
    $timber_related_image1->save();

    $timber_related_image2 = new Timber_Related_Image;
    $timber_related_image2->related_image_id = $relatedimage2->id;
    $timber_related_image2->timber_id = $timber->id;
    $timber_related_image2->save();

    $timber_related_image3 = new Timber_Related_Image;
    $timber_related_image3->related_image_id = $relatedimage3->id;
    $timber_related_image3->timber_id = $timber->id;
    $timber_related_image3->save();

    $attributes_obj = array();

    foreach ($attributes as $attribute) {
      $attr = Attribute::findByName($attribute);
      $attributes_obj[] = $attr;
    }

    foreach ($attributes_obj as $attribute_obj) {
      $timber_attribute = new Timber_Attribute;
      $timber_attribute->attribute_id = $attribute_obj->id;
      $timber_attribute->timber_id = $timber->id;
      $timber_attribute->save();
    }


    $request->session()->set("flash_message", "The timber product was successfully added to the database");
    $request->session()->set("flash_message_class", "alert-info");
    $request->session()->forget("flash_data");
    $request->session()->forget("flash_errors");

    $request->redirect("/views" . "/" . $role . "/home.php");
  } else {
    $request->session()->set("flash_message", "Please submit the form correctly.");
    $request->session()->set("flash_message_class", "alert-warning");
    $request->session()->set("flash_data", $request->all());
    $request->session()->set("flash_errors", $request->errors());
    $request->redirect("/views" . "/" . $role . "/timber-create.php");
  }
} catch (Exception $ex) {
  $request->session()->set("flash_message", $ex->getMessage());
  $request->session()->set("flash_message_class", "alert-warning");
  $request->session()->set("flash_data", $request->all());
  $request->session()->set("flash_errors", $request->errors());
  $request->redirect("/views" . "/" . $role . "/timber-create.php");
}
