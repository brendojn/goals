<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Plano de estudo - Informações</h1>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="title">Título:</label>
            <input type="text" name="title" id="title" class="form-control" value="<?php echo $plans['title']; ?>"
                   disabled/>
        </div>

        <div class="form-group">
            <label for="description">Detalhe do Plano:</label>
            <textarea class="form-control" rows="5" id="description" name="description" disabled><?php echo $plans['description'] ?></textarea>
        </div>

        <div class="form-group">
            <label for="value">Status:</label>
            <input type="text" name="status" id="status" class="form-control"
                   value="<?php echo $plans['status'] ?>"
                   disabled/>
        </div>

            <div class="form-group">
                <label for="dueDate">Data de Vencimento:</label>
                <input type="text" name="dueDate" id="dueDate" class="form-control"
                       value="<?php echo $plans['due_date'] ?>"
                       disabled/>
            </div>

        <br/>

    </form>

</div>