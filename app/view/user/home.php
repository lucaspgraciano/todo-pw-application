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
						<button>
							<img src="../../../public/images/loupe.png">
						</button>
					</section>
					<section class="top-bar-alert">
						<?php require 'app/view/commons/alert.php' ?>
					</section>
					<section>
						<form method="POST" action="/logout">
							<div class="top-bar-user_card-container">
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
				<?php if (is_null($data[1]) || count($data[1]) === 0) { ?>
					<form action="/user/home/new_list" method="POST">
						<div class="main-content-first_list">
							<h1>Ops, não encontramos nenhuma lista em seu usuário</h1>
							<p> Vamos começar! Por favor, insira o título desejado para sua lista e clique em adicionar</p>
							<input name="titulo" id="titulo" type="text" placeholder="Lista...">
							<button type="submit">Adicionar</button>
							<img src="../../../public/images/reading.svg" class="home-no-task_bg-svg">
						</div>
					</form>
				<?php } else { ?>
				<section id="Listas" class="main-content-list">
					<div class="main-content-list_user-list">
						<section>
							<header>
								<label>Criar nova lista</label>
								<form action="/user/home/new_list" method="POST">
									<input name="titulo" id="titulo" type="text" placeholder="Lista...">
									<button type="submit">Add</button>
								</form>
							</header>
						</section>
					</div>
					<div class="main-content-list_user-list">
						<?php foreach ($data[1] as $lista) { ?>
							<section>
								<header>
									<div>
										<form action="/user/home/remove_list" method="POST">
											<input name="titulo" id="titulo" type="hidden" value="<?= $lista->titulo ?>">
											<div>
												<label><?= $lista->titulo ?></label>
												<button type="submit"> Excluir </button>
											</div>
										</form>
									</div>
									<form action="/user/home/add_task" method="POST">
										<input name="conteudo" id="conteudo" type="text" placeholder="Tarefa...">
										<input name="titulo" id="titulo" type="hidden" value="<?= $lista->titulo ?>">
										<button type="submit">Add</button>
									</form>
								</header>
								<main>
									<?php if (is_null($data[2]) || count($data[2]) === 0) { ?>
									<?php } else {
										foreach ($data[2] as $tarefa) { 
											if ($tarefa->titulo == $lista->titulo) { ?>
												<div>
													<form action="/user/home/remove_task" method="POST">
														<input name="conteudo" id="conteudo" type="hidden" value="<?= $tarefa->conteudo ?>">
														<input name="titulo" id="titulo" type="hidden" value="<?= $tarefa->titulo ?>">
														<label><?= $tarefa->conteudo ?></labe>
														
														<button type="submit"> Exluir </button>
													</form>
												</div>
												<section>
													<form action="/user/home/update_task" method="POST">
														<input name="conteudo" id="conteudo" type="hidden" value="<?= $tarefa->conteudo ?>">
														<input name="titulo" id="titulo" type="hidden" value="<?= $tarefa->titulo ?>">
														<input name="estado" id="estado" type="hidden" value="<?= $tarefa->estado ?>">
														
														<button type="submit"><?= $tarefa->estado ?></button>
													</form>
												</section>
											<?php } ?>
										<?php } ?>
									<?php } ?>
								</main>
							</section>
							<br>
						<?php } ?>
					</div>
				</section> 
				<?php } ?>
			</main>
		</div>
	</body>
</html>