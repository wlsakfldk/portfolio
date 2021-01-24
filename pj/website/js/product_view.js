$(document).ready(function(){
	$(".pd_fav").click(function(){
		var $rel = $(this).attr("rel");

		$.ajax({
			url : './product_fav.php?num='+$rel,
			type : 'GET',
			cache : false,
			success : function(data){
				console.log(data);  //7
				$(".pd_fav span").text(data);
			}
		});
		return false;
	});

});