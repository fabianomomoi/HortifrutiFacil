<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
		<div class="container">
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav centra-menu">
					<li class="nav-item active" <?php if ($viewVar['nameController'] == "HomeController") { } ?>>
						<a class="nav-link js-scroll-trigger" href="http://<?php echo APP_HOST; ?>">Principal</a>	
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link js-scroll-trigger dropdown-toggle" data-toggle="dropdown" href="#">Consultar<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li <?php if ($viewVar['nameController'] == "PessoaController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "pg_consultar")) { ?> class="active" <?php } ?>>
                                                            <a href="http://<?php echo APP_HOST; ?>/pessoa/consulta" >Pessoa</a>
							</li>
							<li <?php if ($viewVar['nameController'] == "CidadeController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "pg_consultar")) { ?> class="active" <?php } ?>>
                                                            <a href="http://<?php echo APP_HOST; ?>/cidade/consulta" >Cidade</a>
							</li>
							<li <?php if ($viewVar['nameController'] == "EstadpController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "pg_consultar")) { ?> class="active" <?php } ?>>
                                                            <a  href="http://<?php echo APP_HOST; ?>/estado/consulta" >Estado</a>
							</li>
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link js-scroll-trigger dropdown-toggle" data-toggle="dropdown" href="#">Cadastrar<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li <?php if ($viewVar['nameController'] == "PessoaController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "pg_consultar")) { ?> class="active" <?php } ?>>
								<a href="http://<?php echo APP_HOST; ?>/pessoa/insercao" >Pessoa</a>
							</li>
							<li <?php if ($viewVar['nameController'] == "CidadeController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "pg_consultar")) { ?> class="active" <?php } ?>>
								<a href="http://<?php echo APP_HOST; ?>/cidade/insercao" >Cidade</a>
							</li>
							<li <?php if ($viewVar['nameController'] == "EstadoController" && ($viewVar['nameAction'] == "" || $viewVar['nameAction'] == "pg_consultar")) { ?> class="active" <?php } ?>>
								<a href="http://<?php echo APP_HOST; ?>/estado/insercao" >Estado</a>
							</li>
						</ul>
					</li>

				</ul>
			</div>
		</div>
	</nav>