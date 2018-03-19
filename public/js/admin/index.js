$(function () {
	$("ul#main-nav>li").on("click", function () {
		var str = $(this).find("a[target!='iframe_a']").html();
		var str =str.replace(/\s<span.*/,"");
		$(".menu1").html(str);
		$(".menu2").html('');
		//alert('ss');
	});
	$("#main-nav").on("click", "a[target='iframe_a']", function () {
		var str = $(this).html();
		$(".menu2").html(str);
		console.log(str);
	})
});