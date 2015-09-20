/*! main.js */
var pro_data = [
		{
			"title": "悠扬海上夜曲",
			"info": "海蓝眼影，几何线条，增添眼部结构感；<br />自然裸色，弱化唇妆，凸显眼妆个性感。"
		},
		{
			"title": "炫魅派对之吻",
			"info": "玩转色彩，深邃炫目，感受电眼魅力；<br />明丽玫瑰，活泼爽快，营造派对气氛。"
		},
		{
			"title": "铿锵摇滚玫瑰",
			"info": "飞扬眼妆，灰黑酷劲，秀出真我个性；<br />经典裸唇，贴近本色，尽显眼妆张力。"
		},
		{
			"title": "精致通勤女郎",
			"info": "沉静灰色，知性气质，双眼深邃有神；<br />经典魅红，增加亮色，提升自信气场。"
		},
		{
			"title": "俏皮小猫公主",
			"info": "紫色眼线，藕荷眼影，墨绿点缀，明亮眼眸；<br />玫瑰粉红，对比眼妆，摩登职业，优雅干练。"
		},
		{
			"title": "职场个性先锋",
			"info": "金灰碰撞，烟熏眼妆，凸显深邃眼神；<br />朱砂红唇，点亮肤色，倍感干练自信。"
		},
		{
			"title": "浪漫珊瑚女神",
			"info": "柔和咖啡，淡雅香槟，打造明亮双眸；<br />珊瑚唇色，轻松上妆，散发亲和魅力。"
		},
		{
			"title": "清新假日阳光",
			"info": "灰绿配暖橘眼影，适合亚洲肤色；<br />甜心粉红色唇妆，更显肌肤白皙。"
		}
	] 








// document.addEventListener('touchmove' , function (ev){
//   ev.preventDefault();
//   return false;
// } , false)


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
	    loader.addImage('/images/create_btn.png');
	    loader.addImage('/images/share_btn.png');
	    loader.addImage('/images/share.jpg');

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

        var vidArr = ["m0018qv0vlz"];
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
				player.enterFullScreen();
				player.play();
				_hmt.push(['_trackEvent', 'btn', '视频播放按钮']);
			})

			// $(".logo").click(function(){
	  //       	 player.enterFullScreen();
	  //       	 player.play();
	  //       })
		}


		videoFun("0");

        $(".search-btn").click(function(){
        	_hmt.push(['_trackEvent', 'btn', '探索妆容按钮']);
        	videoFun("0");
        	$(".back-1-btn").attr("data-prev","index").show();;
			changePage('product', productlist);
		})


 	})

})(jQuery)












