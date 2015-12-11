(function($){
	$(function(){
		$('input, select, number').styler({selectSearch:true});
	});
})(jQuery);

window.currentUri = window.location.href; 
window.addEventListener("popstate",function(e){
	if( window.currentUri != window.location.href ){
		nav(window.location.href,1);
		window.currentUri = window.location.href;
	}
});

var lengthNotify = 0;


$(document).ready(function(){


	$("#content.loader").fadeOut(1000,function(){
		$(this).remove();
		$("#content").fadeIn(1000);
	});
	$(".number").on("keyup",function(){
		var t, v;
		t = $(this);
		v = t.val();
		if ( parseInt(v) > 20 )
			t.val(20);
		else if ( !v )
			t.val(0);
	});
});
function nav(url,back){
	if( typeof url != "string" && url.tagName=="A" )
		url = url.href;
	if( !back )
		window.history.pushState(null,null,url.replace(/\#/ig,"").replace(/(\?|\&)al=1$/ig,""));
	window.currentUri = window.location.href;
	$.ajax({
		url: url.replace(/\#/ig,"")+(url.indexOf("?")>=0?"&":"?")+"al=1",
		type: "post",
		success:function(data){
			$("#content").html(data);
			(function($){
				$(function(){
					$('input, select, number').styler({selectSearch:true});
				});
			})(jQuery);
		}
	});
	$("#content").html("<div class=\'loader\'><div class=\"ajaxload\"></div></div>");
	return false;
}

function newOrder(f, e){
	e.preventDefault();

	var isAllNull = true;

	for (var i = 0, l = f.length; i < l; ++i) {
		if ( parseInt($(f[i]).val()) ) {
			isAllNull = false;
			break;
		};
	};

	if (isAllNull) {
		Notify.setMessage("Ошибка!","Не выбраны товары для заказа", 1, 5000);
		return false;
	};


	f.submit();
	return false;
}

function removeOverlay(){
	$(".overlay").fadeOut(500,function(){
		$(this).remove();
	});
	$(".popup").fadeOut(500,function(){
		$(this).remove();
	});
	return false;
}

function resizeImg(img){

	if ( $(".overlay").length ){
		$(".overlay").fadeOut(500,function(){
			$(this).remove();
		});
		$(".popup").fadeOut(500, function(){
			$(this).remove();
		});
	}

	o = $("<div></div>")
		.attr("onclick", "return removeOverlay()")
		.addClass("overlay");

	b = $("<div></div>")
		.addClass("popup")
		.html("<img src=\""+img+"\" alt=\"img\"/>");
	$("body").prepend(o);
	$("body").prepend(b);
	if ( $(".overlay").length ){ 
		setTimeout(function(){
			$(".overlay").fadeIn(500, function(){
				$(".popup").fadeIn(500);
			});
		},500);
	} else {
		$(".overlay").fadeIn(250, function(){
			$(".popup").fadeIn(250);
		});
	}

}

var Notify = {
	setMessage: function(title,text,autoHide,ms){
		lengthNotify++;
		if($(".notify").length){
			setTimeout(function(){
				$(".notify").fadeOut(500, function(){
					$(this).remove();
				});
			},1500);
			setTimeout(function(){
				$("body").append("<div class=\"notify\"><div class=\"overlay\" onclick=\"return $('.notify').remove();\"></div><div class=\"content\"><div class=\"blockTitle\">" + title + "</div><div class=\"text\">" + text + "</div></div></div>");
				$(".notify").fadeIn(500, function(){
					setTimeout(function(){
						$(".notify").fadeOut(500, function(){
							$(this).remove();
						});
					},1500);
				});
			},( lengthNotify? 2500 * lengthNotify : 2500 ));
		}else{
			$("body").append("<div class=\"notify\"><div class=\"overlay\" onclick=\"return $('.notify').remove();\"></div><div class=\"content\"><div class=\"blockTitle\">" + title + "</div><div class=\"text\">" + text + "</div></div></div>");					
			if(autoHide){
				$(".notify").fadeIn(500, function(){
					setTimeout(function(){
						$(".notify").fadeOut(500, function(){
							$(this).remove();
						});
					},2500);
				});
			}else
				$(".notify").fadeIn(500);
		}
		if(autoHide)
			Notify.close(ms);
	},
	close: function(ms){
		setTimeout(function(){
			$(".notify").fadeOut(250, function(){
				$(this).remove();
			});
		},ms);
	}
}