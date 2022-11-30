<?php
require_once "db_connect.php";

if(!isset($_REQUEST['table'])){
    die("Нет нужных параметров");
}
$location = "../index.php";
switch($_REQUEST['table']){
    case "building":
        $sql = "DELETE FROM `building` WHERE `building_number`= ?";
        $params = [$_REQUEST['number']];
        $location = '../views_pages/building_view.php';
        break;
    case "equipment":
        $sql = "DELETE FROM `equipment` WHERE `id`=?";
        $params = [$_REQUEST['id']];
        $location = '../views_pages/equipment_view.php';
        break;
    case "subdivision":
        $sql = "DELETE FROM `subdivision` WHERE `number`= ?";
        $params = [$_REQUEST['number']];
        $location = "../views_pages/subdivision_view.php";
        break;
    case "teachers":
        $sql = "DELETE FROM `teachers` WHERE `id`=?";
        $params = [$_REQUEST['id']];
        $location = "../views_pages/teachers_view.php";
        break;
    case "audience":
        $sql = "DELETE FROM `audience` WHERE `number`=? AND `building_number`=?";
        $params = [$_REQUEST['aud_number'], $_REQUEST['build_number']];
        $location = "../views_pages/audience_view.php";
        break;
}

$stmt = $db->prepare($sql);
$stmt->execute($params);

header("Location: $location");
?>