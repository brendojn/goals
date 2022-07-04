<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Tarefas - Editar Tarefa</h1>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="task">Nome da Tarefa:</label>
            <input type="text" name="task" id="task" class="form-control" value="<?php echo $getTask['task']; ?>"
                   disabled/>
        </div>
        <div class="form-group">
            <label for="employee">Especialista:</label>
            <select name="employee" id="employee" class="form-control">
                <?php
                foreach ($employees as $employee):
                    ?>
                    <option value="<?php echo $employee['id']; ?>"
                        <?php echo $getTask['id'] == $employee['id'] ? 'selected' : ''; ?> ><?php echo utf8_encode($employee['name']); ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>

        <div class="form-group">
            <div class="radio">
                <label for="complexity">Complexidade:</label><br/>
                <?php
                foreach ($complexities as $complexity):
                    ?>
                    <label><input type="radio" name="complexity"
                                  value="<?php echo $complexity['id']; ?>"
                            <?php echo $getTask['id_complexity'] == $complexity['id'] ? 'checked="checked"' : ''; ?> > <?php echo utf8_encode($complexity['fibonacci']); ?>
                    </label>
                <?php
                endforeach;
                ?>
            </div>
        </div>
        <br/>

        <input type="submit" value="Editar" class="btn btn-default"/>
    </form>

</div>

