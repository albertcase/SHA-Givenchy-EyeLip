

/* 生成视频 */
function uploadFun(_url, _image, _style){
	$.ajax({
	    type: "POST",
	    url: _url,
	    data: {
            "image": _image,
            "style": _style
        },
	    dataType:"json"
	}).done(function(data){
		//console.log(data);
		if(data.code == 1){

		}else if(data.code == 2){
			alert("参数错误");
		}else if(data.code == 3){
			alert("请上传图片");
		}
	})
}



/* 获取作品 */
function getVideoFun(_url, _wid){
	$.ajax({
	    type: "GET",
	    url: _url,
	    data: {
            "id": _wid
        },
	    dataType:"json"
	}).done(function(data){
		//console.log(data);
		if(data.code == 1){
			
		}
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
		console.log(data);
	})
}



/* 第一波留资料 */
function infoFun(_url, _name, _mobile){
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
			
		}else if(data.code == 2){
			alert("参数错误");
		}else if(data.code == 3){
			alert("已经留过资料了");
		}
	})
}


/* 第二波留资料 */
function finishFun(_url, _province, _city, _store){
	$.ajax({
	    type: "POST",
	    url: _url,
	    data: {
            "province": _province,
            "city": _city,
            "store": _store
        },
	    dataType:"json"
	}).done(function(data){
		if(data.code == 1){
			
		}else if(data.code == 2){
			alert("参数错误");
		}else if(data.code == 3){
			alert("未参加上一波活动");
		}else{
			alert("已经兑换过奖品了");
		}
	})
}


/* 兑换奖品 */
function lotteryFun(_url, _lottery){
	$.ajax({
	    type: "POST",
	    url: _url,
	    data: {
            "lottery": _lottery
        },
	    dataType:"json"
	}).done(function(data){
		if(data.code == 1){
			
		}else if(data.code == 2){
			alert("参数错误");
		}else if(data.code == 3){
			alert("非法提交");
		}
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
		if(data.code == 1){
			$("#verification").pupOpen();
		}else if(data.code == 2){
			alert("参数错误");
		}else if(data.code == 3){
			$("#not-participate").pupOpen();
		}else if(data.code == 4){
			$("#has-received").pupOpen();
		}
	})
}


