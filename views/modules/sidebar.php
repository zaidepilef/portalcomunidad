<aside class="main-sidebar">
	<section class="sidebar" style="height:auto;">
		<ul class="sidebar-menu tree" data-widget="tree">


			<li class="active">
				<a href="home">
					<i class="fa fa-home"></i>
					<span>Inicio</span>
				</a>
			</li>


			<li>
				<a href="users">
					<i class="fa fa-users"></i>
					<span>Usuarios</span>
				</a>
			</li>


			<li>
				<a href="customers">
					<i class="fa fa-university"></i>
					<span>Establecimientos</span>
				</a>
			</li>


			<li>
				<a href="categories">
					<i class="fa fa-th"></i>
					<span>Categorias</span>
				</a>
			</li>

			<li>
				<a href="products">
					<i class="fa fa-bars"></i>
					<span>Consumos</span>
				</a>
			</li>

			<li class="treeview">

				<a href="#">
					<i class="fa fa-list-ul"></i>
					<span>Sales</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>

				<ul class="treeview-menu">
					<li>
						<a href="sales">
							<i class="fa fa-circle"></i>
							<span>Manage sales</span>
						</a>
					</li>

					<li>
						<a href="create-sale">
							<i class="fa fa-circle"></i>
							<span>Create sale</span>
						</a>
					</li>
					<li>
						<a href="reports">
							<i class="fa fa-bar-chart"></i>
							<span>Reporte</span>
						</a>
					</li>

					
				</ul>

			</li>
	
	<?php

			if ($_SESSION["profile"] == "Administrator" || $_SESSION["profile"] == "Sostenedor"|| $_SESSION["profile"] == "Encargado EE" ) {

				echo '

					<li class="active">

						<a href="home">

							<i class="fa fa-home"></i>

							<span>Inicio</span>

						</a>

					</li>
					';
				}

				if ($_SESSION["profile"] == "Administrator" ) {

					echo '
					<li>

						<a href="users">

							<i class="fa fa-users"></i>

							<span>Usuarios</span>

						</a>

					</li>

					';
				}

				if($_SESSION["profile"] == "Administrator" || $_SESSION["profile"] == "Seller"){
					echo '

						<li>

							<a href="customers">

								<i class="fa fa-university"></i>

								<span>Establecimientos</span>

							</a>

						</li>

					';
				}


			if($_SESSION["profile"] == "Administrator" || $_SESSION["profile"] == "Sostenedor"){

				echo '

					<li>

						<a href="categories">

							<i class="fa fa-th"></i>

							<span>Categorias</span>

						</a>

					</li>

					<li>

						<a href="products">

							<i class="fa fa-bars"></i>

							<span>Consumos</span>

						</a>

					</li>
				';

			}

			if($_SESSION["profile"] == "Encargado EE"){

				echo '

					<li>

						<a href="products-col">

							<i class="fa fa-product-hunt"></i>

							<span>Consumos</span>

						</a>

					</li>
				';

			}




			if($_SESSION["profile"] == "Administrator" || $_SESSION["profile"] == "Seller"){

			echo'
				<li class="treeview">
				<a href="#">
					<i class="fa fa-list-ul"></i>
					<span>Sales</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>

				<ul class="treeview-menu">
					<li>
						<a href="sales">
							<i class="fa fa-circle"></i>
							<span>Manage sales</span>
						</a>
					</li>

					<li>
						<a href="create-sale">
							<i class="fa fa-circle"></i>
							<span>Create sale</span>
						</a>
					</li>';

				}

				if($_SESSION["profile"] == "Administrator"){

					echo '<li>
						<a href="reports">
							<i class="fa fa-bar-chart"></i>
							<span>Reporte</span>
						</a>
					</li>';

				}

				echo '</ul>

			</li>';

		?>
</ul>
</section>
</aside>
