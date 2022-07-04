<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Adicionar Produtividade</h1>

    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="week">Semana</label>
            <input class="form-control" name="week" type="text"  id="week">
            <script type="text/javascript">
                $(function() {
                    $('input[name="week"]').daterangepicker( {
                        locale: {
                            format: 'DD/MM/YYYY'
                        }
                    });
                });
            </script>
        </div>
        <div class="form-group">
            <label for="employee">Especialista:</label>
            <select name="employee" id="employee" class="form-control">
                <?php
                foreach ($employees as $employee):
                    ?>
                <?php if ($employee['squad_lead'] === NULL) : ?>
                    <option value="<?php echo $employee['id']; ?>"><?php echo utf8_encode($employee['name']); ?></option>
                <?php endif; ?>
                <?php
                endforeach;
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="evaluator">Avaliador:</label>
            <select name="evaluator" id="evaluator" class="form-control">
                <?php
                foreach ($employees as $employee):
                    ?>
                <?php if ($employee['squad_lead'] !== NULL || $employee['chapter_lead'] !== NULL || $employee['rh'] !== NULL || $employee['po'] !== NULL) : ?>
                    <option value="<?php echo $employee['id']; ?>"><?php echo utf8_encode($employee['name']); ?></option>
                <?php endif; ?>
                <?php
                endforeach;
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="type">Tipo de avaliação:</label>
            <select name="type" id="type" class="form-control">
                <?php
                foreach ($evaluates as $evaluate):
                ?>
                    <option value="<?php echo $evaluate['id'] ?>"><?php echo $evaluate['name']?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>

        <br/>

        <input type="submit" value="Adicionar" class="btn btn-default"/>
    </form>

</div>