<?php 
    require_once "../header.php";
    $sql = "SELECT * FROM `building`";
    $builds = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<section class="view">
    <h1 class="view__header">Здания</h1>
    <div class="container">
    <?
        foreach ($builds as $build) {?>
            <form action="../php/update_in_db.php?table=building&old_number=<?=$build['building_number']?>" class="view__form" method="post">
                <div class="mb-3 form-item">
                    <label class="form-label">Номер здания</label>
                    <input class="form-control" type="text" name="number" value="<?=$build['building_number']?>">
                </div>
                <div class="mb-3 form-item">
                    <label class="form-label">Название здания</label>
                    <input class="form-control" type="text" name="name" value="<?=$build['building_name']?>">
                </div>
                <div class="btns_block">
                    <input type="submit" name="submit" value="Обновить" class="btn btn-primary">
                    <a href="../php/delete_from_db.php?table=building&number=<?=$build['building_number']?>" class="btn btn-danger">Удалить</a>
                </div>
            </form>  
        <?}
    ?>
    </div>
    
</section>
<?php 
    require_once "../footer.php";
?>