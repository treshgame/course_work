<?php require_once "header.php"; ?>
<section class="insert_main">
    <!-- ДОБАВЛЕНИЕ ПОДРАЗДЕЛЕНИЯ -->
    <div class="insert_main__block">
        <h2 class="insert_main__block__header">Добавление подразделения</h2>
        <form action="php/insert_in_db.php?table=subdivision" method="post">
            <div class="mb-3 form-item">
                <label for="" class="form-label">Номер подразделения</label>
                <input type="number" name="number" class="form-control" required>
            </div>
            <div class="mb-3 form-item">
                <label for="" class="form-label">Название подразделения</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            
            <input type="submit" name="submit">
        </form>    
    </div>
    <!-- ДОБАВЛЕНИЕ ЗДАНИЯ -->
    <div class="insert_main__block">
        <h2 class="insert_main__block__header">Добавление корпус</h2>
        <form action="php/insert_in_db.php?table=building" method="post">
            <div class="mb-3 form-item">
                <label for="" class="form-label">Номер здания</label>
                <input type="number" name="number" class="form-control" required>
            </div>
            <div class="mb-3 form-item">
                <label for="" class="form-label">Название здания</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <input type="submit" name="submit">
        </form>    
    </div>
    <!-- ДОБАВЛЕНИЕ ПРЕПОДАВАТЕЛЯ -->
    <div class="insert_main__block">
        <h2 class="insert_main__block__header">Добавление преподавателя</h2>
        <form action="php/insert_in_db.php?table=teachers" method="post">
            <div class="mb-3 form-item">
                <label for="" class="form-label">ФИО преподавателя</label>
                <input type="text" name="FIO" class="form-control" required>
            </div>
            <div class="mb-3 form-item">
                <label for="" class="form-label">Подразделение</label>
                <select name="subdivision" class="form-select" required>
                    <option value="" selected><option>
                    <?php 
                    $sql = "SELECT * FROM `subdivision`";
                    $subdivs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                    foreach($subdivs as $subdiv){?>
                        <option value="<?=$subdiv['number']?>"><?=$subdiv['name']?><option>
                    <?}?>
                </select>
            </div>
            
            <input type="submit" name="submit">
        </form>    
    </div>
    <!-- ДОБАВЛЕНИЕ ОБОРУДОВАНИЯ -->
    <div class="insert_main__block">
        <h2 class="insert_main__block__header">Добавление оборудования</h2>
        <form action="php/insert_in_db.php?table=equipment" method="post" enctype='multipart/form-data'>
            <div class="mb-3 form-item">
                <label for="" class="form-label">Название оборудования</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3 form-item">
                <label for="" class="form-label">Аудитория</label>
                <select name="audience" class="form-select">
                    <option value="" selected><option>
                    <?php 
                    $sql = "SELECT * FROM `audience`";
                    $auds = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                    foreach($auds as $aud){?>
                        <option value="<?=$aud['number']?>-<?=$aud['building_number']?>"><?="Аудитори: ".$aud['number']?> <?="Корпус: ".$aud['building_number']?><option>
                    <?}?>
                </select>
            </div>
            <div class="mb-3 form-item">
                <label for="" class="form-label">Фотография</label>
                <input type="file" name="image" id="file" accept="gif|jpg|jpeg|png" class="form-control">
            </div>
            <input type="submit" name="submit">
        </form>    
    </div>
    <!-- ДОБАВЛЕНИЕ АУДИТОРИИ -->
    <div class="insert_main__block">
        <h2 class="insert_main__block__header">Добавление аудитории</h2>
        <form action="php/insert_in_db.php?table=audience" method="post" >
            <div class="mb-3 form-item">
                <label for="" class="form-label">Номер аудитории</label>
                <input type="text" name="number" class="form-control" required>
            </div>
            <div class="mb-3 form-item">
                <label for="" class="form-label">Корпус</label>
                <select name="building" class="form-select" required>
                    <option value="" selected><option>
                    <?php 
                    $sql = "SELECT * FROM `building`";
                    $subdivs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                    foreach($subdivs as $subdiv){?>
                        <option value="<?=$subdiv['building_number']?>"><?=$subdiv['building_name']?><option>
                    <?}?>
                </select>
            </div>
            <div class="mb-3 form-item">
                <label for="" class="form-label">Подразделение</label>
                <select name="subdivision" class="form-select">
                    <option value="" selected><option>
                    <?php 
                    $sql = "SELECT * FROM `subdivision`";
                    $subdivs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                    foreach($subdivs as $subdiv){?>
                        <option value="<?=$subdiv['number']?>"><?=$subdiv['name']?><option>
                    <?}?>
                </select>
            </div>
            <input type="submit" name="submit">
        </form>    
    </div>
</section>
<?php require_once "footer.php"; ?>