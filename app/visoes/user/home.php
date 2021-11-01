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
							<p><?= $data->nome ?></p>
							<hr>
							<p><?= $data->email ?></p>
						</div>
						<button type="submit"><img src="../../../publico/imagens/exit.png"></button>
					</div>
				</form>
				</section>
			</header>
			</div>
			<main class="main-content">
				<section id="Listas" class="main-content-list">
					<div class="main-content-list_new-list">
						<button onclick="ShowCriarLista(true)"><p>NOVA LISTA DE TAREFAS</p></button>
						<input class="hidden">
						<button class="hidden" onclick="AddLista()">Ok</button>
						<button class="hidden" onclick="ShowCriarLista(false)">Cancelar</button>
					</div>
				</section>
			</main>
		</div>
	</body>
</html>