<?php

require_once "db_connect.php";
if(!isset($_REQUEST['table'])){
    die("Нет нужных параметров");
}
switch ($_REQUEST['table']){
    case 'subdivision': #Добавление подразделения
        $sql="INSERT INTO `subdivision`(`number`,`name`) VALUES (?, ?)";
        $params = [$_REQUEST['number'], $_REQUEST['name']];
        break;
    case 'building': #Добавление здания
        $sql="INSERT INTO `building`(`building_number`,`building_name`) VALUES (?, ?)";
        $params = [$_REQUEST['number'], $_REQUEST['name']];
        break;
    case 'teachers':
        $sql="INSERT INTO `teachers`(`FIO`,`subdivision_number`) VALUES (?, ?)";
        $params = [$_REQUEST['FIO'], $_REQUEST['subdivision']];
        break;
    case 'audience':
        $subdiv = null;
        if($_REQUEST['subdivision'])
            $subdiv = $_REQUEST['subdivision'];
        $sql="INSERT INTO `audience`(`number`,`building_number`,`subdivision_number`, `isusing`) VALUES (?, ?, ?, ?)";
        $params = [$_REQUEST['number'],$_REQUEST['building'], $subdiv, 0];
        break;
    case 'equipment':
        $audience_num = null;
        $building_num = null;
        $image = null;
        if($_REQUEST['audience']){
            $audience = explode('-', $_REQUEST['audience']);
            $audience_num = $audience[0];
            $building_num = $audience[1];
        }
        
        if(!empty($_FILES['image']['tmp_name']) && trim($_FILES['image']['tmp_name']) != ""){
            $image = file_get_contents($_FILES['image']['tmp_name']);
            $sql="INSERT INTO `equipment`(`name`,`audiance_number`,`building_number`,`image`) VALUES (?, ?, ?, ?)";
            $params = [$_REQUEST['name'], $audience_num, $building_num, $image];
        }
            
        break;
}
$stmt = $db->prepare($sql);
$stmt->execute($params);

header("Location: ../insert_view.php");