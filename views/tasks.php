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
                        <label for="task">Buscar tarefa:</label>
                        <input type="text" name="filters[task]" id="task" class="form-control" placeholder="Nome da tarefa"/>
                    </div>
                    <div class="col-xs-3 col-xs-offset-1">
                        <label for="employee">QA's:</label>
                        <select id="employee" name="filters[employee]" class="form-control">
                            <option></option>
                            <?php foreach ($employees as $employee): ?>
                                <option value="<?php echo $employee['id']; ?>" <?php echo ($employee['id'] == $filters['employee']) ? 'selected="selected"' : ''; ?>><?php echo $employee['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-xs-3 col-xs-offset-1">
                        <label for="status">Status da Tarefa:</label>
                        <select id="status" name="filters[status]" class="form-control">
                            <option></option>
                            <option value="1-1" <?php echo ($filters['status'] == '1-1') ? 'selected="selected"' : ''; ?>>
                                Tarefas pagas
                            </option>
                            <option value="1-0" <?php echo ($filters['status'] == '1-0') ? 'selected="selected"' : ''; ?>>
                                Tarefas avaliadas
                            </option>
                            <option value="0-0" <?php echo ($filters['status'] == '0-0') ? 'selected="selected"' : ''; ?>>
                                Tarefas em aberto
                            </option>
                        </select>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <div class="form-group">
                        <a href="<?php echo BASE_URL; ?>tasks/add" class="btn btn-default">Adicionar Tarefa</a>
                        <input type="submit" class="btn btn-info" value="Aplicar filtro(s)"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>QA</th>
                    <th>Complexidade</th>
                    <th>Pontos</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <?php
                foreach ($tasks as $task):
                    ?>
                    <tr>
                        <td><?php echo $task['task']; ?></td>
                        <td><?php echo $task['name']; ?></td>
                        <td><?php echo $task['fibonacci']; ?></td>
                        <td><?php echo $task['points']; ?> %</td>
                        <td>
                            <?php if ($task['pay'] == 0 && $task['evaluate'] == 0) : ?>
                                <a href="<?php echo BASE_URL; ?>tasks/edit/<?php echo $task['task']; ?>"
                                   class="btn btn-default">Editar</a>
                                <a href="tasks/delete?task=<?php echo $task['task']; ?>"
                                   class="btn btn-danger">Excluir</a>
                            <?php elseif($task['pay'] == 0 && $task['evaluate'] == 1): ?>
                                <a href="tasks/delete?task=<?php echo $task['task']; ?>"
                                   class="btn btn-danger">Excluir</a>
                            <?php endif; ?>
                            <?php if ($task['evaluate'] == 0) : ?>
                                <a href="<?php echo BASE_URL; ?>tasks/evaluate/<?php echo $task['id']; ?>"
                                   class="btn btn-info">Avaliar</a>
                            <?php elseif ($task['pay'] == 0): ?>
                                <a href="<?php echo BASE_URL; ?>tasks/pay/<?php echo $task['id']; ?>"
                                   class="btn btn-info">Pagar</a>
                            <?php else : ?>
                                <a href="<?php echo BASE_URL; ?>tasks/info/<?php echo $task['id']; ?>"
                                   class="btn btn-info">Informações</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

    <ul class="pagination">
        <?php for ($q = 1; $q <= $total_pages; $q++): ?>
            <li class="<?php echo ($p == $q) ? 'active' : ''; ?>">
                <a href="<?php echo BASE_URL; ?>tasks?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endfor; ?>
    </ul>
</div>