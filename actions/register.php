<?php
require_once '../config.php';

use BookWorms\Model\User;
use BookWorms\Model\Role;
use BookWorms\Model\Customer;
use BookWorms\Model\Image;
use BookWorms\Model\FileUpload;

try {
  $rules = [
    "email" => "present|email|minlength:7|maxlength:64",
    "password" => "present|minlength:8|maxlength:64",
    "name" => "present|minlength:4|maxlength:64",
    "address" => "present|minlength:8|maxlength:64",
    /*Needs 2-3 digits, followed by a heifen, followed by 5-7 more digits.*/
    "phone" => "present|match:/\A[0-9]{2,3}[-][0-9]{5,7}\Z/"
  ];
  $request->validate($rules);
  if (!$request->is_valid()) {
    throw new Exception("Please complete the form correctly.");
  }

  $email = $request->input("email");
  $password = $request->input("password");
  $name = $request->input("name");
  $address = $request->input("address");
  $phone = $request->input("phone");

  $user = User::findByEmail($email);
  if ($user !== null) {
    throw new Exception("Email address is already registered");
  }
  $customer = Customer::findByPhone($phone);
  if ($customer !== null) {
    throw new Exception("Phone number is already registered.");
  }


  $image = null;

  if (FileUpload::exists('profile')) {
    $file = new FileUpload("profile");
    $filename = $file->get();
    $image = new Image();
    $image->filename = $filename;
    $image->save();
  }


  $role = Role::findByTitle("customer");
  $user = new User();
  $user->email = $email;
  $user->password = password_hash($password, PASSWORD_DEFAULT);
  $user->name = $name;
  $user->role_id = $role->id;
  $user->save();

  $customer = new Customer();
  $customer->address = $address;
  $customer->phone = $phone;
  $customer->user_id = $user->id;
  if ($image != null) {
    $customer->image_id = $image->id;
  }
  $customer->save();

  $request->session()->set('email', $user->email);
  $request->session()->set('name', $user->name);
  $request->session()->set('role', $role->title);
  $request->session()->forget("flash_data");
  $request->session()->forget("flash_errors");

  $request->redirect("/views" . "/" . $role->title . "/home.php");
} catch (Exception $ex) {
  $request->session()->set("flash_message", $ex->getMessage());
  $request->session()->set("flash_message_class", "alert-warning");
  $request->session()->set("flash_data", $request->all());
  $request->session()->set("flash_errors", $request->errors());
  $request->redirect("/views/auth/register-login-form.php");
}
