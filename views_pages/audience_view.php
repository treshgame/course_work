<?php 
    require_once "../header.php";
    $sql = "SELECT * FROM `audience`";
    $audiences = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<section class="view">
    <h1 class="view__header">Учителя</h1>
    <div class="container">
    <?
        foreach ($audiences as $audience) {?>
            <form action="../php/update_in_db.php?table=audience&old_number=<?=$audience['number']?>&old_building=<?=$audience['building_number']?>" class="view__form" method="post">
                <div class="mb-3">
                    <label>Номер аудитории</label>
                    <input type="text" name="number" value="<?=$audience['number']?>">
                </div>
                <div class="mb-3 form-item">
                    <label for="" class="form-label">Здание</label>
                    <select name="building" class="form-select">
                        <option value=""><option>
                        <?php 
                        $sql = "SELECT * FROM `building`";;
                        $builds = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                        foreach($builds as $build){?>
                            <option value="<?=$build['building_number']?>" <?if($build['building_number'] == $audience['building_number']) echo "selected";?>>
                                <?="Здание: ".$build['building_name']?>
                            <option>
                        <?}?>
                    </select>
                </div>
                <div class="mb-3 form-item">
                    <label for="" class="form-label">Подразделение</label>
                    <select name="subdivision" class="form-select">
                        <option value=""><option>
                        <?php 
                        $sql = "SELECT * FROM `subdivision`";
                        $subs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                        foreach($subs as $sub){?>
                            <option value="<?=$sub['number']?>" <?if($sub['number'] == $audience['subdivision_number']) echo "selected";?>>
                                <?="Подразделение: ".$sub['name']?>
                            <option>
                        <?}?>
                    </select>
                </div>
                <div class="mb-3 form-item">
                    <label for="" class="form-label">Занята</label>
                    <select name="isusing" class="form-select">
                        <option value="0" <?if($audience['isusing'] == 0) echo "selected";?>>Не знанята<option>
                        <option value="1" <?if($audience['isusing'] == 1) echo "selected";?>>Занята<option>
                    </select>
                </div>
                <div class="btns_block">
                    <input type="submit" name="submit" value="Обновить" class="btn btn-primary">
                    <a href="../php/delete_from_db.php?table=audience&aud_number=<?=$audience['number']?>&build_number=<?=$audience['building_number']?>" class="btn btn-danger">Удалить</a>
                </div>
            </form>  
        <?}
    ?>
    </div>
</section>
<?php 
    require_once "../footer.php";
?>