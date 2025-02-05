/*=============================================
EDIT CATEGORY
=============================================*/

$(".tables").on("click", ".btnEditCategory", function(){

	var idCategory = $(this).attr("idCategory");

	var datum = new FormData();
	datum.append("idCategory", idCategory);

	$.ajax({
		url: "ajax/categories.ajax.php",
		method: "POST",
      	data: datum,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(answer){

     		// console.log("answer", answer);
     		$("#idCategory").val(answer["id"]);
     		$("#editName").val(answer["name"]);
     		$("#editDescription").val(answer["description"]);
 			$("#editProrateoType").html(answer["editProrateoType"]);
 			$("#editProrateoType").val(answer["prorateo_type"]);


     	}

	})

})

/*=============================================
DELETE CATEGORY
=============================================*/
$(".tables").on("click", ".btnDeleteCategory", function(){

	 var idCategory = $(this).attr("idCategory");

	 swal({
	 	title: '¿Está seguro que desea eliminar la categoría?',
		text: "¡si Ud. no está seguro, puede cancelar",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, eliminar categoría!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?route=categories&idCategory="+idCategory;

	 	}

	 })

})
