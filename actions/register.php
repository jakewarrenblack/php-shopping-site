<?php require_once '../config.php'; ?>
<?php

use BookWorms\Model\User;
use BookWorms\Model\Role;

try {
  $role = [
    "1",  "2", "3", "4"
  ];

  $rules = [
    "email" => "present|email|minlength:7|maxlength:64",
    "password" => "present|minlength:8|maxlength:64",
    "name" => "present|minlength:4|maxlength:64",
    "role" => "present|in:" . implode(',', $role)
  ];
  $request->validate($rules);

  if ($request->is_valid()) {
    $email = $request->input("email");
    $password = $request->input("password");
    $name = $request->input("name");
    $role_id = $request->input("role");
    $user = User::findByEmail($email);
    if ($user !== null) {
      $request->set_error("email", "Email address is already registered");
    } else {
      $user = new User();
      $user->email = $email;
      $user->password = password_hash($password, PASSWORD_DEFAULT);
      $user->name = $name;
      $user->role_id = $role_id;
      $user->save();
    }
  }
} catch (Exception $ex) {
  $request->session()->set("flash_message", $ex->getMessage());
  $request->session()->set("flash_message_class", "alert-warning");
  $request->session()->set("flash_data", $request->all());
  $request->session()->set("flash_errors", $request->errors());

  $request->redirect("/views/auth/register-form.php");
}

if ($request->is_valid()) {
  //find the role of the user, we pass whatever role_id was received from the form
  $role = Role::findById($user->role_id);

  $request->session()->set('email', $user->email);
  $request->session()->set('name', $user->name);
  $request->session()->set('role', $role->title);
  $request->session()->forget("flash_data");
  $request->session()->forget("flash_errors");

  //get the title from the role so we can rediret to the homepage for that title
  $request->redirect("/views" . "/" . $role->title . "/home.php");
} else {
  $request->session()->set("flash_data", $request->all());
  $request->session()->set("flash_errors", $request->errors());

  $request->redirect("/views/auth/register-form.php");
}
?>