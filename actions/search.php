<?php
require_once '../config.php';

use BookWorms\Model\Timber;

try {
if(!isset($_GET['clear'])){
  $rules = [
    "searchQuery" => "present|maxlength:64",
  ];

  $request->validate($rules);
  if (!$request->is_valid()) {
    throw new Exception("Invalid search term.");
  }

  $searchQuery = $request->input("searchQuery");

  $timbers = Timber::search($searchQuery);

  $timber_ids = array();

  foreach($timbers as $timber){
      array_push($timber_ids,$timber->id);
  };

  if(count($timber_ids)!==0){
    $_SESSION['search_results'] = $timber_ids;
    $request->redirect("/views/shop.php#scroll-here");
  }
  else{
    throw new Exception("No results found for this query.");
  }


}
else{
    $_SESSION['search_results'] = null;
    $request->redirect("/views/shop.php#scroll-here");
}

} catch (Exception $ex) {
  $request->session()->set("flash_message", $ex->getMessage());
  $request->session()->set("flash_message_class", "alert-warning");
  $request->session()->set("flash_data", $request->all());
  $request->session()->set("flash_errors", $request->errors());
  $request->redirect("/views/shop.php");
}
