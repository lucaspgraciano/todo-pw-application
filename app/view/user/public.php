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
						<input type="text" placeholder="Buscar...">
						<button>
							<img src="../../../public/images/search.svg">
						</button>
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
							<h1>Ops, não encontramos nenhuma lista publicada por outros usuários</h1>
                            <p>Para publicar uma lista, clique no botão &nbsp<img id="img-icon-public" src="../../../public/images/private-black.svg"> </p>
							<img src="../../../public/images/petting.svg" class="home-no-public-task_bg-svg">
						</div>
					</form>
				<?php } else { ?>
					<section id="Listas" class="main-content-list">
						<div class="main-content-list_user-list">
							<?php foreach ($data[1] as $lista) { ?>
								<section>
									<header>
										<div id="title_list">
											<label><?= $lista->titulo ?></label>
										</div>
                                        <label><?= $lista->email ?></label>
									</header>
									<main>
										<?php if (is_null($data[2]) || count($data[2]) === 0) { ?>
										<?php } else {
											foreach ($data[2] as $tarefa) { 
												if (($tarefa->titulo == $lista->titulo) && ($tarefa->email == $lista->email)) { ?>
												<div class="user-tasks">
													<div class="user-list-conteudo">
														<form>
															<label id="user-list-conteudo-label"><?= $tarefa->conteudo ?></label>
														</form>
													</div>
													<div class="user-list-estado">
														<form>
															<button id="user-list-estado-lbl" type="reset"><?= $tarefa->estado ?></button>
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
                        <img id="image-bg-public" src="../../../public/images/doggie.svg">
					</section> 
				<?php } ?>
			</main>
		</div>
	</body>
</html>