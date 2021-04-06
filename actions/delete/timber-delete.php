<?php require_once '../../config.php'; ?>
<?php
    use BookWorms\Model\Timber;
    try {
    $rules = [
        'timber_id' => 'present'
    ];
    $request->validate($rules);
    if (!$request->is_valid()) {
        throw new Exception("Illegal request!");
    }
    $timber_id = $request->input('timber_id');
    $timber = Timber::findById($timber_id);
    if ($timber === null) {
        throw new Exception("Illegal request parameter");
    }

    $timber->delete();

    $request->session()->set("flash_message", "The timber product was successfully deleted from the database");
    $request->session()->set("flash_message_class", "alert-info");
    $request->redirect("/index.php");
    } catch (Exception $ex) {
    $request->session()->set("flash_message", $ex->getMessage());
    $request->session()->set("flash_message_class", "alert-warning");
    $request->redirect("/index.php");
    }
?>