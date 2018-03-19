
$(function() {

	// 载入界面函数
	function loadPage(method) {
		var baseurl = $('#data').data('url');
		$.get(baseurl +'/'+ method, function(data) {
			$('#pc-container').html(data);
		});
	}

	// 初始化Nav
	if (location.hash.localeCompare('') == 0) {
		$('#pc-nav>a:eq(0)').addClass('active');
		loadPage('basicInfo');
	} else {
		$('#pc-nav>a').each(function() {
			if ($(this).attr('href').localeCompare(location.hash) == 0) {
				$(this).addClass('active');

				var rawHref = $(this).attr('href'); 
				var method = rawHref.substring(1, rawHref.length);
				loadPage(method);
			}
		});
	}
	

	// Nav点击效果
	$('#pc-nav').on('click', 'a', function() {
		$('#pc-nav a').removeClass('active');
		$(this).addClass('active');

		var rawHref = $(this).attr('href'); 
		var method = rawHref.substring(1, rawHref.length);
		loadPage(method);
	});


});



