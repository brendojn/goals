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



        <?php if (isset($evaluates['performance'])) : ?>
            <div class="form-group">
                <div class="title">
                    <label for="text">Competências a recuperar</label><br/>
                </div>
                <?php if ($evaluates['performance'] < 6) : ?>
                    <label class="radio-inline"><input type="radio" name="skill" value="Performance"/>Testes de Performance</label>
                <?php endif; ?>
                <?php if ($evaluates['safety'] < 6) : ?>
                    <label class="radio-inline"><input type="radio" name="skill" value="Segurança"/>Testes de Segurança</label>
                <?php endif; ?>
                <?php if ($evaluates['usability'] < 6) : ?>
                    <label class="radio-inline"><input type="radio" name="skill" value="Usabilidade"/>Testes de Usabilidade</label>
                <?php endif; ?>
                <?php if ($evaluates['git'] < 6) : ?>
                    <label class="radio-inline"><input type="radio" name="skill" value="Git"/>Conhecimento em git</label>
                <?php endif; ?>
                <?php if ($evaluates['story'] < 6) : ?>
                    <label class="radio-inline"><input type="radio" name="skill" value="Revisão de Estórias"/>Revisão de histórias</label>
                <?php endif; ?>
                <?php if ($evaluates['api'] < 6) : ?>
                    <label class="radio-inline"><input type="radio" name="api" value="Api"/>Testes de api</label>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="task">Título:</label>
            <input type="text" name="title" id="title" class="form-control"/>
        </div>

        <div class="form-group">
            <label for="description">Detalhe do plano:</label>
            <textarea class="form-control" rows="5" id="description" name="description"></textarea>
        </div>

        <div class="form-group">
            <label for="employee">Especialista:</label>
            <select name="employee" id="employee" class="form-control">
                <?php
                foreach ($employees as $employee):
                    ?>
                    <option value="<?php echo $employee['id']; ?>"><?php echo $employee['name']; ?></option>
                <?php
                endforeach;
                ?>
            </select>
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