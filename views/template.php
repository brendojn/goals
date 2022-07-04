<html>
    <head>
        <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Goals</title>
	    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
	    <link href="<?php echo BASE_URL; ?>assets/css/template.css" rel="stylesheet">
	    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
	    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
	    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    </head>
    <body>
		<nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="<?php echo BASE_URL; ?>" class="navbar-brand">123Milhas - Acompanhamento de Produtividade</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <?php $u = new User(); ?>
                    <?php $isLead = $u->isLead(); ?>
                    <?php $isLeadChapter = $u->isLeadChapter(); ?>
                    <?php $isLeadSquad = $u->isLeadSquad(); ?>
                    <?php if (isset($_SESSION['logged']) && !empty($_SESSION['logged']) && $isLeadChapter == true): ?>
                        <li><a href="<?php echo BASE_URL; ?>plans">Planos de Estudo</a></li>
                        <li><a href="<?php echo BASE_URL; ?>recovery">Recuperação</a></li>
                        <li><a href="<?php echo BASE_URL; ?>projects">Avaliações</a></li>
                        <li><a href="<?php echo BASE_URL; ?>employees">Especialistas</a></li>
                        <li><a href="<?php echo BASE_URL; ?>login/sair">Sair</a></li>
                    <?php elseif (isset($_SESSION['logged']) && !empty($_SESSION['logged']) && $isLead == false): ?>
                        <li><a href="<?php echo BASE_URL; ?>plans">Planos de Estudo</a></li>
                        <li><a href="<?php echo BASE_URL; ?>login/sair">Sair</a></li>
                    <?php elseif (isset($_SESSION['logged']) && !empty($_SESSION['logged']) && $isLeadSquad == true): ?>
                        <li><a href="<?php echo BASE_URL; ?>projects">Avaliações</a></li>
                        <li><a href="<?php echo BASE_URL; ?>login/sair">Sair</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo BASE_URL; ?>add">Cadastre-se</a></li>
                        <li><a href="<?php echo BASE_URL; ?>login">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
		</nav>
		<div class="container">
	        <?php
	        $this->loadViewInTemplate($viewName, $viewData);
	        ?>
	    </div>
    </body>
</html>
