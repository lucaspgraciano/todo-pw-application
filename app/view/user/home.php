<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="../../../public/images/favicon.ico"/>
		<link href="../../../public/css/home.css" rel="stylesheet">
		<title>Todo App | <?= $data[0]->nome ?></title>
	</head>
	<body>
		<div class="container">
			<div class="top-bar-pai">
				<header class="top-bar">
					<section class="top-bar-search_bar">
                            <form method="POST" action="/user/home/search">
                                <input class="search-input" type="text" name="termo" id="termo" placeholder="Buscar...">
                                <button><img src="../../../public/images/search.svg"></button>
                            </form>
                            <section>
                                <form method="GET" action="/user/home">
                                    <button id="nav-btns" type="submit">
                                        <img src="../../../public/images/home.svg">
                                    </button>
                                </form>
                            </section>
                            <section>
                                <form method="GET" action="/user/public">
                                    <button id="nav-btns" type="submit">
                                        <img src="../../../public/images/globe.svg">
                                    </button>
                                </form>
                            </section>
                            <section>
                                <form method="GET" action="/user/search">
                                <button id="nav-btns" type="submit">
                                        <img src="../../../public/images/explore.svg">
                                    </button>
                                </form>
                            </section>
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
								<button type="submit"><img src="../../../public/images/logout.svg"></button>
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
										<button type="submit"><img src="../../../public/images/add.svg"></button>
									</form>
								</header>
								<img src="../../../public/images/clumsy.svg" id="image-bg-home">
							</section>
						</div>
						<div class="main-content-list_user-list">
							<?php foreach ($data[1] as $lista) { ?>
								<section>
									<header>
										<div id="title_list">
											<label><?= $lista->titulo ?></label>
											<form action="/user/home/update_task_visibility" method="POST">
												<input name="titulo" id="titulo" type="hidden" value="<?= $lista->titulo ?>">
												<input name="visibilidade" id="visibilidade" type="hidden" value="<?= $lista->visibilidade ?>">
												<?php if ($lista->visibilidade ==  0) {?>
													<button id="update-task-private" type="submit"><img src="../../../public/images/private.svg"></button>
												<?php } else { ?>
													<button id="update-task-public" type="submit"><img src="../../../public/images/public.svg"></button>
												<?php } ?>
											</form>
											<form action="/user/home/remove_list" method="POST">
												<input name="titulo" id="titulo" type="hidden" value="<?= $lista->titulo ?>">
												<button id="delete-task" type="submit"><img src="../../../public/images/delete.svg"></button>
											</form>
										</div>
										<form action="/user/home/add_task" method="POST">
											<input name="conteudo" id="conteudo" type="text" placeholder="Tarefa...">
											<input name="titulo" id="titulo" type="hidden" value="<?= $lista->titulo ?>">
											<input name="visibilidade" id="visibilidade" type="hidden" value="<?= $lista->visibilidade ?>">
											<button type="submit"><img src="../../../public/images/add.svg"></button>
										</form>
									</header>
									<main>
										<?php if (is_null($data[2]) || count($data[2]) === 0) { ?>
										<?php } else {
											foreach ($data[2] as $tarefa) { 
												if ($tarefa->titulo == $lista->titulo) { ?>
												<div class="user-tasks">
													<div class="user-list-conteudo">
														<form action="/user/home/remove_task" method="POST">
															<input name="conteudo" id="conteudo" type="hidden" value="<?= $tarefa->conteudo ?>">
															<input name="titulo" id="titulo" type="hidden" value="<?= $tarefa->titulo ?>">
															<label id="user-list-conteudo-label"><?= $tarefa->conteudo ?></label>
															<button id="user-list-conteudo-btn" type="submit"><img src="../../../public/images/delete.svg"></button>
														</form>
													</div>
													<div class="user-list-estado">
														<form action="/user/home/update_task" method="POST">
															<input name="conteudo" id="conteudo" type="hidden" value="<?= $tarefa->conteudo ?>">
															<input name="titulo" id="titulo" type="hidden" value="<?= $tarefa->titulo ?>">
															<input name="estado" id="estado" type="hidden" value="<?= $tarefa->estado ?>">
															<button id="user-list-estado-btn" type="submit"><?= $tarefa->estado ?></button>
														</form>
													</div>
												</div>
												<?php } ?>
											<?php } ?>
										<?php } ?>
									</main>
								</section>
							<?php } ?>
						</div>
					</section> 
				<?php } ?>
			</main>
		</div>
	</body>
</html>