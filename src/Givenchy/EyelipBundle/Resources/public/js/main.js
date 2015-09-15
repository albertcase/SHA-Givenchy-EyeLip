/*! main.js */


document.addEventListener('touchmove' , function (ev){
  ev.preventDefault();
  return false;
} , false)


function _loading(){
			
	var loader = new WxMoment.Loader();

	    //添加一个资源
	    loader.addImage('/images/arr-l.png');
	    loader.addImage('/images/arr-r.png');
	    loader.addImage('/images/arr-white.png');
	    loader.addImage('/images/cg_bg.png');
	    loader.addImage('/images/cg_mask.png');
	    loader.addImage('/images/click_exchange_btn.png');
	    loader.addImage('/images/close.png');
	    loader.addImage('/images/commission_btn.png');
	    loader.addImage('/images/confirm_btn.png');
	    loader.addImage('/images/confirm_submit.png');
	    loader.addImage('/images/congratulations.png');
	    loader.addImage('/images/do_btn.png');
	    loader.addImage('/images/enjoy_btn.png');
	    loader.addImage('/images/error-1-text.png');
	    loader.addImage('/images/error-2-text.png');
	    loader.addImage('/images/exchange_btn.png');
	    loader.addImage('/images/exchange_rule.png');
	    loader.addImage('/images/exchangelink.png');
	    loader.addImage('/images/f5.jpg');
	    loader.addImage('/images/ft-1.png');
	    loader.addImage('/images/heart-red.png');
	    loader.addImage('/images/heart.png');
	    loader.addImage('/images/hengping.png');
	    loader.addImage('/images/holder_arr.png');
	    loader.addImage('/images/holder_text.png');
	    loader.addImage('/images/holder.jpg');
	    loader.addImage('/images/index_bg.jpg');
	    loader.addImage('/images/index_bg2.jpg');
	    loader.addImage('/images/infoText.png');
	    loader.addImage('/images/l-1.png');
	    loader.addImage('/images/l-2.png');
	    loader.addImage('/images/l-3.png');
	    loader.addImage('/images/l-4.png');
	    loader.addImage('/images/l-5.png');
	    loader.addImage('/images/l-6.png');
	    loader.addImage('/images/l-7.png');
	    loader.addImage('/images/l-8.png');
	    loader.addImage('/images/l-9.png');
	    loader.addImage('/images/l-10.png');
	    loader.addImage('/images/l-11.png');
	    loader.addImage('/images/l-12.png');
	    loader.addImage('/images/loading_logo.png');
	    loader.addImage('/images/logo.png');
	    loader.addImage('/images/open_btn.png');
	    loader.addImage('/images/place.jpg');
	    loader.addImage('/images/placeholder.png');
	    loader.addImage('/images/play.png');
	    loader.addImage('/images/prize_title.png');
	    loader.addImage('/images/prize-1.jpg');
	    loader.addImage('/images/prize-2.jpg');
	    loader.addImage('/images/prize-3.jpg');
	    loader.addImage('/images/receive_rulecon.png');
	    loader.addImage('/images/rule.png');
	    loader.addImage('/images/search-btn.png');
	    loader.addImage('/images/secondrule.png');
	    loader.addImage('/images/slogan.png');
	    loader.addImage('/images/sorry.png');
	    loader.addImage('/images/style_title.png');
	    loader.addImage('/images/upload_btn.png');
	    loader.addImage('/images/upload_place.png');
	    loader.addImage('/images/wechat_tips.png');
	    loader.addImage('/images/writeBtn.png');

	    loader.addImage('/images/pro/p1/people.jpg');
	    loader.addImage('/images/pro/p1/pro.png');
	    loader.addImage('/images/pro/p2/people.jpg');
	    loader.addImage('/images/pro/p2/pro.png');
	    loader.addImage('/images/pro/p3/people.jpg');
	    loader.addImage('/images/pro/p3/pro.png');
	    loader.addImage('/images/pro/p4/people.jpg');
	    loader.addImage('/images/pro/p4/pro.png');
	    loader.addImage('/images/pro/p5/people.jpg');
	    loader.addImage('/images/pro/p5/pro.png');
	    loader.addImage('/images/pro/p6/people.jpg');
	    loader.addImage('/images/pro/p6/pro.png');
	    loader.addImage('/images/pro/p7/people.jpg');
	    loader.addImage('/images/pro/p7/pro.png');
	    loader.addImage('/images/pro/p8/people.jpg');
	    loader.addImage('/images/pro/p8/pro.png');


	    //监听资源加载完成事件
	    loader.addCompletionListener(function () {
	    	$("#loading").hide();
	        console.log('加载完成');
	    });

		loader.addProgressListener(function(e) {
				//var percent = Math.round( e.completedCount / e.totalCount * 100 );
				//$(".loading").css({"width":percent+"%"});
				//$(".process").css({"width": percent+"%"});
		});
		
	    //启动资源加载管理器
	    loader.start();
	}



;(function($){
    $(function(){

    	_loading();

        var vidArr = ["y0017r6gqnw"];
        var vPic = ["/images/poster.jpg"]

		var player;
		var videoWidth = document.body.clientWidth*0.9;
		var videoHeight = videoWidth * (1080 / 1920);

		$(".video").css({"height":videoHeight});

		var videoFun = function(n){
			var video = new tvp.VideoInfo(); 
			video.setVid(vidArr[n]);
			player = new tvp.Player(); 
			player.create({
				width: videoWidth + 'px',
				height: videoHeight + 'px',
				video: video,
				pic: vPic[n],
				modId:"mod_player", //mod_player是刚刚在页面添加的div容器 autoplay:true
				onallended: function () {
		            //播放器播放完毕时
		            $(".holder").fadeIn();
		            videoFun("0");
		        },
		        onpause: function () {
		            //播放器触发暂停时，目前只针对HTML5播放器有效
		            $(".holder").fadeIn();
		            videoFun("0");
		        },

			});

			$(".holder").click(function(){
				$(".holder").hide();
				player.play();
			})

			// $(".logo").click(function(){
	  //       	 player.enterFullScreen();
	  //       	 player.play();
	  //       })
		}


		videoFun("0");

        $(".search-btn").click(function(){
        	videoFun("0");
			changePage('product', productlist);
		})


 	})

})(jQuery)












