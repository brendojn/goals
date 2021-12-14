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
                <label for="text">Teste de performance</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="performance" value="0"/>Extremamente negativo</label>
            <label class="radio-inline"><input type="radio" name="performance" value="3"/>Negativo</label>
            <label class="radio-inline"><input type="radio" name="performance" value="6"/>Nem positivo e nem negativo</label>
            <label class="radio-inline"><input type="radio" name="performance" value="8"/>Positivo</label>
            <label class="radio-inline"><input type="radio" name="performance" value="10"/>Extremamente positivo</label>
        </div>

        <div class="form-group">
            <div class="title">
                <label for="text">Teste de Segurança</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="safety" value="0"/>Extremamente negativo</label>
            <label class="radio-inline"><input type="radio" name="safety" value="3"/>Negativo</label>
            <label class="radio-inline"><input type="radio" name="safety" value="6"/>Nem positivo e nem negativo</label>
            <label class="radio-inline"><input type="radio" name="safety" value="8"/>Positivo</label>
            <label class="radio-inline"><input type="radio" name="safety" value="10"/>Extremamente positivo</label>
        </div>

        <div class="form-group">
            <div class="title">
                <label for="text">Teste de Usabilidade</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="usability" value="0"/>Extremamente negativo</label>
            <label class="radio-inline"><input type="radio" name="usability" value="3"/>Negativo</label>
            <label class="radio-inline"><input type="radio" name="usability" value="6"/>Nem positivo e nem negativo</label>
            <label class="radio-inline"><input type="radio" name="usability" value="8"/>Positivo</label>
            <label class="radio-inline"><input type="radio" name="usability" value="10"/>Extremamente positivo</label>
        </div>

        <div class="form-group">
            <div class="title">
                <label for="text">Conhecimento de Git</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="git" value="0"/>Extremamente negativo</label>
            <label class="radio-inline"><input type="radio" name="git" value="3"/>Negativo</label>
            <label class="radio-inline"><input type="radio" name="git" value="6"/>Nem positivo e nem negativo</label>
            <label class="radio-inline"><input type="radio" name="git" value="8"/>Positivo</label>
            <label class="radio-inline"><input type="radio" name="git" value="10"/>Extremamente positivo</label>
        </div>

        <div class="form-group">
            <div class="title">
                <label for="text">Revisão de histórias</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="story" value="0"/>Extremamente negativo</label>
            <label class="radio-inline"><input type="radio" name="story" value="3"/>Negativo</label>
            <label class="radio-inline"><input type="radio" name="story" value="6"/>Nem positivo e nem negativo</label>
            <label class="radio-inline"><input type="radio" name="story" value="8"/>Positivo</label>
            <label class="radio-inline"><input type="radio" name="story" value="10"/>Extremamente positivo</label>
        </div>

        <div class="form-group">
            <div class="title">
                <label for="text">Testes de api</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="api" value="0"/>Extremamente negativo</label>
            <label class="radio-inline"><input type="radio" name="api" value="3"/>Negativo</label>
            <label class="radio-inline"><input type="radio" name="api" value="6"/>Nem positivo e nem negativo</label>
            <label class="radio-inline"><input type="radio" name="api" value="8"/>Positivo</label>
            <label class="radio-inline"><input type="radio" name="api" value="10"/>Extremamente positivo</label>
        </div>
        <br/>
        <div class="form-group">
            <div class="title">
                <label for="text">Qual a justificativa para a nota? Há algum ponto a observar?</label><br/>
            </div>
            <textarea class="form-control" id="justification" name="justification" rows="3"></textarea>
        </div>
        <br/>

        <input type="submit" value="Emitir Avaliação" class="btn btn-default"/>
    </form>

</div>