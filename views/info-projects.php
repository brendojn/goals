<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Recuperação - Informações</h1>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="week">Semana do plantão:</label>
            <input type="text" name="week" id="week" class="form-control" value="<?php echo $project['week']; ?>"
                   disabled/>
        </div>

        <div class="form-group">
            <label for="employee">Avaliado:</label>
            <select name="employee" id="employee" class="form-control" disabled>
                <option selected><?php echo utf8_encode($project['name']); ?></option>
            </select>
        </div>

        <div class="form-group">
            <label for="value">Avaliador:</label>
            <input type="text" name="user_v" id="user_v" class="form-control"
                   value="<?php echo $evaluates['user'] ?>"
                   disabled/>
        </div>

        <div class="form-group">
            <label for="value">Nota:</label>
            <input type="text" name="grade" id="grade" class="form-control"
                   value="<?php echo $project['grade'] ?>"
                   disabled/>
        </div>

        <?php if ($evaluates['justification'] !== '') : ?>
        <div class="form-group">
            <label for="value">Justificativa:</label>
            <textarea class="form-control" rows="5" id="justification" name="justification" disabled><?php echo $evaluates['justification'] ?></textarea>
        </div>
        <?php endif; ?>

        <br/>

    </form>

</div>