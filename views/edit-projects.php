<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Avaliação - Editar Avaliação</h1>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="week">Período de avaliação:</label>
            <input type="text" name="week" id="week" class="form-control" value="<?php echo $getProject['week']; ?>"/>
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
                    <option value="<?php echo $employee['id']; ?>"
                        <?php echo $getProject['id'] == $employee['id'] ? 'selected' : ''; ?> ><?php echo $employee['name']; ?></option>
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
                    <option value="<?php echo $employee['fk_user_id']; ?>"
                    <?php echo $getProject['evaluator_id'] == $employee['fk_user_id'] ? 'selected' : '';  ?> ><?php echo $employee['name']; ?></option>
                <?php endif; ?>
                <?php
                endforeach;
                ?>
            </select>
        </div>

        <?php if (!empty($getProject['evaluate']) ) : ?>
        <div class="form-group">
            <label for="value">Justificativa:</label>
            <textarea class="form-control" rows="5" id="justification" name="justification"><?php echo $getProject['justification']; ?></textarea>
        </div>
        <?php endif; ?>


        <br/>

        <input type="submit" value="Editar" class="btn btn-default"/>
    </form>

</div>

