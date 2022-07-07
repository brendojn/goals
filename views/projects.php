<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">

    <div class="container-fluid">

        <div class="row">
            <div class="col-xs-10 col-xs-offset-0">
                <h4>Filtros avançados</h4>
                <form method="GET">
                    <div class="col-xs-3 col-xs-offset-0">
                        <label for="employee">Especialista:</label>
                        <select id="employee" name="filters[employee]" class="form-control">
                            <option></option>
                            <?php foreach ($employees as $employee): ?>
                                <?php if ($employee['squad_lead'] === NULL) : ?>
                                    <option value="<?php echo $employee['id']; ?>" <?php echo ($employee['id'] == $filters['employee']) ? 'selected="selected"' : ''; ?>><?php echo ($employee['name']); ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-xs-3 col-xs-offset-0">
                        <label for="type">Tipo de Avaliação:</label>
                        <select id="type" name="filters[type]" class="form-control">
                            <option></option>
                            <?php foreach ($evaluates as $evaluate): ?>
                                <option value="<?php echo $evaluate['id']; ?>" <?php echo ($evaluate['id'] == $filters['type']) ? 'selected="selected"' : ''; ?>><?php echo utf8_encode($evaluate['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <div class="form-group">
                        <a href="<?php echo BASE_URL; ?>projects/add" class="btn btn-default">Adicionar Período</a>
                        <?php if (!isset($_GET['filters'])) : ?>
                            <input type="submit" class="btn btn-outline-primary" value="Aplicar filtro(s)"/>
                        <?php endif; ?>
                        <?php if (isset($_GET['filters'])) : ?>
                            <a href="<?php echo BASE_URL; ?>projects" class="btn btn-outline-info">Limpar filtro(s)</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Período</th>
            <th>Especialista</th>
            <th>Tipo de Avaliação</th>
            <th>Ações</th>
        </tr>
        </thead>
        <?php
        foreach ($projects as $project):
            ?>
            <tr>
                <td><?php echo $project['week']; ?></td>
                <td><?php echo $project['name']; ?></td>
                <td><?php echo $project['name_type']; ?></td>
                <td>
                    <?php if (($project['evaluate'] == 0)  || ($isRh)) : ?>
                        <a href="<?php echo BASE_URL; ?>projects/edit/<?php echo $project['id']; ?>"
                           class="btn btn-default">Editar</a>
                        <a href="projects/delete?id=<?php echo $project['id']; ?>"
                           class="btn btn-danger">Excluir</a>
                    <?php endif; ?>
                    <?php if ((!$project['squad'] == 1) && ($project['fk_type_evaluate_id'] == 3)) : ?>
                        <a href="<?php echo BASE_URL; ?>projects/evaluateSquad/<?php echo $project['id']; ?>"
                           class="btn btn-primary">Avaliar a nível de squad</a>
                    <?php endif; ?>
                    <?php if ((!$project['chapter'] == 1) && ($project['fk_type_evaluate_id'] == 2)) : ?>
                        <a href="<?php echo BASE_URL; ?>projects/evaluateChapter/<?php echo $project['id']; ?>"
                           class="btn btn-info">Avaliar a nível de chapter</a>
                    <?php endif; ?>
                    <?php if ((!$project['skill'] == 1) && ($project['fk_type_evaluate_id'] == 4)) : ?>
                        <a href="<?php echo BASE_URL; ?>projects/evaluateSkills/<?php echo $project['id']; ?>"
                           class="btn btn-warning">Avaliar a nível de skill</a>
                    <?php endif; ?>
                    <?php if ((!$project['experience'] == 1) && ($project['fk_type_evaluate_id'] == 5)) : ?>
                        <a href="<?php echo BASE_URL; ?>projects/evaluateExperience/<?php echo $project['id']; ?>"
                           class="btn btn-warning">Avaliar a nível de Experiência</a>
                    <?php endif; ?>
                    <?php if (($project['evaluate'] == 1 && !$squadLead) ) : ?>
                        <a href="<?php echo BASE_URL; ?>projects/info/<?php echo $project['id']; ?>"
                           class="btn btn-info">Informações</a>
                    <?php endif; ?>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <ul class="pagination">
        <?php for ($q = 1; $q <= $total_pages; $q++): ?>
            <li class="<?php echo ($p == $q) ? 'active' : ''; ?>">
                <a href="<?php echo BASE_URL; ?>projects?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endfor; ?>
    </ul>
</div>