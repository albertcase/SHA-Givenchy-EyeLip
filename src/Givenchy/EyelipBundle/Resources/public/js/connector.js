

/* 生成视频 */
function uploadFun(_url, _image, _style, _tzlink){
	$.ajax({
	    type: "POST",
	    url: _url,
	    data: {
            "image": _image,
            "style": _style
        },
	    dataType:"json"
	}).done(function(data){
		$(".uploadloading").hide();

		if(data.code == 1){
			window.location.href = _tzlink + "?id=" + data.msg;
		}else if(data.code == 2){
			alert("参数错误");
		}else if(data.code == 3){
			alert("生成失败，请重新生成");
		}
	}).fail(function(){
		alert("加载出错！请重新加载。");
	})
}



/* 获取作品 */
function getVideoFun(_url, _wid, _finFun){
	$.ajax({
	    type: "POST",
	    url: _url,
	    data: {
            "id": _wid
        },
	    dataType:"json"
	}).done(function(data){
		//console.log(data);
		if(data.code == 1){
			if(_finFun){
				_finFun(data.msg.url);
				$("#ballotNum em").html(data.msg.ballot);
				$("#videoposter").attr("src","/images/poster-"+data.msg.style+".jpg");
				if(data.msg.ismy == 1){
					$(".result_share_btn").css("display","inline-block");
				}else{
					$(".heart").removeClass("disabled");
					$(".enjoy_btn").css("display","inline-block");
				}
			}
		}else{
			alert(data.msg);
		}

	}).fail(function(){
		alert("加载出错！请重新加载。");
	})
}

/* 投票 */
function ballotFun(_url, _wid){
	$.ajax({
	    type: "POST",
	    url: _url,
	    data: {
            "id": _wid
        },
	    dataType:"json"
	}).done(function(data){
		//console.log(data);
		if(data.code == 1){
			$(".heart img").attr("src","/images/heart-red.png");
			var islikenum = parseInt($("#ballotNum em").html());
			$("#ballotNum em").html(islikenum+1);
			alert("点赞成功");
		}else{
			alert(data.msg);
		}
	}).fail(function(){
		alert("加载出错！请重新加载。");
	})
}



/* 第一波留资料 */
function infoFun(_url, _name, _mobile, _finFun){
	$.ajax({
	    type: "POST",
	    url: _url,
	    data: {
            "name": _name,
            "mobile": _mobile
        },
	    dataType:"json"
	}).done(function(data){
		if(data.code == 1){
			if(_finFun){
				_finFun();
			}
		}else if(data.code == 2){
			alert("参数错误");
		}else if(data.code == 3){
			alert("已经留过资料了");
		}
	}).fail(function(){
		alert("加载出错！请重新加载。");
	})
}


/* 第二波留资料 */
function storeFun(_url, _province, _city, _store, _lottery){
	$.ajax({
	    type: "POST",
	    url: _url,
	    data: {
            "province": _province,
            "city": _city,
            "store": _store,
            "lottery":_lottery
        },
	    dataType:"json"
	}).done(function(data){
		$(".uploadloading").hide();
		if(data.code == 1){
			$("#congratulations").pupOpen(); 
		}else if(data.code == 2){
			alert("参数错误");
		}else if(data.code == 3){
			alert("未参加上一波活动");
		}else{
			alert("已经兑换过奖品了");
		}
	}).fail(function(){
		$(".uploadloading").hide();
		alert("加载出错！请重新加载。");
	})
}


/* 验证信息 */
function checkFun(_url, _name, _mobile){
	$.ajax({
	    type: "POST",
	    url: _url,
	    data: {
	    	"name": _name,
            "mobile": _mobile
        },
	    dataType:"json"
	}).done(function(data){
		//console.log(data);
		$(".uploadloading").hide();
		if(data.code == 1){
			$(".finHeart em").html(data.ballot);
			$(".exchange_btn").attr("data-type", data.canballot);
			changePage('heartShow');

			//$("#verification").pupOpen();
		}else{
			alert(data.msg)
		}
	}).fail(function(){
		$(".uploadloading").hide();
		alert("加载出错！请重新加载。");
	})
}


