
require(['jquery'],function($){
	jQuery(document).ready(function(){
		$(".suitab-tooltip-wrap").mouseover(function(){
			$('.suitab-tooltip').text($(this).find('.img-tool-tip').attr('data-title'));
			$('.suitab-tooltip').show();
		}).mouseout(function(){
			$('.suitab-tooltip').hide();
		});
	})
}) 

