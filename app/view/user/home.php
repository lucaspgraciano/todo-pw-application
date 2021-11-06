<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="../../../public/css/home.css" rel="stylesheet">
		<script src="../../../public/js/home.js"></script>
		<title>HOME</title>
	</head>
	<body>
		<div class="container">
			<div class="top-bar-pai">
			<header class="top-bar">
				<section class="top-bar-search_bar">
					<input type="text" placeholder="Buscar...">
					<button><img src="../../../public/images/loupe.png"></button>
				</section>
				<section class="top-bar-alert"><?php require 'app/view/commons/alert.php' ?></section>
				<section>
				<form method="POST" action="/logout">
					<div class="top-bar-user_card-container">
						<div class="top-bar-user_card_img"><img src=".../../../public/images/user.png"></div>
						<div class="top-bar-user_card_info">
							<p><?= $data[0]->nome ?></p>
							<hr>
							<p><?= $data[0]->email ?></p>
						</div>
						<button type="submit"><img src="../../../public/images/exit.png"></button>
					</div>
				</form>
				</section>
			</header>
			</div>
			<main class="main-content">
				<section id="Listas" class="main-content-list">
					<div class="main-content-list_list">
						<form action="/user/home/new_list" method="POST">
							<label for="titulo">Título da Lista</label>
							<input name="titulo" id="titulo" type="text" placeholder="Exemplo">
							<button type="submit">ADICIONAR LISTA</button>
						</form>
					</div>
					<?php if (is_null($data[1]) || count($data[1]) === 0) { ?>
					<?php } else {
						foreach ($data[1] as $lista) { ?>
							<div class="main-content-list_list">
								<div>
									<form action="/user/home/remove_list" method="POST">
										<input name="titulo" id="titulo" type="hidden" value="<?= $lista->titulo ?>">
										<button type="submit"> APAGAR LISTA </button>
										<h1><?= $lista->titulo ?></h1>	
									</form>
									<?php if (is_null($data[2]) || count($data[2]) === 0) { ?>
									<?php } else {
										foreach ($data[2] as $tarefa) { 
											if ($tarefa->titulo == $lista->titulo) { ?>
												<strong><?= $tarefa->conteudo ?></strong><p><?= $tarefa->estado ?></p>
													
													<form action="/user/home/remove_task" method="POST">
														<input name="conteudo" id="conteudo" type="hidden" value="<?= $tarefa->conteudo ?>">
														<input name="titulo" id="titulo" type="hidden" value="<?= $tarefa->titulo ?>">
														<button type="submit"> APAGAR TAREFA </button>
													</form>
													<form action="/user/home/update_task" method="POST">
														<input name="conteudo" id="conteudo" type="hidden" value="<?= $tarefa->conteudo ?>">
														<input name="titulo" id="titulo" type="hidden" value="<?= $tarefa->titulo ?>">
														<input name="estado" id="estado" type="hidden" value="<?= $tarefa->estado ?>">
														<button type="submit"> ATUALIZAR TAREFA </button>
													</form>
											<?php } else { ?>
											<?php } ?>
										<?php } ?>
									<?php } ?>
								</div>
								<form action="/user/home/add_task" method="POST">
									<label for="conteudo"> Tarefa</label>
									<input name="conteudo" id="conteudo" type="text" placeholder="Exemplo">
									<input name="titulo" id="titulo" type="hidden" value="<?= $lista->titulo ?>">
									<button type="submit">ADICIONAR TAREFA</button>
								</form>
							</div>
						<?php } ?>
					<?php } ?>
				</section>
			</main>
		</div>
	</body>
</html>