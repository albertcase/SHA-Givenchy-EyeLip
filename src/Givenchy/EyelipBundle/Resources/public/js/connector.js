


/* 生成视频 */
function uploadFun(unlockid){
	$.ajax({
	    type: "POST",
	    url: {{ url('givenchy_eyelip_api_upload') }},
	    data: {
            "image1": _image1,
            "image2": _image2,
            "image3": _image3,
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
function getVideoFun(_wid){
	$.ajax({
	    type: "GET",
	    url: {{ url('givenchy_eyelip_api_getvideo') }} + _wid,
	    dataType:"json"
	}).done(function(data){
		//console.log(data);
		if(data.code == 1){
			
		}
	})
}

/* 投票 */
function ballotFun(_wid){
	$.ajax({
	    type: "GET",
	    url: {{ url('givenchy_eyelip_api_ballot') }} + _wid,
	    dataType:"json"
	}).done(function(data){
		console.log(data);
	})
}



/* 第一波留资料 */
function infoFun(_name, _mobile){
	$.ajax({
	    type: "POST",
	    url: {{ url('givenchy_eyelip_api_ballot') }},
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
function finishFun(_province, _city, _store){
	$.ajax({
	    type: "POST",
	    url: {{ url('givenchy_eyelip_api_ballot') }},
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
function lotteryFun(_lottery){
	$.ajax({
	    type: "POST",
	    url: {{ url('givenchy_eyelip_api_ballot') }},
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

/* 奖品是否兑换完 */
function lotterylistFun(){
	$.ajax({
	    type: "POST",
	    url: {{ url('givenchy_eyelip_api_ballot') }},
	    dataType:"json"
	}).done(function(data){
		//console.log(data);
		
	})
}


/* 验证信息 */
function checkFun(_mobile){
	$.ajax({
	    type: "POST",
	    url: {{ url('givenchy_eyelip_api_check') }},
	    data: {
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


