<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Squad - Avaliação Squad</h1>
    <br>
    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <div class="title">
                <label for="text">Colaboração</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="collaboration" value="0"/>Extremamente negativo</label>
            <label class="radio-inline"><input type="radio" name="collaboration" value="3"/>Negativo</label>
            <label class="radio-inline"><input type="radio" name="collaboration" value="6"/>Nem positivo e nem negativo</label>
            <label class="radio-inline"><input type="radio" name="collaboration" value="8"/>Positivo</label>
            <label class="radio-inline"><input type="radio" name="collaboration" value="10"/>Extremamente positivo</label>
        </div>

        <div class="form-group">
            <div class="title">
                <label for="text">Disseminação da qualidade para a squad</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="qa_in_squad" value="0"/>Extremamente negativo</label>
            <label class="radio-inline"><input type="radio" name="qa_in_squad" value="3"/>Negativo</label>
            <label class="radio-inline"><input type="radio" name="qa_in_squad" value="6"/>Nem positivo e nem negativo</label>
            <label class="radio-inline"><input type="radio" name="qa_in_squad" value="8"/>Positivo</label>
            <label class="radio-inline"><input type="radio" name="qa_in_squad" value="10"/>Extremamente positivo</label>
        </div>

        <div class="form-group">
            <div class="title">
                <label for="text">Comunicação</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="communication" value="0"/>Extremamente negativo</label>
            <label class="radio-inline"><input type="radio" name="communication" value="3"/>Negativo</label>
            <label class="radio-inline"><input type="radio" name="communication" value="6"/>Nem positivo e nem negativo</label>
            <label class="radio-inline"><input type="radio" name="communication" value="8"/>Positivo</label>
            <label class="radio-inline"><input type="radio" name="communication" value="10"/>Extremamente positivo</label>
        </div>

        <div class="form-group">
            <div class="title">
            <label for="text">Bugs de alto impacto na sua squad em prod?</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="bugs" value="0"/>Extremamente negativo</label>
            <label class="radio-inline"><input type="radio" name="bugs" value="3"/>Negativo</label>
            <label class="radio-inline"><input type="radio" name="bugs" value="6"/>Nem positivo e nem negativo</label>
            <label class="radio-inline"><input type="radio" name="bugs" value="8"/>Positivo</label>
            <label class="radio-inline"><input type="radio" name="bugs" value="10"/>Extremamente positivo</label>
        </div>

        <div class="form-group">
            <div class="title">
            <label for="text">Automação</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="automation" value="0"/>Extremamente negativo</label>
            <label class="radio-inline"><input type="radio" name="automation" value="3"/>Negativo</label>
            <label class="radio-inline"><input type="radio" name="automation" value="6"/>Nem positivo e nem negativo</label>
            <label class="radio-inline"><input type="radio" name="automation" value="8"/>Positivo</label>
            <label class="radio-inline"><input type="radio" name="automation" value="10"/>Extremamente positivo</label>
        </div>

        <div class="form-group">
            <div class="title">
            <label for="text">Regra de negócio</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="business" value="0"/>Extremamente negativo</label>
            <label class="radio-inline"><input type="radio" name="business" value="3"/>Negativo</label>
            <label class="radio-inline"><input type="radio" name="business" value="6"/>Nem positivo e nem negativo</label>
            <label class="radio-inline"><input type="radio" name="business" value="8"/>Positivo</label>
            <label class="radio-inline"><input type="radio" name="business" value="10"/>Extremamente positivo</label>
        </div>

        <div class="form-group">
            <div class="title">
                <label for="text">Dê sua nota</label><br/>
            </div>
            <input type="range" min="0" max="<?php echo $configuration['config_squad'] / ($configuration['config_squad'] / 10); ?>" step="0.5" name="gradeSquad" id="gradeSquad" value="<?php echo ($configuration['config_squad'] / ($configuration['config_squad'] / 10)) * ($configuration['config_average'] / 100); ?>">
            <p>Nota: <span id="exhibition"></span></p>
        </div>
        <br/>
        <div class="form-group">
            <div class="title">
                <label for="text">Qual a justificativa para a nota? Há algum ponto a observar?</label><br/>
            </div>
            <textarea class="form-control" id="justification" name="justification" rows="3"></textarea>
        </div>

        <script>
            var slider = document.getElementById("gradeSquad");
            var output = document.getElementById("exhibition");
            output.innerHTML = parseFloat(slider.value).toFixed(2);

            slider.oninput = function() {
                output.innerHTML = parseFloat(this.value).toFixed(2);
            }
        </script>

        <br/>

        <input type="submit" value="Emitir Avaliação" class="btn btn-default"/>
    </form>

</div>