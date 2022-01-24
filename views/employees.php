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
                <form method="GET">
                    <div class="col-xs-3 col-xs-offset-0">
                        <label for="type">Tipo de avaliação:</label>
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
                        <a href="<?php echo BASE_URL; ?>employees/add" class="btn btn-default">Adicionar QA</a>
                        <?php if (!isset($_GET['filters'])) : ?>
                            <input type="submit" class="btn btn-outline-primary" value="Aplicar filtro(s)"/>
                        <?php endif; ?>
                        <?php if (isset($_GET['filters'])) : ?>
                            <a href="<?php echo BASE_URL; ?>employees" class="btn btn-outline-info">Limpar filtro(s)</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Pontos</th>
            <th>Quantidade de recuperações</th>
        </tr>
        </thead>
        <?php
        foreach ($employees as $employee):
            ?>
        <?php if ($employee['squad_lead'] === NULL) : ?>
            <tr>
                <?php if ($employee['qtd_recovery'] > 2): ?>
                <td class="danger"><?php echo $employee['name']; ?></td>
                <td class="danger"><?php echo $employee['grade']; ?></td>
                <td class="danger"><?php echo $employee['qtd_recovery']; ?></td>
                <?php else : ?>
                <td><?php echo $employee['name']; ?></td>
                <td><?php echo $employee['grade']; ?></td>
                <td><?php echo $employee['qtd_recovery']; ?></td>
                <?php endif; ?>
            </tr>
        <?php endif; ?>
        <?php endforeach; ?>
    </table>

    <ul class="pagination">
        <?php for ($q = 1; $q <= $total_pages; $q++): ?>
            <li class="<?php echo ($p == $q) ? 'active' : ''; ?>">
                <a href="<?php echo BASE_URL; ?>employees?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endfor; ?>
    </ul>
</div>