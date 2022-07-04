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


        <input type="submit" value="Adicionar" class="btn btn-default"/>
    </form>

</div>