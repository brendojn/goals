<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Chapter - Avaliar Chapter</h1>

    <form method="POST" enctype="multipart/form-data">
        <br/>
        <div class="form-group">
            <div class="title">
            <label for="text">Gerenciamento de risco</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="risks" value="0"/>Extremamente negativo</label>
            <label class="radio-inline"><input type="radio" name="risks" value="3"/>Negativo</label>
            <label class="radio-inline"><input type="radio" name="risks" value="6"/>Nem positivo e nem negativo</label>
            <label class="radio-inline"><input type="radio" name="risks" value="8"/>Positivo</label>
            <label class="radio-inline"><input type="radio" name="risks" value="10"/>Extremamente positivo</label>
        </div>
        <br/>
        <div class="form-group">
            <div class="title">
            <label for="text">Documentação (Bugs, Artigos e Planejamento de testes)</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="documentation" value="0"/>Extremamente negativo</label>
            <label class="radio-inline"><input type="radio" name="documentation" value="3"/>Negativo</label>
            <label class="radio-inline"><input type="radio" name="documentation" value="6"/>Nem positivo e nem negativo</label>
            <label class="radio-inline"><input type="radio" name="documentation" value="8"/>Positivo</label>
            <label class="radio-inline"><input type="radio" name="documentation" value="10"/>Extremamente positivo</label>
        </div>
        <br/>
        <div class="form-group">
            <div class="title">
            <label for="text">Mentalidade analítica/crítica?</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="analytical" value="0"/>Extremamente negativo</label>
            <label class="radio-inline"><input type="radio" name="analytical" value="3"/>Negativo</label>
            <label class="radio-inline"><input type="radio" name="analytical" value="6"/>Nem positivo e nem negativo</label>
            <label class="radio-inline"><input type="radio" name="analytical" value="8"/>Positivo</label>
            <label class="radio-inline"><input type="radio" name="analytical" value="10"/>Extremamente positivo</label>
        </div>
        <br/>
        <div class="form-group">
            <div class="title">
            <label for="text">É um membro participativo em reuniões do chapter?</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="participation" value="0"/>Extremamente negativo</label>
            <label class="radio-inline"><input type="radio" name="participation" value="3"/>Negativo</label>
            <label class="radio-inline"><input type="radio" name="participation"value="6"/>Nem positivo e nem negativo</label>
            <label class="radio-inline"><input type="radio" name="participation" value="8"/>Positivo</label>
            <label class="radio-inline"><input type="radio" name="participation" value="10"/>Extremamente positivo</label>
        </div>
        <br/>
        <div class="form-group">
            <div class="title">
            <label for="text">É ambicioso em relação ao lado profissional?(certificações, cursos e etc)</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="ambition" value="0"/>Extremamente negativo</label>
            <label class="radio-inline"><input type="radio" name="ambition" value="3"/>Negativo</label>
            <label class="radio-inline"><input type="radio" name="ambition" value="6"/>Nem positivo e nem negativo</label>
            <label class="radio-inline"><input type="radio" name="ambition" value="8"/>Positivo</label>
            <label class="radio-inline"><input type="radio" name="ambition" value="10"/>Extremamente positivo</label>
        </div>
        <br/>
        <div class="form-group">
            <div class="title">
            <label for="text">Provedor de treinamento?</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="training" value="0"/>Extremamente negativo</label>
            <label class="radio-inline"><input type="radio" name="training" value="3"/>Negativo</label>
            <label class="radio-inline"><input type="radio" name="training" value="6"/>Nem positivo e nem negativo</label>
            <label class="radio-inline"><input type="radio" name="training" value="8"/>Positivo</label>
            <label class="radio-inline"><input type="radio" name="training" value="10"/>Extremamente positivo</label>
        </div>
        <br/>
        <div class="form-group">
            <div class="title">
                <label for="text">Dê sua nota</label><br/>
            </div>
            <input type="range" min="0" max="<?php echo $configuration['config_chapter'] / ($configuration['config_chapter'] / 10); ?>" step="0.5" name="gradeChapter" id="gradeChapter" value="<?php echo ($configuration['config_chapter'] / ($configuration['config_chapter'] / 10)) * ($configuration['config_average'] / 100); ?>">
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
            var slider = document.getElementById("gradeChapter");
            var output = document.getElementById("exhibition");
            output.innerHTML = parseFloat(slider.value).toFixed(2);

            slider.oninput = function() {
                output.innerHTML = parseFloat(this.value).toFixed(2);
            }
        </script>

        <br/>
        <br/>

        <input type="submit" value="Emitir Avaliação" class="btn btn-default"/>
    </form>

</div>