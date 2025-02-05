<?php

 class ControllerCategories{

 	/*=============================================
	CREATE CATEGORY
	=============================================*/

	static public function ctrCreateCategory(){

		if(isset($_POST['newCategory'])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newCategory"])){

				$table = 'categories';

				$data = $_POST['newCategory'];

				$answer = CategoriesModel::mdlAddCategory($table, $data);
				// var_dump($answer);

				if($answer == 'ok'){

					echo '<script>

						swal({
							type: "success",
							title: "Categoría ha sido grabada con éxito",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

							}).then(function(result){
								if (result.value) {

									window.location = "categories";

								}
							});

					</script>';
				}


			}else{

				echo '<script>

						swal({
							type: "error",
							title: "No caracteres especiales o campos en blanco",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

							 }).then(function(result){

								if (result.value) {
									window.location = "categories";
								}
							});

				</script>';

			}
		}
	}

	/*=============================================
	SHOW CATEGORIES
	=============================================*/

	static public function ctrShowCategories($item, $value){

		$table = "categories";

		$answer = CategoriesModel::mdlShowCategories($table, $item, $value);

		return $answer;
	}

	/*=============================================
	EDIT CATEGORY
	=============================================*/

	static public function ctrEditCategory(){

		if(isset($_POST["editName"]) ){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editName"])){

				$table = "categories";

				$data = array(
					"name"=>$_POST["editName"],
					"description"=>$_POST["editDescription"],
					"prorateo_type"=>$_POST["editProrateoType"],
					"id"=>$_POST["idCategory"]
				);

				$answer = CategoriesModel::mdlEditCategory($table, $data);
				// var_dump($answer);

				if($answer == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Categoría Actualizada",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categories";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "No caracteres especiales o campos en blanco",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categories";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	DELETE CATEGORY
	=============================================*/

	static public function ctrDeleteCategory(){

		if(isset($_GET["idCategory"])){

			$table ="categories";
			$data = $_GET["idCategory"];

			$answer = CategoriesModel::mdlDeleteCategory($table, $data);
			// var_dump($answer);

			if($answer == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido eliminada con éxito",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categories";

									}
								})

					</script>';
			}

		}

	}

}
