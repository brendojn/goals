<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Experiência - Avaliação de Experiência</h1>
    <br>
    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <div class="title">
                <label for="text">Na sua visão, como é a comunicação do profissional com a SQUAD?</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="communication" value="1"/>Muito ruim</label>
            <label class="radio-inline"><input type="radio" name="communication" value="2"/>Ruim</label>
            <label class="radio-inline"><input type="radio" name="communication" value="3"/>Boa</label>
            <label class="radio-inline"><input type="radio" name="communication" value="4"/>Muito boa</label>        </div>

        <div class="form-group">
            <div class="title">
                <label for="text">Como você avalia a aderência técnica do profissional em relação ao nível da senioridade para o qual foi contratado?</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="seniority" value="1"/>Rendimento abaixo do esperado</label>
            <label class="radio-inline"><input type="radio" name="seniority" value="2"/>Aderente ao nível de senioridade contratado</label>
            <label class="radio-inline"><input type="radio" name="seniority" value="3"/>Rendimento acima do esperado</label>
        </div>

        <div class="form-group">
            <div class="title">
                <label for="text">O profissional apresenta abertura para feedbacks, mudanças e sabe ouvir?</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="feedback" value="0"/>Não</label>
            <label class="radio-inline"><input type="radio" name="feedback" value="1"/>Sim</label>
        </div>

        <div class="form-group">
            <div class="title">
                <label for="text">O profissional apresenta proatividade, vontade de aprender, de contribuir, se dedica às atividades?</label><br/>
            </div>
            <label class="radio-inline"><input type="radio" name="proactivity" value="0"/>Não</label>
            <label class="radio-inline"><input type="radio" name="proactivity" value="1"/>Sim</label>
        </div>
        <br/>
        <div class="form-group">
            <div class="title">
                <label for="text">Utilize esse espaço para trazer comentários adicionais sobre as respostas
dadas nas questões anteriores, descreva de forma resumida quais são suas 
impressões sobre o profissional em questão. Há pontos a melhorar? Há 
pontos positivos de destaque?</label><br/>
            </div>
            <textarea class="form-control" id="justification" name="justification" rows="3" value="1"></textarea>
        </div>
        <br/>

        <input type="submit" value="Emitir Avaliação" class="btn btn-default"/>
    </form>

</div>