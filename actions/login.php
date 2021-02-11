<?php require_once '../config.php'; ?>
<?php

use BookWorms\Model\User;
use BookWorms\Model\Role;

if ($request->is_logged_in()) {
  $role = $request->session()->get("role");
  $request->redirect("/views"."/".$role."/home.php");
}
try {
  $rules = [
    "email" => "present|email|minlength:7|maxlength:64",
    "password" => "present|minlength:6|maxlength:64"
  ];
  $request->validate($rules);
  if (!$request->is_valid()) {
    throw new Exception("Please complete the form");
  }
  $email = $request->input("email");
  $password = $request->input("password");
  $user = User::findByEmail($email);
  if ($user === null) {
    throw new Exception("Email/password invalid");
  }
  else if ($user !== null) {
    if (!password_verify($password, $user->password)) {
      throw new Exception("Email/password invalid");
    }
  }
  $role = Role::findById($user->role_id);

  $request->session()->set('email', $user->email);
  $request->session()->set('name', $user->name);
  $request->session()->set('role', $role->title);
  $request->session()->forget("flash_data");
  $request->session()->forget("flash_errors");


  $request->redirect("/views"."/".$role->title."/home.php");  
}
catch (Exception $ex) {
  $request->session()->set("flash_message", $ex->getMessage());
  $request->session()->set("flash_message_class", "alert-warning");
  $request->session()->set("flash_data", $request->all());
  $request->session()->set("flash_errors", $request->errors());

  $request->redirect("/views/auth/login-form.php");  
}
?>