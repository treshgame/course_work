<?php 
    require_once "../header.php";
    $sql = "SELECT * FROM `equipment`";
    $equips = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<section class="view">
    <h1 class="view__header">Оборудование</h1>
    <div class="container">
    <?
        foreach ($equips as $equip) {?>
            <form action="../php/update_in_db.php?table=equipment&id=<?=$equip['id']?>" class="view__form" method="post">
                <div class="mb-3">
                    <label class="form-label">Название</label>
                    <input class="form-control" type="text" name="name" value="<?=$equip['name']?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Аудитория</label>
                    <select name="audience" class="form-select">
                        <option value=""><option>
                        <?php 
                        $sql = "SELECT * FROM `audience`";
                        $auds = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                        foreach($auds as $aud){?>
                            <option value="<?=$aud['number']?>-<?=$aud['building_number']?>" <?if($equip['building_number'] == $aud['building_number'] && $equip['audiance_number'] == $aud['number']) echo "selected";?>>
                                <?="Аудитори: ".$aud['number']?> <?="Корпус: ".$aud['building_number']?>
                            <option>
                        <?}?>
                    </select>
                </div>
                <div class="btns_block">
                    <input type="submit" name="submit" value="Обновить" class="btn btn-primary">
                    <a href="../php/delete_from_db.php?table=equipment&id=<?=$equip['id']?>" class="btn btn-danger">Удалить</a>
                </div>
            </form>  
        <?}
    ?>
    </div>
    
</section>
<?php 
    require_once "../footer.php";
?>