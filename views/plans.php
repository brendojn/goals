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
            <?php if ($lead === true) : ?>
            <th>Nome</th>
            <?php endif; ?>
            <th>Título</th>
            <th>Data de Criação</th>
            <th>Data de Vencimento</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        </thead>
        <?php foreach ($plans as $plan): ?>
            <?php if ($plan['status'] == "Concluido") : ?>
            <tr class="success">
        <?php else: ?>
            <tr>
        <?php endif; ?>
        <?php if ($lead === true) : ?>
            <td><?php echo $plan['name']; ?></td>
            <?php endif; ?>
            <td><?php echo $plan['title']; ?></td>
            <?php $createdDate = explode(' ', $plan['created_at']); ?>
            <?php $createdDate[0] = implode("/", array_reverse(explode("-", $createdDate[0]))); ?>
            <td><?php echo $createdDate[0] . " " . $createdDate[1]; ?></td>
            <?php $dueDate = explode(' ', $plan['due_date']); ?>
            <?php $dueDate[0] = implode("/", array_reverse(explode("-", $dueDate[0]))); ?>
            <td><?php echo $dueDate[0] . " " . $dueDate[1]; ?></td>
            <td><?php echo $plan['status']; ?></td>
            <td>
                <?php if ($plan['status'] == "A Executar"): ?>
                    <a href="<?php echo BASE_URL; ?>plans/init/<?php echo $plan['id'] ?>"
                       class="btn btn-info">Iniciar plano de estudo</a>
                <?php elseif ($plan['status'] == "Em Progresso"): ?>
                    <a href="<?php echo BASE_URL; ?>plans/done/<?php echo $plan['id']; ?>"
                       class="btn btn-info">Concluir plano de estudo</a>
                <?php endif; ?>
                <a href="<?php echo BASE_URL; ?>plans/info/<?php echo $plan['id']; ?>"
                   class="btn btn-info">Informações</a>
            </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <ul class="pagination">
        <?php for ($q = 1; $q <= $total_pages; $q++): ?>
            <li class="<?php echo ($p == $q) ? 'active' : ''; ?>">
                <a href="<?php echo BASE_URL; ?>plans?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
        <?php endfor; ?>
    </ul>
</div>