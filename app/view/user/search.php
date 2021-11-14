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
				<?php if (is_null($data[1])) { ?>
					<form action="/user/home/search" method="POST">
						<div class="main-content-first_list">
							<h1>Está procurando por algo?</h1>
							<p> Para realizar uma busca, insira o termo no campo a baixo e clique em buscar</p>
							<input name="termo" id="termo" type="text" placeholder="Buscar...">
							<button type="submit">Buscar</button>
							<img src="../../../public/images/sitting-reading.svg" class="home-no-task_bg-svg">
						</div>
					</form>
				<?php } else { ?>
					<section id="Listas" class="main-content-list">
                        <img src="../../../public/images/reading-side.svg" id="image-bg-search">
						<div class="main-content-list_user-list">
                            <div class="main-content-list_user-list">
								<section id="search-card">
									<header>
										<div id="title_list">
											<label><?= $data[1]->titulo ?></label>
										</div>
									</header>
									<main>
										<?php if (is_null($data[2]) || count($data[2]) === 0) { ?>
										<?php } else {
											foreach ($data[2] as $tarefa) { 
												if (($tarefa->titulo == $data[1]->titulo) && ($tarefa->email == $data[1]->email)) { ?>
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
						    </div>
						</div>
					</section> 
                <?php } ?>
			</main>
		</div>
	</body>
</html>