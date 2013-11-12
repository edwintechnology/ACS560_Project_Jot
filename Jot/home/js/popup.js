var popupFlag = 0;

function loadPopup(){
	if(popupFlag == 0){
	$(".background").css({
	"opacity": "0.9"
	});
	$(".background").fadeIn("slow");
    $(".upload").fadeIn("slow");
	popupFlag = 1;
	}
}

function disablePopup(){
	if(popupFlag == 1){
	$(".background").fadeOut("slow");
	$(".upload").fadeOut("slow");
	popupFlag = 0;
	}
}

function centerPopup(){
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $(".upload").height();
	var popupWidth = $(".upload").width();

	$(".upload").css({
		"position": "absolute",
		"top": windowHeight/2-popupHeight/2,
		"left": windowWidth/2-popupWidth/2
	});

	$(".background").css({
		"height": windowHeight
	});
}

$(document).ready(function () {
    $("#cancel-btn").click(function(){
	disablePopup();
	});	
    $("#upload-btn").click(function () {
        centerPopup();
        loadPopup();
    });
    $(".magnifyClose").click(function () {
        disablePopup();
    });
    $(".background").click(function () {
        disablePopup();
    });
    $(document).keyup(function (e) {
        if (e.keyCode == 27) {
            disablePopup();
        }
    });
});
