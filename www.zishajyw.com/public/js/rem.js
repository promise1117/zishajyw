$(function() {
	function setRem() {
		var clientWidth = $(window).width();
		var nowRem = (clientWidth / 375 * 10);
		if (nowRem > 16) {
			$("html").css("font-size", parseInt(16) + "px");
		} else if (nowRem < 10){
			$("html").css("font-size", parseInt(12) + "px");
		} else {
			$("html").css("font-size", parseInt(nowRem, 12) + "px");
		}
	};
	setRem();

	var timer;
	$(window).bind("resize", function() {
		clearTimeout(timer)
		timer = setTimeout(function() {
			setRem();
		}, 100)
	})
});
