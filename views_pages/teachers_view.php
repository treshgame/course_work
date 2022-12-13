<?php 
    require_once "../header.php";
    $sql = "SELECT * FROM `teachers`";
    $teachers = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<section class="view">
    <h1 class="view__header">Преподаватели</h1>
    <div class="container">
    <?
        foreach ($teachers as $teacher) {?>
            <form action="../php/update_in_db.php?table=teachers&id=<?=$teacher['id']?>" class="view__form" method="post">
                <div class="mb-3">
                    <label>ФИО</label>
                    <input type="text" name="name" value="<?=$teacher['FIO']?>">
                </div>
                <div class="mb-3 form-item">
                    <label for="" class="form-label">Подразделение</label>
                    <select name="subdivision" class="form-select">
                        <option value=""><option>
                        <?php 
                        $sql = "SELECT * FROM `subdivision`";
                        $subs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                        foreach($subs as $sub){?>
                            <option value="<?=$sub['number']?>" <?if($sub['number'] == $teacher['subdivision_number']) echo "selected";?>>
                                <?="Подразделение: ".$sub['name']?>
                            <option>
                        <?}?>
                    </select>
                </div>
                <div class="btns_block">
                    <input type="submit" name="submit" value="Обновить" class="btn btn-primary">
                    <a href="../php/delete_from_db.php?table=teachers&id=<?=$teacher['id']?>" class="btn btn-danger">Удалить</a>
                </div>
            </form>  
        <?}
    ?>
    </div>
    
</section>
<?php 
    require_once "../footer.php";
?>