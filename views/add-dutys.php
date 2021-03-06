<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Plantão - Adicionar Plantão</h1>

    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="week">Semana</label>
            <input class="form-control" name="week" type="week" value="2021-W33" id="week">
        </div>
        <div class="form-group">
            <label for="employee">QA:</label>
            <select name="employee" id="employee" class="form-control">
                <?php
                foreach ($employees as $employee):
                    ?>
                    <option value="<?php echo $employee['id']; ?>"><?php echo utf8_encode($employee['name']); ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>

        <br/>

        <input type="submit" value="Adicionar" class="btn btn-default"/>
    </form>

</div>