(function ($) {
	
	//Função utilizada quando não tem um área de serviço que o usuário deseja,
	//e selecionando a opção 'outro' e exibindo o campo para digitar a área desejada
	$(document).ready(function(){
		
		$("select#id_area").change(function () {
			//alert($("#id_area option:selected").val());
			var option = $("select#id_area option:selected").val();
			
			if(option == "outro"){
				$("div#campoArea").fadeIn('slow');
			}else{
				$("div#campoArea").fadeOut('slow');
			}
		  
		})
		.trigger('change');

		$("select#id_areaMobile").change(function () {
			//alert($("#id_area option:selected").val());
			var option = $("select#id_areaMobile option:selected").val();
			
			if(option == "outro"){
				$("div#campoAreaMobile").fadeIn('slow');
			}else{
				$("div#campoAreaMobile").fadeOut('slow');
			}
		  
		})
		.trigger('change');

	});
	

}(jQuery));