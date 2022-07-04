<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Adicionar Especialista</h1>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="task">Nome do Especialista:</label>
            <input type="text" name="employee" id="employee" class="form-control"/>
        </div>

        <div class="form-group">
            <label for="task">Tipo de Especialista:</label>
            <select name="type_specialty" id="type_specialty" class="form-control">
                <?php
                foreach ($specialties as $specialty): ?>
                    <option value="<?php echo $specialty['id']; ?>"><?php echo utf8_encode($specialty['name']); ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>

        <input type="submit" value="Adicionar" class="btn btn-default"/>
    </form>

</div>