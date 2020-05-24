function page_div(pagina, div){
		$.post(pagina, {}, function(data){
			  $(div).html(data);
					$('#page-loader').fadeOut(500);
				});
	}

	function page_div_x_id(id, pagina, div){

		$.post(pagina, {id:id}, function(data){
			$(div).html(data);
			$('#page-loader').fadeOut(500);
		});
	}

	function showSwal(){
		swal({ title: "Hola que hace",
								 text: 'Programando o que hace',
								 imageUrl: "img/persona1.jpg"}
							  );
	}

	function procs_save_form_confirm_swal(form_name_id, ruta_file_php, div_case, title_swal, text_swal, type_swal){
		swal({
      title: title_swal,
      text: text_swal,
      type: type_swal,
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si",
      cancelButtonText: "No",
      closeOnConfirm: true,
      closeOnCancel: true
  },
  function(isConfirm){
	     if (isConfirm) {
							var formData = new FormData(document.getElementById(form_name_id));
							$.ajax({
										url: ruta_file_php,
										type: "post",
										dataType: "html",
										data: formData,
										cache: false,
										contentType: false,
										processData: false
							 })
								.done(function(data_ingreso){

									switch(div_case){

										case 'form_actualizar_user':
											var hdd_id = document.getElementById("hdd_id").value;

											swal({ title: "Hola que hace",
																	 text: 'Programando o que hace',
																	 imageUrl: "img/persona1.jpg"}
																  );

										page_div('incl/views/users/users.php', '#div_main');

										break;

									} //switch(div_case)
								});
	     }// if (isConfirm){}
    });
	}
