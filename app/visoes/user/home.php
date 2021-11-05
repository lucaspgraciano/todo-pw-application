<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="../../../publico/estilo/home.css" rel="stylesheet">
		<script src="../../../publico/js/home.js"></script>
		<title>HOME</title>
	</head>
	<body>
		<!-- TODO: Fazer um alert.php e inserir nesta view -->
		<div class="container">
			<div class="top-bar-pai">
			<header class="top-bar">
				<section class="top-bar-search_bar">
					<input type="text" placeholder="Buscar...">
					<button><img src="../../../publico/imagens/loupe.png"></button>
				</section>
				<section>
				<form method="POST" action="/logout">
					<div class="top-bar-user_card-container">
						<div class="top-bar-user_card_img"><img src=".../../../publico/imagens/user.png"></div>
						<div class="top-bar-user_card_info">
							<p><?= $data[0]->nome ?></p>
							<hr>
							<p><?= $data[0]->email ?></p>
						</div>
						<button type="submit"><img src="../../../publico/imagens/exit.png"></button>
					</div>
				</form>
				</section>
			</header>
			</div>
			<main class="main-content">
				<section id="Listas" class="main-content-list">
					<div class="main-content-list_list">
						<!-- <button onclick="ShowCriarLista(true)"><p>NOVA LISTA DE TAREFAS</p></button> -->
						<!-- <input class="hidden">
						<button class="hidden" onclick="AddLista()">Ok</button>
						<button class="hidden" onclick="ShowCriarLista(false)">Cancelar</button> -->
						<form action="/user/home/new_list" method="POST">
							<label for="titulo">Título da Lista</label>
							<input name="titulo" id="titulo" type="text" placeholder="Exemplo">
							<button type="submit">Enviar</button>
						</form>
					</div>
					<?php if (is_null($data[1]) || count($data[1]) === 0) { ?>
					<?php } else {
						foreach ($data[1] as $lista) { ?>
							<div class="main-content-list_list">
								<div>
									<form action="/user/home/remove_list" method="POST">
										<h1><?= $lista->titulo ?></h1>
										<input type="hidden" name="titulo" value="<?= $lista->titulo ?>">
										<button type="submit"> X </button>
									</form>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				</section>
			</main>
		</div>
	</body>
</html>