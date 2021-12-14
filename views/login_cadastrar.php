<html>
    <head>
        <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Goals</title>
	    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
		<nav class="navbar navbar-inverse">
			<div class="container">
				<div id="navbar">
					<ul class="nav navbar-nav navbar-left">
						<li><a href="<?php echo BASE_URL; ?>">Acompanhamento de Produtividade</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo BASE_URL; ?>login/enter">Login</a></li>
						<li><a href="<?php echo BASE_URL; ?>login/add">Cadastrar</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
	        <h1>Cadastrar</h1>

	        <?php if(!empty($erro)): ?>
	        <div class="alert alert-danger"><?php echo $erro; ?></div>
		    <?php endif; ?>

	        <form method="POST">

	        	<div class="form-group">
	        		<label for="nome">Usuário:</label>
	        		<input type="text" class="form-control" name="user" id="user" />
	        	</div>

	        	<div class="form-group">
	        		<label for="password">Senha:</label>
	        		<input type="password" class="form-control" name="password" id="password" />
	        	</div>

	        	<button type="submit" class="btn btn-default">Cadastrar</button>

	        </form>






















	    </div>
    </body>
</html>
