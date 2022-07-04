<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Plantão - Editar Plantão</h1>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="week">Semana do plantão:</label>
            <input type="text" name="week" id="week" class="form-control" value="<?php echo $getProject['week']; ?>"
                   disabled/>
        </div>
        <div class="form-group">
            <label for="employee">Especialista:</label>
            <select name="employee" id="employee" class="form-control">
                <?php
                foreach ($employees as $employee):
                    ?>
                    <option value="<?php echo $employee['id']; ?>"
                        <?php echo $getProject['id'] == $employee['id'] ? 'selected' : ''; ?> ><?php echo utf8_encode($employee['name']); ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>

        <br/>

        <input type="submit" value="Editar" class="btn btn-default"/>
    </form>

</div>

