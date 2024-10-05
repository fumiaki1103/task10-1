<?php
require_once('common.php');
var_dump($_POST);
exit;

if (isset($_POST["status"])) {
  $id = $_POST["id"] ?? null;
  $name = $_POST["name"] ?? null;
  $age = $_POST["age"] ?? null;
  $work = $_POST["work"] ?? null;
  $old_id = $_POST["old_id"] ?? null;
}

if ($_POST["status"] == "create") {
  if (!check_input($id, $name, $age, $work, $error)) {
    header("Location: syain_create.php?error=" . urlencode($error) . "&name=" . urlencode($name) . "&age=" . urlencode($age) . "&work=" . urlencode($work));
    exit();
  }
  if ($db->idExist($id)) {
    $error = "既に使用されているIDです";
    header("Location: syain_create.php?error=" . urlencode($error) . "&name=" . urlencode($name) . "&age=" . urlencode($age) . "&work=" . urlencode($work));
    exit();
  }
  if (!$db->createSyain($id, $name, $age, $work)) {
    $error = "DBエラー";
    header("Location: syain_create.php?error=" . urlencode($error) . "&name=" . urlencode($name) . "&age=" . urlencode($age) . "&work=" . urlencode($work));
    exit();
  }
  header("Location: index.php");
  exit();
}
?>