<style type="text/css">
body { padding-top:60px !important; } */
</style>
<div class="navbar navbar-inverse navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Navegação</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo baseURL; ?>">ERP Unifique</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="menu-item dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">ERP <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class="menu-item "><a href="<?php echo baseURL; ?>admin/erp/paginas/gerenciar/">Páginas</a></li>
						<li class="menu-item "><a href="<?php echo baseURL; ?>admin/erp/usuarios/gerenciar/">Usuários</a></li>
						<li class="menu-item "><a href="<?php echo baseURL; ?>admin/erp/grupos/gerenciar/">Grupos</a></li>
					</ul>
				</li>
				<li class="menu-item dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Bemtevi <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class="menu-item dropdown dropdown-submenu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuários</a>
							<ul class="dropdown-menu">
								<li class="menu-item "><a href="<?php echo baseURL; ?>admin/bemtevi/usuarios/adicionar/">Adicionar</a></li>
								<li class="menu-item "><a href="<?php echo baseURL; ?>admin/bemtevi/usuarios/alterar_senha/">Alterar senha</a></li>
								<li class="menu-item "><a href="<?php echo baseURL; ?>admin/bemtevi/usuarios/alterar_situacao/">Alterar situação</a></li>
							</ul>
						</li>
						<li class="menu-item dropdown dropdown-submenu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Unidades</a>
							<ul class="dropdown-menu">
								<li class="menu-item "><a href="<?php echo baseURL; ?>admin/bemtevi/unidades/adicionar/">Adicionar</a></li>
								<li class="menu-item "><a href="<?php echo baseURL; ?>admin/bemtevi/unidades/gerenciar/">Gerenciar</a></li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo baseURL; ?>logout/">Sair</a></li>
			</ul>
		</div>
	</div>
</div>
