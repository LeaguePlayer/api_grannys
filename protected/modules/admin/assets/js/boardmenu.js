// JavaScript Document

function showHideDelButtons()
{
	var cnt = $('.place_c .controls').size();
	
	if(cnt==1)
	{
		// скрываем кнопки
		$('.del_row').hide();
	}
	else
	{
		// показываем кнопки	
		$('.del_row').show();
	}
}

$(document).ready(function(e) {
    
	showHideDelButtons();
	
	$('.add_row').click(function() {
		
			var parent_div = $(this).parents('.control-group');
			var block = $(parent_div).find('.controls:first-child').clone();
			//alert(block);
			block.find('input').val("");
			$(parent_div).find('.place_c').append(block);
			showHideDelButtons();
		});
	
	
	$('.place_c').on("click", ".del_row", function(e) {
			
		
			if (confirm('Точно удалить позицию?')) { 
				 $(e.target).parent('.controls').remove();
				 showHideDelButtons();
				}
			
			
			return false;
		});
	
});