<?php
require_once '../config.php';
use BookWorms\Model\Customer;
use BookWorms\Model\User;
use BookWorms\Model\Role;
use BookWorms\Model\Image;
use BookWorms\Model\FileUpload;

try {
    $rules = [
        "customer_id" => "present|integer|minlength:1",
        "email" => "present|email|minlength:7|maxlength:64",
        "name" => "present|minlength:4|maxlength:64",
        "address" => "present|minlength:8|maxlength:64",
        /*Needs 2-3 digits, followed by a heifen, followed by 5-7 more digits.*/
        "phone" => "present|match:/\A[0-9]{2,3}[-][0-9]{5,7}\Z/"
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

        $customer = Customer::findById($request->input("customer_id"));

        $role = Role::findByTitle("customer");
        $user = User::findById($customer->user_id);
        $user->email = $request->input("email");
        $user->name = $request->input("name");
        $user->role_id = $role->id;


        $customer->address = $request->input("address");
        $customer->phone = $request->input("phone");
        $customer->user_id = $user->id;
        /*If not null, the user must have uploaded an image, so reset the image id to that of the one we've just uploaded.*/
        if ($image !== null) {
            $customer->image_id = $image->id;
        }

        $user->save();
        $customer->save();

        $request->session()->set("flash_message", "The customer/user was successfully updated in the database");
        $request->session()->set("flash_message_class", "alert-info");
        /*Forget any data that's already been stored in the session.*/
        $request->session()->forget("flash_data");
        $request->session()->forget("flash_errors");
        $request->redirect("/views/admin/home.php");
    } 
    else {
        $customer_id = $request->input("customer_id");
        $request->session()->set("flash_data", $request->all());
        $request->session()->set("flash_errors", $request->errors());
        $request->redirect("/views/admin/home.php");
        
    }
} catch (Exception $ex) {
    $request->session()->set("flash_message", $ex->getMessage());
    $request->session()->set("flash_message_class", "alert-warning");
    $request->session()->set("flash_data", $request->all());
    $request->session()->set("flash_errors", $request->errors());

    $request->redirect("/views/admin/home.php");
}