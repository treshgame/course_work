<?php

require_once "db_connect.php";
if(!isset($_REQUEST['submit'])){
    die("Нет нужных параметров");
}
switch ($_REQUEST['table']){
    case 'subdivision': #Добавление подразделения
        $sql="INSERT INTO `subdivision`(`number`,`name`) VALUES (?, ?)";
        $params = [$_REQUEST['number'], $_REQUEST['name']];
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        break;
    case 'building': #Добавление здания
        $sql="INSERT INTO `building`(`building_number`,`building_name`) VALUES (?, ?)";
        $params = [$_REQUEST['number'], $_REQUEST['name']];
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        break;
    case 'teachers':
        $sql="INSERT INTO `teachers`(`FIO`,`subdivision_number`) VALUES (?, ?)";
        $params = [$_REQUEST['FIO'], $_REQUEST['subdivision']];
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        break;
    case 'audience':
        $subdiv = null;
        if($_REQUEST['subdivision'])
            $subdiv = $_REQUEST['subdivision'];
        $sql="INSERT INTO `audience`(`number`,`building_number`,`subdivision_number`, `isusing`) VALUES (?, ?, ?, ?)";
        $params = [$_REQUEST['number'],$_REQUEST['building'], $subdiv, 0];
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        break;
    case 'equipment':
        $audience_num = null;
        $building_num = null;
        if($_REQUEST['audience']){
            $audience = explode('-', $_REQUEST['audience']);
            $audience_num = $audience[0];
            $building_num = $audience[1];
        }
        $sql="INSERT INTO `equipment`(`name`,`audiance_number`,`building_number`) VALUES (?, ?, ?)";
        $params = [$_REQUEST['name'], $audience_num, $building_num];
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        break;
}
print_r($_REQUEST);

// header("Location: ../insert_view.php");