<?php
require_once "db_connect.php";

if(!isset($_REQUEST['table'])){
    die("Нет нужных параметров");
}
$location = '../index.php';
switch($_REQUEST['table']){
    case 'subdivision':
        $sql = "UPDATE `subdivision` SET `number` = ?, `name` = ? WHERE `number` = ?";
        $params = [
            $_REQUEST['number'],
            $_REQUEST['name'],
            $_REQUEST['old_number']
        ];
        $location = '../views_pages/subdivision_view.php';
        break;
    case 'building': #Добавление здания
        $sql="UPDATE `building` SET `building_number`=?,`building_name`=? WHERE `building_number`=?";
        $params = [$_REQUEST['number'], $_REQUEST['name'], $_REQUEST['old_number']];
        $location = '../views_pages/building_view.php';
        break;
    case 'teachers':
        $sql="UPDATE `teachers` SET `FIO`=?,`subdivision_number`=? WHERE `id`=?";
        $params = [$_REQUEST['name'], $_REQUEST['subdivision'], $_REQUEST['id']];
        $location = '../views_pages/teachers_view.php';
        break;
    case 'audience':
        $subdiv = null;
        if($_REQUEST['subdivision'])
            $subdiv = $_REQUEST['subdivision'];
        $sql="UPDATE `audience` SET `number`=?,`building_number`=?,`subdivision_number`=?, `isusing`=? WHERE `number`=? AND `building_number`=?";
        $params = [$_REQUEST['number'],$_REQUEST['building'], $subdiv, $_REQUEST['isusing'], $_REQUEST['old_number'], $_REQUEST['old_building']];
        $location = '../views_pages/audience_view.php';
        break;
    case 'equipment':
        $audience_num = null;
        $building_num = null;
        if($_REQUEST['audience']){
            $audience = explode('-', $_REQUEST['audience']);
            $audience_num = $audience[0];
            $building_num = $audience[1];
        }

        $sql="UPDATE `equipment` SET `name`=?, `audiance_number`=?, `building_number`=? WHERE `id`=?";
        $params = [$_REQUEST['name'], $audience_num, $building_num, $_REQUEST['id']];
        if(!empty($_FILES['image']['tmp_name']) && trim($_FILES['image']['tmp_name']) != ""){
            $image = file_get_contents($_FILES['image']['tmp_name']);
            $sql="UPDATE `equipment` SET `name`=?, `audiance_number`=?, `building_number`=?, `image`=? WHERE `id`=?";
            $params = [$_REQUEST['name'], $audience_num, $building_num, $image, $_REQUEST['id']];
        }
        $location = "../views_pages/equipment_view.php";
        break;
}
$stmt = $db->prepare($sql);
$stmt->execute($params);
header("Location: $location");
?>