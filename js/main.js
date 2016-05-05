$.fn.smartFloat = function(h) {
	var position = function(element) {
		var top = element.position().top, pos = element.css("position");
		$(window).scroll(function() {
			var scrolls = $(this).scrollTop();
			var newTop	= top + h;
			if (scrolls > newTop) {
				if (window.XMLHttpRequest) {
					element.css({
						position: "fixed",
						top: 0
					});	
				} else {
					element.css({
						top: scrolls
					});	
				}
			}else {
				element.css({
					position: pos,
					top: top
				});	
			}
		});
};
	return $(this).each(function() {
		position($(this));						 
	});
};

function DrawImage(ImgD,width_s,height_s){
	var image=new Image();
	image.src=ImgD.src;
	if(image.width>0 && image.height>0){
		flag=true;
		if(image.width/image.height>=width_s/height_s){
			if(image.width>width_s){
				ImgD.width=width_s;
				ImgD.height=(image.height*width_s)/image.width;
			}else{
			ImgD.width=image.width;
			ImgD.height=image.height;
			}
		}
	else{
		if(image.height>height_s){
		ImgD.height=height_s;
		ImgD.width=(image.width*height_s)/image.height;
		}else{
				ImgD.width=image.width;
				ImgD.height=image.height;
			}
		}
	}
}