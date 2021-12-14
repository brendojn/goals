<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>QA - Adicionar Plano de Estudo</h1>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="task">Título:</label>
            <input type="text" name="title" id="title" class="form-control"/>
        </div>

        <div class="form-group">
            <label for="description">Detalhe do plano:</label>
            <textarea class="form-control" rows="5" id="description" name="description"></textarea>
        </div>

        <div class="form-group">
            <label for="due_date">Data de vencimento:</label>
            <input class="form-control" name="due_date" type="text"  id="due_date">
            <script type="text/javascript">
                $(function() {
                    $('input[name="due_date"]').daterangepicker( {
                        singleDatePicker: true,
                        timePicker: true,
                        timePicker24Hour: true,
                        timePickerIncrement: 15,
                        locale: {
                            format: 'DD/MM/YYYY HH:mm'
                        }
                    });
                });
            </script>
        </div>

        <input type="submit" value="Adicionar" class="btn btn-default"/>
    </form>

</div>