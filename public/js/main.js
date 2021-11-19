var url = 'http://localhost/Proyecto/proyecto-laravel2/public/';
window.addEventListener("load", function(){
	
	$('.btn-like').css('cursor', 'pointer');
	$('.btn-dislike').css('cursor', 'pointer');
	
	// Botón de like
	function like(){
		$('.btn-like').unbind('click').click(function(){
			console.log('like');
			$(this).addClass('btn-dislike').removeClass('btn-like');
			$(this).attr('src', 'http://localhost/Proyecto/proyecto-laravel2/public/img/heart-red.png');
			
			$.ajax({
				url: 'http://localhost/Proyecto/proyecto-laravel2/public/like/'+$(this).data('id'),
				type: 'GET',
				success: function(response){
					if(response.like){
						console.log('Has dado like a la publicacion');
					}else{
						console.log('Error al dar like');
					}
				}
			});
			
			dislike();
		});
	}
	like();
	
	// Botón de dislike
	function dislike(){
		$('.btn-dislike').unbind('click').click(function(){
			console.log('dislike');
			$(this).addClass('btn-like').removeClass('btn-dislike');
			$(this).attr('src', 'http://localhost/Proyecto/proyecto-laravel2/public/img/heart-black.png');
			
			$.ajax({
				url: 'http://localhost/Proyecto/proyecto-laravel2/public/dislike/'+$(this).data('id'),
				type: 'GET',
				success: function(response){
					if(response.like){
						console.log('Has dado dislike a la publicacion');
					}else{
						console.log('Error al dar dislike');
					}
				}
			});
			
			like();
		});
	}
	dislike();
	
	// BUSCADOR
	$('#buscador').submit(function(e){
		$(this).attr('action','http://localhost/Proyecto/proyecto-laravel2/public/gente/'+$('#buscador #search').val());
	});
	
});