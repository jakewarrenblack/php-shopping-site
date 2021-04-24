<?php
require_once '../config.php';

use BookWorms\Model\Timber;
use BookWorms\Model\Image;
use BookWorms\Model\Related_Image;
use BookWorms\Model\Timber_Related_Image;
use BookWorms\Model\FileUpload;
use BookWorms\Model\Attribute;
use BookWorms\Model\Timber_Attribute;

try {
    $categories = [
        "1", "2"
    ];

    $attributes = array();

    $attr = Attribute::findAll();
    foreach ($attr as $at) {
        $attributes[] = $at->name;
    }

    if ($request->is_logged_in()) {
        $role = $request->session()->get("role");
    }

    $rules = [
        "title" => "present|minlength:2|maxlength:64",
        "description" => "present|minlength:10|maxlength:2000",
        "price" => "present|minlength:1|maxlength:2000",
        "category_id" => "present|minlength:1|maxlength:1000",
        "minimum_order" => "present|minlength:1|maxlength:2000"
    ];

    $request->validate($rules);
    if ($request->is_valid()) {
        $attributes = null;
        if ($request->input("attributes") != null) {
            $attributes = $request->input("attributes");
            if (count($attributes) > 2) {
                $request->session()->set("flash_message", "Please select a maximum of 2 attributes.");
                $request->session()->set("flash_message_class", "alert-warning");
                $request->session()->set("flash_data", $request->all());
                $request->session()->set("flash_errors", $request->errors());
                $request->redirect("/views" . "/" . $role . "/timber-create.php");
            }
            $existing_attributes = Timber_Attribute::findByTimberId($request->input("timber_id"));
            // our existing attributes are wiped clean, so we can insert the newly selected attributes
            foreach ($existing_attributes as $existing_attribute) {
                $existing_attribute->delete();
            }
        }

        $image = null;
        $relatedimage1 = null;
        $relatedimage2 = null;
        $relatedimage3 = null;
        $relatedimage4 = null;
        if (FileUpload::exists('profile')) {
            $file = new FileUpload("profile");
            $filename = $file->get();
            $image = new Image();
            $image->filename = $filename;
            $image->save();
        }
        if (FileUpload::exists('related_image_1')) {
            $related1 = new FileUpload("related_image_1");
            $relatedfilename1 = $related1->get();
            $relatedimage1 = new Related_Image();
            $relatedimage1->filename = $relatedfilename1;
            $relatedimage1->save();
        }
        if (FileUpload::exists('related_image_2')) {
            $related2 = new FileUpload("related_image_2");
            $relatedfilename2 = $related2->get();
            $relatedimage2 = new Related_Image();
            $relatedimage2->filename = $relatedfilename2;
            $relatedimage2->save();
        }
        if (FileUpload::exists('related_image_3')) {
            $related3 = new FileUpload("related_image_3");
            $relatedfilename3 = $related3->get();
            $relatedimage3 = new Related_Image();
            $relatedimage3->filename = $relatedfilename3;
            $relatedimage3->save();
        }
        if (FileUpload::exists('related_image_4')) {
            $related4 = new FileUpload("related_image_4");
            $relatedfilename4 = $related4->get();
            $relatedimage4 = new Related_Image();
            $relatedimage4->filename = $relatedfilename4;
            $relatedimage4->save();
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

        if ($relatedimage1 != null) {
            $timber_related_image1 = new Timber_Related_Image;
            $timber_related_image1->related_image_id = $relatedimage1->id;
            $timber_related_image1->timber_id = $timber->id;
            $timber_related_image1->save();
        }
        if ($relatedimage2 != null) {
            $timber_related_image2 = new Timber_Related_Image;
            $timber_related_image2->related_image_id = $relatedimage2->id;
            $timber_related_image2->timber_id = $timber->id;
            $timber_related_image2->save();
        }
        if ($relatedimage3 != null) {
            $timber_related_image3 = new Timber_Related_Image;
            $timber_related_image3->related_image_id = $relatedimage3->id;
            $timber_related_image3->timber_id = $timber->id;
            $timber_related_image3->save();
        }
        if ($relatedimage4 != null) {
            $timber_related_image4 = new Timber_Related_Image;
            $timber_related_image4->related_image_id = $relatedimage4->id;
            $timber_related_image4->timber_id = $timber->id;
            $timber_related_image4->save();
        }

        if ($attributes != null) {
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
        }

        $request->session()->set("flash_message", "The timber product was successfully updated in the database");
        $request->session()->set("flash_message_class", "alert-info");
        /*Forget any data that's already been stored in the session.*/
        $request->session()->forget("flash_data");
        $request->session()->forget("flash_errors");
        $request->redirect("/index.php");
    } else {
        $timber_id = $request->input("timber_id");
        $request->session()->set("flash_data", $request->all());
        $request->session()->set("flash_errors", $request->errors());
        $request->redirect("../views/admin/products/timber-edit.php?timber_id=" . $timber_id);
    }
} catch (Exception $ex) {
    $request->session()->set("flash_message", $ex->getMessage());
    $request->session()->set("flash_message_class", "alert-warning");
    $request->session()->set("flash_data", $request->all());
    $request->session()->set("flash_errors", $request->errors());

    $request->redirect("/index.php");
}
