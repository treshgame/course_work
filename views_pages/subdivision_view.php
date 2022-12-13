<?php 
    require_once "../header.php";
    $sql = "SELECT * FROM `subdivision`";
    $subs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<section class="view">
    <h1 class="view__header">Подразделения</h1>
    <div class="container">
    <?
        foreach ($subs as $sub) {?>
            <form action="../php/update_in_db.php?table=subdivision&old_number=<?=$sub['number']?>" method="post" class="view__form">
                <div class="mb-3">
                    <label class="form-label">Номер подразделения</label>
                    <input class="form-control" type="text" name="number" value="<?=$sub['number']?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Название подразделения</label>
                    <input class="form-control" type="text" name="name" value="<?=$sub['name']?>">
                </div>
                <div class="btns_block">
                    <input type="submit" name="submit" value="Обновить" class="btn btn-primary">
                    <a href="../php/delete_from_db.php?table=subdivision&number=<?=$sub['number']?>" class="btn btn-danger">Удалить</a>
                </div>
            </form>  
        <?}
    ?>
    </div>
</section>
<?php 
    require_once "../footer.php";
?>