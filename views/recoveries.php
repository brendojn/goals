<?php
if (empty($_SESSION['logged'])) {
    ?>
    <script type="text/javascript">window.location.href = "<?php echo BASE_URL; ?>login";</script>
    <?php
    exit;
}
?>
<div class="container">

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Nota</th>
            <th>Tipo de Avaliação</th>
            <th>Data da Avaliação</th>
            <th>Ações</th>
        </tr>
        </thead>
        <?php
        foreach ($recoveries as $recovery):
        ?>
        <?php if ($recovery['grade_plan'] == 0 && $recovery['grade_plan'] != NULL) : ?>
        <tr class="success">
            <?php else: ?>
        <tr>
            <?php endif; ?>
            <?php if ($recovery['qtd_recovery'] > 2 && !$recovery['grade_plan'] == 0): ?>
            <td class="danger"><?php echo $recovery['name']; ?></td>
            <?php if ($recovery['name_type'] == 'Skills') : ?>
                <td class="danger"><?php echo $recovery['grade'] . '/' . $configs['config_skill']; ?></td>
            <?php elseif ($recovery['name_type'] == 'Squad') : ?>
                <td class="danger"><?php echo $recovery['grade'] . '/' . $configs['config_squad']; ?></td>
            <?php elseif ($recovery['name_type'] == 'Chapter') : ?>
                <td class="danger"><?php echo $recovery['grade'] . '/' . $configs['config_chapter']; ?></td>
            <?php endif; ?>
                <td class="danger"><?php echo $recovery['name_type']; ?></td>
                <td class="danger"><?php echo $recovery['created_at']; ?></td>
                <td class="danger">
                    <a href="<?php echo BASE_URL; ?>plans/add/<?php echo $recovery['id']; ?>"
                       class="btn btn-primary">Plano de estudo</a>
                    <a href="<?php echo BASE_URL; ?>projects/info/<?php echo $recovery['fk_project_id']; ?>"
                       class="btn btn-info">Informações</a>
                </td>
            <?php else : ?>
                <td><?php echo $recovery['name']; ?></td>
            <?php if ($recovery['name_type'] == 'Skills') : ?>
                <td><?php echo $recovery['grade'] . '/' . $configs['config_skill']; ?></td>
            <?php elseif ($recovery['name_type'] == 'Squad') : ?>
                <td><?php echo $recovery['grade'] . '/' . $configs['config_squad']; ?></td>
            <?php elseif ($recovery['name_type'] == 'Chapter') : ?>
                <td><?php echo $recovery['grade'] . '/' . $configs['config_chapter']; ?></td>
            <?php endif; ?>
                <td><?php echo $recovery['name_type']; ?></td>
                <td><?php echo $recovery['created_at']; ?></td>
                <td>
                    <?php if ($recovery['grade_plan'] != 0 || $recovery['grade_plan'] == NULL) : ?>
                        <a href="<?php echo BASE_URL; ?>plans/add/<?php echo $recovery['id']; ?>"
                           class="btn btn-primary">Plano de estudo</a>
                    <?php endif; ?>
                    <a href="<?php echo BASE_URL; ?>projects/info/<?php echo $recovery['fk_project_id']; ?>"
                       class="btn btn-info">Informações</a>
                </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </table>

    <ul class="pagination">
        <?php for ($q = 1; $q <= $total_pages; $q++): ?>
            <li class="<?php echo ($p == $q) ? 'active' : ''; ?>">
                <a href="<?php echo BASE_URL; ?>recoveries?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endfor; ?>
    </ul>
</div>