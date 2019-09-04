var e104aidma_idno=',5042,5044';var e104aidma_b={"b_570":{"s_1":{"pic_height":"60","pic_weight":"400"}}};
var e104aidma_m={"b_570":{"content":[{"id":"45836","spec_type":"1","type":"1","pic_filename":"1_45836.jpg","link":"http://www.104.com.tw/jb/service/ad/TransferAddress?trnid=adn_54032&jobsource=570_1_45836_","outside_link":"0"}]}};

function e104aidma_show(elementid,webid,channelid,boardid,preview,viewclick){
	var url = '';
	var swfPlayer = '';
	var flvPlayer = '';

	swfPlayer = 'https://static.104.com.tw/aidma/player/swfplayer.swf';
	flashPlayer = 'https://static.104.com.tw/aidma/player/flvplayer.swf';

	//判斷是否為後台預覽
	if(preview){
		url = 'https://static.104.com.tw/aidma/material/temp/';
	}else{
		url = 'https://static.104.com.tw/aidma/material/'+ channelid + '/' + boardid +'/';
	}
	if(document.getElementById(elementid) == null)
		return;
	var element = document.getElementById(elementid);
	//判斷是否為精準, 如為精準需過濾配對完資料
	var m10 = false;
	try{
		if(eval('e104aidma_b.b_'+boardid+'.length') == 0)
		return;
		if(typeof e104aidma_idno != 'undefined' && e104aidma_idno != ''){
			try{
				if(eval('e104aidma_m10.b_'+boardid+'.content.length') != 0){
					var tmp = eval('e104aidma_m10.b_'+boardid+'.content');
					var needDel = true;
					for(var n = tmp.length; n > 0; n--){
						needDel = true;
						for(var i = 0; i < e104aidma_idno.split(',').length; i++){
							if(tmp[n-1].id == e104aidma_idno.split(',')[i]){
								needDel = false;
								break;
							}
						}
						if(needDel){
							tmp.splice(n-1,1);
						}
					}
					if(tmp.length != 0)
						m10 = true;
				}
			}catch(e){};
		}
		if(!m10){
			if(eval('e104aidma_m.b_'+boardid+'.content.length') == 0){
				return;
			}
		}
	}catch(e){return};
	//亂數抓取一筆素材
	var mid;
	var content;
	if(m10){
		mid = Math.ceil(Math.random()*eval('e104aidma_m10.b_'+boardid+'.content.length')) - 1;
		content = eval('e104aidma_m10.b_'+boardid+'.content['+mid+']');
	}else{
		mid = Math.ceil(Math.random()*eval('e104aidma_m.b_'+boardid+'.content.length')) - 1;
		content = eval('e104aidma_m.b_'+boardid+'.content['+mid+']');
	}
	//讀取版位樣式資訊
	var board = eval('e104aidma_b.b_'+boardid+'.s_'+content.spec_type);
	if (content.spec_type == 15){
		e104aidma_type15Show(elementid,webid,channelid,boardid,preview,viewclick);
	}
	else{
		//產生click相關參數(type 11,12不適用, 因type 11,12為一次顯示多素材)
		var js_click_parameters = '\''+elementid+','+webid+','+channelid+','+boardid+','+content.spec_type+','+content.id+','+content.link+','+viewclick+','+content.outside_link+'\'';
		element.innerHTML = '';
		var htmlCode = '';
		//Process ad html
		switch(content.spec_type){
			case "1":
				if(content.pic_filename.substring(content.pic_filename.length-3,content.pic_filename.length) == 'swf'){
					htmlCode += e104aidma_generateFlash(board.pic_weight,board.pic_height,swfPlayer,'swfPath='+url+content.pic_filename+'&callBackFunction=e104aidma_clickByFlash&callBackParameters='+js_click_parameters.replace(/&/g,'@@@'));
				}else{
					htmlCode += '<a href="javascript:e104aidma_click('+js_click_parameters +');"><img width="'+board.pic_weight+'" height="'+board.pic_height+'" src="'+url+content.pic_filename+'" border="0"></a>';
				}
				break;
			case "2":
				var rtn = '';
				if(board.marquee=="1")
					rtn += '<marquee>';
				rtn += '<a href="javascript:e104aidma_click('+js_click_parameters +');" >'+content.word+'</a>';
				if(board.marquee=="1")
					rtn += '</marquee>';
				htmlCode = rtn;
				break;
			case "3":
				htmlCode += '<a href="javascript:e104aidma_click('+js_click_parameters +');" style="float:left;"><img src="'+url+content.pic_filename+'" width="'+board.pic_weight+'" height="'+board.pic_height+'" border="0"></a><a href="javascript:e104aidma_click('+js_click_parameters +');">'+content.word+'</a>';
				break;
			case "4":
				htmlCode += '<a href="javascript:e104aidma_click('+js_click_parameters +');" style="float:left;"><img src="'+url+content.pic_filename+'" width="'+board.pic_weight+'" height="'+board.pic_height+'" border="0"></a><h3><a href="javascript:e104aidma_click('+js_click_parameters +');">'+content.title+'</a></h3><p><a href="javascript:e104aidma_click('+js_click_parameters +');">'+content.word+'</a></p>';
				break;
			case "5":
				htmlCode += '<h3><a href="javascript:e104aidma_click('+js_click_parameters +');">'+content.title+'</a></h3><a href="javascript:e104aidma_click('+js_click_parameters +');" style="float:left;"><img src="'+url+content.pic_filename+'" width="'+board.pic_weight+'" height="'+board.pic_height+'" border="0"></a><p><a href="javascript:e104aidma_click('+js_click_parameters +');">'+content.word+'</a></p>';
				break;
			case "6":
				htmlCode += '<h3><a href="javascript:e104aidma_click('+js_click_parameters +');">'+content.title+'</a></h3><a href="javascript:e104aidma_click('+js_click_parameters +');" style="float:right;"><img src="'+url+content.pic_filename+'" width="'+board.pic_weight+'" height="'+board.pic_height+'" border="0"></a><p><a href="javascript:e104aidma_click('+js_click_parameters +');">'+content.word+'</a></p>';
				break;
			case "7":
				htmlCode += '<h3><a href="javascript:e104aidma_click('+js_click_parameters +');">'+content.title+'</a></h3><p><a href="javascript:e104aidma_click('+js_click_parameters +');">'+content.word+'</a></p>';
				break;
			case "8":
				htmlCode += e104aidma_generateFlash(board.flv_weight,board.flv_height,flashPlayer,'imagePath='+url+content.pic_filename+'&videoPath='+url+content.flv_filename+'&callBackFunction=e104aidma_clickByFlash&callBackParameters='+js_click_parameters.replace(/&/g,'@@@'));
				break;
			case "9":
				var rtnHTML = '';
				rtnHTML += '<ul>';
				for(var i = 1; i <= parseInt(board.line_count); i++){
					js_click_parameters = '\''+elementid+','+webid+','+channelid+','+boardid+','+content.spec_type+','+content.id+','+eval('content.link'+i)+','+viewclick+','+eval('content.outside_link'+i)+'\'';
					if(eval('content.word'+i) != null && eval('content.word'+i) != 'undefined' && eval('content.word'+i) != ''){
						rtnHTML += '<li><a href="javascript:e104aidma_click('+js_click_parameters +');">'+eval('content.word'+i)+'</a></li>';
					}
				}
				rtnHTML += '</ul>';
				htmlCode = rtnHTML;
				break;
			case "10":
				var hasAlt = '';
				if(typeof(content.pic_alt) != 'undefined' && content.pic_alt != ''){
					hasAlt = 'alt="'+content.pic_alt+'" title="'+content.pic_alt+'" ';
				}
				if(content.pic_filename.substring(content.pic_filename.length-3,content.pic_filename.length) == 'swf'){
					htmlCode += e104aidma_generateFlash(board.pic_weight,board.pic_height,swfPlayer,'swfPath='+url+content.pic_filename+'&callBackFunction=e104aidma_clickByFlash&callBackParameters='+js_click_parameters.replace(/&/g,'@@@'));
				}else{
					htmlCode += '<a href="javascript:e104aidma_click('+js_click_parameters +');"><img '+hasAlt+'width="'+board.pic_weight+'" height="'+board.pic_height+'" border="0" src="'+url+content.pic_filename+'"></a>';
				}
				break;
			case "11":
				var tmp=0;
                var adLength = eval('e104aidma_m.b_'+boardid+'.content.length');
                var ctrlDisplay = (adLength <= 1)?'none':'block';
				htmlCode += '<div class="aidma_11" style="width:'+board.pic_weight+'px;height:'+(parseInt(board.pic_height))+'px;"><ul class="itemList" id="aidma_11_'+boardid+'">';
				for(var i = 0; i < adLength; i++){
					if(eval('e104aidma_m.b_'+boardid+'.content['+i+'].spec_type') == "11"){
						tmp++;
						js_click_parameters = '\''+elementid+','+webid+','+channelid+','+boardid+','+eval('e104aidma_m.b_'+boardid+'.content['+i+'].spec_type')+','+eval('e104aidma_m.b_'+boardid+'.content['+i+'].id')+','+eval('e104aidma_m.b_'+boardid+'.content['+i+'].link')+','+viewclick+','+eval('e104aidma_m.b_'+boardid+'.content['+i+'].outside_link')+'\'';
						htmlCode += '<li>';
						//Check swf or image
						if(eval('e104aidma_m.b_'+boardid+'.content['+i+'].pic_filename').substring(eval('e104aidma_m.b_'+boardid+'.content['+i+'].pic_filename').length-3,eval('e104aidma_m.b_'+boardid+'.content['+i+'].pic_filename').length) == 'swf'){
							htmlCode += e104aidma_generateFlash(board.pic_weight,board.pic_height,swfPlayer,'swfPath='+url+eval('e104aidma_m.b_'+boardid+'.content['+i+'].pic_filename')+'&callBackFunction=e104aidma_clickByFlash&callBackParameters='+js_click_parameters.replace(/&/g,'@@@'));
						}else{
							htmlCode += '<a href="javascript:e104aidma_click('+js_click_parameters +');"><img width="'+board.pic_weight+'" height="'+board.pic_height+'" src="'+url+eval('e104aidma_m.b_'+boardid+'.content['+i+'].pic_filename')+'" border="0"></a>';
						}


						if(viewclick)
							htmlCode += e104aidma_generateImgView(elementid,webid,channelid,boardid,eval('e104aidma_m.b_'+boardid+'.content['+i+'].spec_type'),eval('e104aidma_m.b_'+boardid+'.content['+i+'].id'),viewclick);
						htmlCode += '</li>';
					}
				}
				htmlCode += '</ul>';
				//htmlCode += '<div class="roll" id="aidma_11_'+boardid+'_ctl" style="top:'+(parseInt(board.pic_height)+20-15)+'px;">';
				/*for(var i = 0; i < tmp; i++){
					htmlCode += '<a href="javascript:void(0);">'+(i+1)+'</a>';
				}*/
				htmlCode += '<div class="btn" id="aidma_11_'+boardid+'_ctl" style="display:'+ctrlDisplay+';">';
				htmlCode += '<a href="javascript:e104aidma_type11ClickChange('+boardid+','+tmp+',-1);" class="prev">Prev</a>';
				htmlCode += '<a href="javascript:e104aidma_type11ClickChange('+boardid+','+tmp+',1);" class="next">Next</a>';
				htmlCode += '</div></div>';
				break;
			case "12":
				var tmp=0;
				htmlCode += '<div id="aidma_12_'+boardid+'" class="aidma_12"><ul>';
				for(var i = 0; i < eval('e104aidma_m.b_'+boardid+'.content.length'); i++){
					if(eval('e104aidma_m.b_'+boardid+'.content['+i+'].spec_type') == "12"){
						tmp++;
						//Generate js click parameters
						js_click_parameters = '\''+elementid+','+webid+','+channelid+','+boardid+','+eval('e104aidma_m.b_'+boardid+'.content['+i+'].spec_type')+','+eval('e104aidma_m.b_'+boardid+'.content['+i+'].id')+','+eval('e104aidma_m.b_'+boardid+'.content['+i+'].word_link')+','+viewclick+','+eval('e104aidma_m.b_'+boardid+'.content['+i+'].word_outside_link')+'\'';
						htmlCode += '<li class="aidma_12_header"><a href="javascript:e104aidma_click('+js_click_parameters +');">'+eval('e104aidma_m.b_'+boardid+'.content['+i+'].word')+'</a></li><li class="none_list">';
						//Check swf or image
						if(eval('e104aidma_m.b_'+boardid+'.content['+i+'].pic_filename').substring(eval('e104aidma_m.b_'+boardid+'.content['+i+'].pic_filename').length-3,eval('e104aidma_m.b_'+boardid+'.content['+i+'].pic_filename').length) == 'swf'){
							htmlCode += e104aidma_generateFlash(board.pic_weight,board.pic_height,swfPlayer,'swfPath='+url+eval('e104aidma_m.b_'+boardid+'.content['+i+'].pic_filename')+'&callBackFunction=e104aidma_clickByFlash&callBackParameters='+js_click_parameters.replace(/&/g,'@@@'));
						}else{
							htmlCode += '<a href="javascript:e104aidma_click('+js_click_parameters +');"><img width="'+board.pic_weight+'" height="'+board.pic_height+'" src="'+url+eval('e104aidma_m.b_'+boardid+'.content['+i+'].pic_filename')+'" border="0"></a>';
						}
						//Content view generate!
						if(viewclick)
							htmlCode += e104aidma_generateImgView(elementid,webid,channelid,boardid,eval('e104aidma_m.b_'+boardid+'.content['+i+'].spec_type'),eval('e104aidma_m.b_'+boardid+'.content['+i+'].id'),viewclick);
						htmlCode += '</li>';
					}
				}
				htmlCode += '</ul></div>';
				break;
			case "13":
				js_click_parameters = '\''+elementid+','+webid+','+channelid+','+boardid+','+content.spec_type+','+content.id+','+content.title_link+','+viewclick+','+content.title_outside_link+'\'';
				if(board.line_count == 0){	//無多則文字, 切換為無滑動效果
					htmlCode += '<ul class="aidma_13_2"><li><div class="aidma_13_2_li" style="width:'+board.pic_weight+'px;height:'+board.pic_height+'px;"><a href="javascript:e104aidma_click('+js_click_parameters +');"><img width="'+board.pic_weight+'" height="'+board.pic_height+'" src="'+url+content.pic_filename+'" /></a> <div class="caption" style="width:'+board.pic_weight+'px;"><a href="javascript:e104aidma_click('+js_click_parameters +');">'+content.title+'</a></div></div></li></ul>'
				}else{						//多則文字, 使用滑動效果
					htmlCode += '<div id="aidma_13_1_'+boardid+'" class="aidma_13_1" style="width:'+board.pic_weight+'px;height:'+board.pic_height+'px;">';
					if(content.pic_filename.substring(content.pic_filename.length-3,content.pic_filename.length) == 'swf'){
						htmlCode += e104aidma_generateFlash(board.pic_weight,board.pic_height,swfPlayer,'swfPath='+url+content.pic_filename+'&callBackFunction=e104aidma_clickByFlash&callBackParameters='+js_click_parameters.replace(/&/g,'@@@'));
					}else{
						htmlCode += '<a href="javascript:e104aidma_click('+js_click_parameters +');"><img width="'+board.pic_weight+'" height="'+board.pic_height+'" src="'+url+content.pic_filename+'" border="0"></a>';
					}
					htmlCode += '<div class="caption" style="width:'+board.pic_weight+'px;top:'+(board.pic_height-48)+'px;"><h2><a href="javascript:e104aidma_click('+js_click_parameters +');">'+content.title+'</a></h2><ul>';
					for(var i = 1; i <= parseInt(board.line_count); i++){
						js_click_parameters = '\''+elementid+','+webid+','+channelid+','+boardid+','+content.spec_type+','+content.id+','+eval('content.link'+i)+','+viewclick+','+eval('content.outside_link'+i)+'\'';
						if(eval('content.word'+i) != null && eval('content.word'+i) != 'undefined' && eval('content.word'+i) != ''){
							htmlCode += '<li><a href="javascript:e104aidma_click('+js_click_parameters +');">'+eval('content.word'+i)+'</a></li>';
						}
					}
				}
				htmlCode += '</ul></div></div>';
				break;
			case "14":
				var _index = 0,
				adLength = eval('e104aidma_m.b_'+boardid+'.content.length'),
				count = board.col_num*board.row_num;
				htmlCode += '<div class="aidma_14" style="width:'+board.table_weight+'px;"><ul>';
				for(var i = 0; i < adLength; i++) {
					js_click_parameters = '\''+elementid+','+webid+','+channelid+','+boardid+','+eval('e104aidma_m.b_'+boardid+'.content['+i+'].spec_type')+','+eval('e104aidma_m.b_'+boardid+'.content['+i+'].id')+','+eval('e104aidma_m.b_'+boardid+'.content['+i+'].link')+','+viewclick+','+eval('e104aidma_m.b_'+boardid+'.content['+i+'].outside_link')+'\'';
					htmlCode = htmlCode + '<li class="'+i+'"><a href="javascript:e104aidma_click('+js_click_parameters +');"><img src="'+url+eval('e104aidma_m.b_'+boardid+'.content['+i+'].pic_filename')+'" width="'+board.pic_weight+'" height="'+board.pic_height+'" border="0"></a>';
					if (viewclick) htmlCode += e104aidma_generateImgView(elementid,webid,channelid,boardid,eval('e104aidma_m.b_'+boardid+'.content['+i+'].spec_type'),eval('e104aidma_m.b_'+boardid+'.content['+i+'].id'),viewclick);
					htmlCode += '</li>';
				}
				htmlCode += '</ul>';
				if (adLength>count) {
					htmlCode += '<div class="btn" id="aidma_14_ctl">';
					htmlCode += '<a href="javascript:e104aidma_type14ClickChange('+count+', 0);" class="prev">Prev</a>';
					htmlCode += '<a href="javascript:e104aidma_type14ClickChange('+count+', 1);" class="next">Next</a>';
					htmlCode += '</div>';
				}
				htmlCode += '</div>';
				break;
			case "16":
				var adSetting={
					'elementid':elementid,
					'webid':webid,
					'channelid':channelid,
					'boardid':boardid,
					'preview':preview,
					'viewclick':viewclick,
					'board':board,
					'content':content,
					'js_click_parameters':js_click_parameters,
					'js_appear_parameters':e104aidma_getGenerateImgViewUrl(elementid,webid,channelid,boardid,content.spec_type,content.id,viewclick),
					'url':url
				};
				
				adSetting = e104aidma_getType16ShowSetting(adSetting);
				htmlCode += adSetting.viewSetting.htmlCode;
				break;
			default:
				return;
		}
		//Process ad view count
		switch(content.spec_type){
			case "1":
				if(viewclick)
					htmlCode += e104aidma_generateImgView(elementid,webid,channelid,boardid,content.spec_type,content.id,viewclick);
				break;
			case "2":
				if(viewclick)
					htmlCode += e104aidma_generateImgView(elementid,webid,channelid,boardid,content.spec_type,content.id,viewclick);
				break;
			case "3":
				if(viewclick)
					htmlCode += e104aidma_generateImgView(elementid,webid,channelid,boardid,content.spec_type,content.id,viewclick);
				break;
			case "4":
				if(viewclick)
					htmlCode += e104aidma_generateImgView(elementid,webid,channelid,boardid,content.spec_type,content.id,viewclick);
				break;
			case "5":
				if(viewclick)
					htmlCode += e104aidma_generateImgView(elementid,webid,channelid,boardid,content.spec_type,content.id,viewclick);
				break;
			case "6":
				if(viewclick)
					htmlCode += e104aidma_generateImgView(elementid,webid,channelid,boardid,content.spec_type,content.id,viewclick);
				break;
			case "7":
				if(viewclick)
					htmlCode += e104aidma_generateImgView(elementid,webid,channelid,boardid,content.spec_type,content.id,viewclick);
				break;
			case "8":
				if(viewclick)
					htmlCode += e104aidma_generateImgView(elementid,webid,channelid,boardid,content.spec_type,content.id,viewclick);
				break;
			case "9":
				if(viewclick)
					htmlCode += e104aidma_generateImgView(elementid,webid,channelid,boardid,content.spec_type,content.id,viewclick);
				break;
			case "10":
				if(viewclick)
					htmlCode += e104aidma_generateImgView(elementid,webid,channelid,boardid,content.spec_type,content.id,viewclick);
				break;
			case "11":
				//上一步已產生
				break;
			case "12":
				//上一步已產生
				break;
			case "13":
				if(viewclick)
					htmlCode += e104aidma_generateImgView(elementid,webid,channelid,boardid,content.spec_type,content.id,viewclick);
				break;
			case "14":
				//上一步已產生
				break;
			case "16":
					var additionVarsAll;
					additionVarsAll = e104aidma_getType16AppearType('none');
					if (!adSetting.viewSetting.isSupport) {
						if(viewclick) {
							var additionVarsBoard = e104aidma_getType16AppearType('small');
							htmlCode += e104aidma_getGenerateImgViewImg(content.id,adSetting.js_appear_parameters + '_'+additionVarsAll);
							htmlCode += e104aidma_getGenerateImgViewImg(null,adSetting.js_appear_parameters + '_'+additionVarsBoard);
						}
					}else{
						var initType16ShowEffect=function(){
							window.addEventListener('message', e104aidma_adReceiveMessage);
							e104aidma_setType16ShowEffect(adSetting);
						}
						if (adSetting.preview){
							setTimeout(initType16ShowEffect, 1000);
						}else{
							$( document ).ready(function() {
								initType16ShowEffect();
							});
						}
					}
				break;
		}

		element.innerHTML = htmlCode;
		//Start effect
		switch(content.spec_type){
			case "11":
				e104aidma_type11Change(boardid,Math.ceil(Math.random()*tmp) - 1);
				try{
					$(function() {
						/*$("#aidma_11_"+boardid+"_ctl a").click(function(){
								e104aidma_type11Change(boardid,$(this).parent().children("a").index($(this)),true);
							}
						);*/
						e104aidma_type11AutoChange(boardid,tmp);
					});
				}catch(e){}
				break;
			case "12":
				try{
					$(function(){
						try{
							$("#aidma_12_"+boardid).accordion(
								{active:Math.ceil(Math.random()*tmp) - 1}, //控制先顯示哪一個廣告 (可動態隨機)
								{header:'.aidma_12_header'},   //設定header
								{event:'mouseover',animated: 'swing',duration: 1000});    //onMouseOver呈現廣告
						}catch(e){}
					});
				}catch(e){}
				break;
			case "13":
				try{
					$(function(){
						$('#aidma_13_1_'+boardid).each(function(){
							// 先取得區塊的高及標題區塊等資料
							var $this = $(this),
							_height = $this.height(),
							$caption = $('.caption', $this),
							_captionHeight = $caption.outerHeight(true),
							_speed = 200;

							// 當滑鼠移動到區塊上時
							$this.hover(function(){
									// 讓 $caption 往上移動
									$caption.stop().animate({
									top: _height - _captionHeight
									}, _speed);
								}, function(){
									// 讓 $caption 移回原位
									$caption.stop().animate({
									top: _height - 48
									}, _speed);
								});
						});
					});
				}catch(e){}
				break;
			case "14":
				e104aidma_type14Show(count);
				if(adLength>count){
					try{
						e104aidma_type14AutoChange(count);
					}catch(e){}
				}
				break;
		}
	}
}
function e104aidma_generateFlash(width,height,flashPlayer,values){
	var htmlCode = '';
	if(e104aidma_isIE){
		htmlCode = '<embed width="'+width+'" height="'+height+'" flashvars="'+values+'" allowScriptAccess="always" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" wmode="opaque" src="'+flashPlayer+'" name="e104aidma" quality="high">';
	}else{
		htmlCode = '<object width="'+width+'" height="'+height+'" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="e104aidma">'+
			'<param value="'+flashPlayer+'" name="movie">'+
			'<param value="high" name="quality">'+
			'<param value="opaque" name="wmode">'+
			'<param name="allowScriptAccess" value="always">'+
			'<param name="flashvars" value="'+values+'">'+
			'</object>';
	}
	return htmlCode;
}

function e104aidma_generateImgView(elementid,webid,channelid,boardid,spec,metrialid,viewclick){
	var now = new Date().getTime();
	if(viewclick){
		try{
			return '<img id="aidma_viewclick_'+metrialid+'" src="https://static.104.com.tw/aidma/view_click.gif?param=view_'+webid+'_'+channelid+'_'+boardid+'_'+spec+'_'+metrialid+'&rnd='+now+'" style="display:none;">';
		}catch(e){};
	}
	return '';
}
function e104aidma_getGenerateImgViewUrl(elementid,webid,channelid,boardid,spec,metrialid){
	var now = new Date().getTime();
	return 'https://static.104.com.tw/aidma/view_click.gif?param=view_' + webid + '_'+ channelid + '_' + boardid + '_' + spec + '_' + metrialid ;
}
function e104aidma_getGenerateImgViewElementID(metrialid){
	return 'aidma_viewclick_' + metrialid;
}
function e104aidma_getGenerateImgViewImg(trackImgID,url){
	var element = '';
	if (trackImgID != null){
		element	= 'id="' + e104aidma_getGenerateImgViewElementID(trackImgID) + '" ';
	}
	var now = new Date().getTime();
	return '<img ' + element + 'src="' + url + '&rnd=' + now  + '" style="display:none;">';
}
function e104aidma_view(elementid,webid,channelid,boardid,spec,metrialid,viewclick){
	var now = new Date().getTime();

	if(viewclick){
		try{
			document.getElementById('aidma_viewclick_'+metrialid).src="https://static.104.com.tw/aidma/view_click.gif?param=view_"+webid+"_"+channelid+"_"+boardid+"_"+spec+"_"+metrialid+"&rnd="+now;
		}catch(e){};
	}
}
function e104aidma_click(parameters){
	var now = new Date().getTime();
	try{
		var webid = parameters.split(",")[1];
		var channelid = parameters.split(",")[2];
		var boardid = parameters.split(",")[3];
		var spec = parameters.split(",")[4];
		var metrialid = parameters.split(",")[5];
		var link = parameters.split(",")[6];
		var viewclick = parameters.split(",")[7];
		var outside_link = parameters.split(",")[8];
		var addition_vars = parameters.split(",")[9];

		if (addition_vars==undefined) {
			addition_vars = '';
		}

		if(link != ''){
			var flag=true;
			if (spec=='16') {
				if ((addition_vars=='3')||(addition_vars=='4')){//開啟廣告、關閉廣告不算點擊
					flag=false;
					outside_link = '0';
				}
				if (addition_vars.length>0){
					addition_vars = '_' + addition_vars;
				}
			}
			if(outside_link == '1'){
				if(!confirm("您即將離開104人力銀行暨一零四集團相關網域，提醒您！確定離開後，請小心謹慎使用您的個人資料！")){
					flag=false;
				}
			}
			if(flag)
				window.open(link);
			if(viewclick == 'true'){
				try{
					document.getElementById('aidma_viewclick_'+metrialid).src="https://static.104.com.tw/aidma/view_click.gif?param=click_"+webid+"_"+channelid+"_"+boardid+"_"+spec+"_"+metrialid+addition_vars+"&rnd="+now;
				}catch(e){};
			}
		}
	}catch(e){};
}
function e104aidma_clickByFlash(parameters){
	eval("e104aidma_click("+parameters.replace(/@@@/g,'&')+");");
}
function e104aidma_isIE(){
	return (navigator.userAgent.indexOf("MSIE") > -1);
}
function e104aidma_checkBoardIsDefault(boardid){
	var m10 = false;
	try{
		if(eval('e104aidma_b.b_'+boardid+'.length') == 0)
		return null;
		if(typeof e104aidma_idno != 'undefined' && e104aidma_idno != ''){
			try{
				if(eval('e104aidma_m10.b_'+boardid+'.content.length') != 0){
					var tmp = eval('e104aidma_m10.b_'+boardid+'.content');
					var needDel = true;
					for(var n = tmp.length; n > 0; n--){
						needDel = true;
						for(var i = 0; i < e104aidma_idno.split(',').length; i++){
							if(tmp[n-1].id == e104aidma_idno.split(',')[i]){
								needDel = false;
								break;
							}
						}
						if(needDel){
							tmp.splice(n-1,1);
						}
					}
					if(tmp.length != 0)
						m10 = true;
				}
			}catch(e){};
		}
		if(!m10){
			if(eval('e104aidma_m.b_'+boardid+'.content.length') == 0){
				return null;
			}
		}
	}catch(e){return null};
	var mid;
	var content;
	if(m10){
		mid = Math.ceil(Math.random()*eval('e104aidma_m10.b_'+boardid+'.content.length')) - 1;
		content = eval('e104aidma_m10.b_'+boardid+'.content['+mid+']');
	}else{
		mid = Math.ceil(Math.random()*eval('e104aidma_m.b_'+boardid+'.content.length')) - 1;
		content = eval('e104aidma_m.b_'+boardid+'.content['+mid+']');
	}
	return content.type;
}
function e104aidma_type11Change(boardid,index,stop){
	var li = $("#aidma_11_"+boardid+" li");
	li.css("display","none");
	li.eq(index).css("display","");
	li.removeClass("on");
	li.eq(index).addClass("on");
	if(stop){
		li.eq(index).addClass("stop");
	}
}
function e104aidma_type11AutoChange(boardid,count){
	setTimeout(function(){
		try{
			if($("#aidma_11_"+boardid+" .stop").attr('class').indexOf('stop')>-1)
				return;
		}catch(e){}
		var i = $("#aidma_11_"+boardid+" .on").parent().children("li").index($("#aidma_11_"+boardid+" .on"));
		i++;
		if(i>=count)
			i=0;
		e104aidma_type11Change(boardid,i);
		e104aidma_type11AutoChange(boardid,count);
	}, 15000);
}
function e104aidma_type11ClickChange(boardid,count,addition){
	var i = $("#aidma_11_"+boardid+" .on").parent().children("li").index($("#aidma_11_"+boardid+" .on"));
	i=i+addition;
	if(i>=count)
		i=0;
	if(i<0)
		i=count-1;
	e104aidma_type11Change(boardid,i,true);
}

function e104aidma_type14Show(count) {
	$(".aidma_14 ul li").each(function(index) {
		if(index<count) $(this).css('display', 'inline');
		else $(this).css('display', 'none');
	});
}

function e104aidma_type14AutoChange(count) {
	setTimeout(function(){
		if($(".aidma_14 ul li.stop").length>0) return;;

		for(var i=0 ; i<count ; i++) {
			$('.aidma_14 ul').find('li:last').after($('.aidma_14 ul').find('li:first')).end();
		}

		e104aidma_type14Show(count);
		e104aidma_type14AutoChange(count);
	}, 15000);
}

function e104aidma_type14ClickChange(count, dir) {
	$('.aidma_14 ul').find('li:first').addClass('stop');

	for(var i=0 ; i<count ; i++) {
		if(dir==0) $('.aidma_14 ul').find('li:first').before($('.aidma_14 ul').find('li:last')).end();
		else $('.aidma_14 ul').find('li:last').after($('.aidma_14 ul').find('li:first')).end();
	}

	e104aidma_type14Show(count);
}
//型態15記錄出現過的廣告idx
var list_15show_m_idx;
function e104aidma_type15Show(elementid,webid,channelid,boardid,preview,viewclick){
	if(document.getElementById(elementid) == null)
		return;

	//判斷是否為後台預覽
	var url = '';
	if(preview){
		url = 'https://static.104.com.tw/aidma/material/temp/';
	}else{
		url = 'https://static.104.com.tw/aidma/material/'+ channelid + '/' + boardid +'/';
	}

	//判斷取素材的方式
	var show_m_count = 0;//回傳素材數
	var blank_n = $('[id=' + elementid + ']').length;//頁面版位數
	var book_n = eval('e104aidma_m.b_'+boardid+'.content.length');//本次素材數
	if (book_n >= blank_n){//素材搶版位
		show_m_count = blank_n;
	}
	else{//素材塞不滿版位
		show_m_count = book_n;
	}
	//亂數抓取素材index
	var arr_show_m_idx = new Array(show_m_count);//取出的素材index
	//將已出現的廣告idx塞入陣列中
	if (list_15show_m_idx != undefined && list_15show_m_idx != ''){
		for(var i=0;i<list_15show_m_idx.split(",").length;i++){
			if (list_15show_m_idx.split(",")[i] < book_n && i < show_m_count){//已出現的廣告idx值不可大於本次素材數,而且寫入陣列的個數不可大於回傳素材數
				arr_show_m_idx[i] = list_15show_m_idx.split(",")[i];
			}
		}
	}
	list_15show_m_idx = '';//清空list
	var rand_n = 0;
	for(var i=0; i<show_m_count; i++) {
		if (arr_show_m_idx[i] == undefined || arr_show_m_idx[i] == ''){
			do {
				var exist = false;//此亂數是否已存在
				rand_n = Math.ceil(Math.random()*book_n) - 1;	//取得亂數

				//檢查亂數是否存在於陣列中，若存在則繼續迴卷
				if(chkArrValue(arr_show_m_idx,rand_n) != -1){
					exist = true;
				}

			} while (exist);	//產生沒出現過的亂數時離開迴圈

			arr_show_m_idx[i] = rand_n;
		}
	}
	list_15show_m_idx = arr_show_m_idx.join(",");//將新的廣告idx放入list中
	//alert("已存在素材位置:"+list_15show_m_idx);

	//組html
	var htmlCode;
	var content;
	var board;//讀取版位樣式資訊
	var js_click_parameters;//產生click相關參數

	$('[id=' + elementid + ']').each(function(index) {
		htmlCode = '';
		content = '';
		$(this).innerHTML = '';
		if(index < show_m_count){
			content = eval('e104aidma_m.b_'+boardid+'.content['+arr_show_m_idx[index]+']');
			board = eval('e104aidma_b.b_'+boardid+'.s_'+content.spec_type);
			js_click_parameters = '\''+elementid+','+webid+','+channelid+','+boardid+','+content.spec_type+','+content.id+','+content.link+','+viewclick+','+content.outside_link+'\'';
			htmlCode += '<div class="aidma_15">';
			htmlCode += '<table width="720" border="0" cellspacing="0" cellpadding="0" onclick="e104aidma_click('+js_click_parameters +');"><tr>';
			if(typeof(content.show_sponsor) != 'undefined' && content.show_sponsor == 1){
				htmlCode += '<td width="94" align="center"><span style="color:#cc3300;">贊助</span></td>';
			}
			else{
				htmlCode += '<td width="94" align="center">&nbsp;</td>';
			}
			htmlCode += '<td>';
			if(typeof(content.title) != 'undefined' && content.title != ''){
				htmlCode += '<h3>'+content.title+'</h3>';
			}
			else{
				htmlCode += '<h3>&nbsp;</h3>';
			}
			if(typeof(content.word1) != 'undefined' && content.word1 != ''){
				htmlCode += '<p class="w1">'+content.word1+'</p>';
			}
			else{
				htmlCode += '<p>&nbsp;</p>';
			}
			if(typeof(content.word2) != 'undefined' && content.word2 != ''){
				htmlCode += '<p>'+content.word2+'</p>';
			}
			else{
				htmlCode += '<p>&nbsp;</p>';
			}
			if(typeof(content.word3) != 'undefined' && content.word3 != ''){
				htmlCode += '<p>'+content.word3+'</p>';
			}
			else{
				htmlCode += '<p>&nbsp;</p>';
			}
			htmlCode += '</td>';
			if(typeof(content.show_img) != 'undefined' && content.show_img == 1 && typeof(content.pic_filename) != 'undefined' && content.pic_filename != ''){
				htmlCode += '<td width="146" align="center"><img src="'+url+content.pic_filename+'" width="'+board.pic_weight+'" height="'+board.pic_height+'" border="0"></td>';
			}
			else{
				htmlCode += '<td width="146" align="center">&nbsp;</td>';
			}
			htmlCode += '</tr></table>';

			if(viewclick){
				htmlCode += e104aidma_generateImgView(elementid,webid,channelid,boardid,content.spec_type,content.id,viewclick);
			}
			htmlCode += '</div>';
			$(this).html(htmlCode);
			$(this).css('display', 'inline');//顯示
		}
		else{
			$(this).css('display', 'none');//隱藏
		}
	});
}
function e104aidma_getType16ShowSetting(setting){
	var htmlCode = '',//html內容
		isSupport = e104aidma_getType16ShowSupport(),//是否支援flash
		content = setting.content,
		board = setting.board;

	if (!isSupport){//check is support for type16AD
		var additionVars = e104aidma_getType16ClickType('banner','small');
		var clickVars = e104aidma_getType16ClickParameters(setting.js_click_parameters,additionVars);
		htmlCode += '<a href="javascript:e104aidma_click(\''+ clickVars +'\');"><img src="'+setting.url+content.default_pic_filename+'" width="'+board.push_pic_weight+'" height="'+board.init_pic_height+'" border="0"></a>';
	}else{
		var iframeCode = '<iframe id="aidma-box-dinguagua" width="'+board.push_pic_weight+'" height="'+board.init_pic_height+'" scrolling="no" frameBorder="0"></iframe>';

		var dinguaguaStyle = 'width:' + board.push_pic_weight + 'px;';

		htmlCode += '<div class="aidma_16">';
		htmlCode += '	<div id="aidma-dinguagua" style="' + dinguaguaStyle + '">';
	    htmlCode += '		<div id="aidma-container-dinguagua">';
	    htmlCode += '	       <a id="aidma-sensor-dinguagua" href="javascript:void(0);"></a>';
	    htmlCode += 			iframeCode;
	    htmlCode += '	   </div>';
	    htmlCode += '	   <button id="aidma-close-dinguagua" type="button" title="關閉">關閉廣告</button>';
	    htmlCode += '	   <button id="aidma-open-dinguagua" type="button" title="開啟">開啟廣告</button>';
	    htmlCode += '	   <span id="aidma-fack-dinguagua" display:"none"></span>';
	    htmlCode += '	</div>';
		htmlCode += '</div>';
	}

	var viewSetting = {
		'htmlCode' : htmlCode,
		'isSupport' : isSupport
	}

	setting.viewSetting = viewSetting;
	return setting;
}
function e104aidma_getType16ShowSupport(){
	var IEVersion=e104aidma_getIEVersion();
	if (IEVersion > 0) {
		if (IEVersion<11){
			return false;
		}
		return true;
	}else{
		if (e104aidma_getIsSupportCanvas()!=true){
		 	return false;
		}
		if (e104aidma_getIsSupportCssAnimation()!=true){
			return false;
		}
		return true;
	}
}
function e104aidma_getType16ShowHistory(boardid){
	var cookieData=parseInt(e104aidma_getCookie(e104aidma_getType16CookieName(boardid)));
	if (isNaN(cookieData)){
		return 0;
	}
	return cookieData;
}
function e104aidma_setType16ShowHistory(boardid,currNum){
	e104aidma_setCookie(e104aidma_getType16CookieName(boardid), currNum, 1);
}
function e104aidma_getType16CookieName(boardid){
	return 	'aidma_b_'+boardid;
}
function e104aidma_getType16ClickParameters(js_click_parameters,additionVars){
	var newStr= '';
	newStr = js_click_parameters.slice(1,js_click_parameters.length-1);
	newStr += ',' + additionVars;
	return newStr
}
function e104aidma_getType16ClickType(fromType,boardSize){//1大圖2小圖3開啟4關閉
	var clickType = '';
	if (fromType == 'open') {
		clickType = 3;
	} else if (fromType == 'close') {
		clickType = 4;
	} else if (fromType == 'banner') {
		if (boardSize == 'small') {
			clickType = 2 ;
		}else {
			clickType = 1 ;
		}
	}
	return clickType;
}
function e104aidma_getType16AppearType(boardSize){//版位曝光自訂變數:1不分版位、2大圖、3小圖
	var appearType = '';
	if (boardSize == 'small') {
		appearType = 3 ;
	} else if (boardSize == 'big') {
		appearType = 2 ;
	} else if (boardSize == 'none') {
		appearType = 1 ;
	}
	return appearType;
}
function e104aidma_setType16ShowEffect(setting){
	var $eleScope = $('#' + setting.elementid);
	var currentSize,
		viewTimes,
		cookieLimit,
		isFirst = true;
    var closeButton = $eleScope.find('#aidma-close-dinguagua'),
    	openButton = $eleScope.find('#aidma-open-dinguagua'),
    	bannerBox = $eleScope.find('#aidma-box-dinguagua'),
    	sensorBox = $eleScope.find('#aidma-sensor-dinguagua'),
    	fackButton = $eleScope.find('#aidma-fack-dinguagua');

   	var domainUrl = encodeURIComponent(getUrl());

    initBannerView();
	openButton.bind('click', {type: 'open'}, countingClick);
	closeButton.bind('click', {type: 'close'}, countingClick);
	sensorBox.bind('click', {type: 'banner'}, countingClick);
	fackButton.bind('click', {type: 'autoClose'}, countingClick);

    function countingClick (evt) {
        var type = evt.data.type;
        if (type == 'autoClose'){
        	if (currentSize == 'big'){
        		closeBanner();
        	}
        	return ;
        }
        attachClickTracking(type);
        if (type == 'open' && currentSize == 'small') openBanner();
        if (type == 'close' && currentSize == 'big') closeBanner();
    }

    function openBanner () {
        currentSize = 'big';
		makeBanner();
		attachAppearTracking();

		if (viewTimes < cookieLimit){
			viewTimes += 1;
			e104aidma_setType16ShowHistory(setting.boardid+"_"+setting.content.id,viewTimes);
		}
    }

    function closeBanner () {
        currentSize = 'small';
		makeBanner();
        attachAppearTracking();
    }

    function attachAppearTracking(){
    	if (!setting.viewclick){
    		return;
    	}
    	var additionVars = e104aidma_getType16AppearType(currentSize);
    	if (additionVars.length<=0){
    		return;
    	}
		var appearImgID = setting.content.id+'_'+currentSize;
		var appearImg = $('#'+e104aidma_getGenerateImgViewElementID(appearImgID));
		if (appearImg.val()!=undefined){
			appearImg.remove();
		}
		appearImg = $(e104aidma_getGenerateImgViewImg(appearImgID,setting.js_appear_parameters + '_' + additionVars));
		$eleScope.append(appearImg);
    }

    function attachClickTracking(type){
		var additionVars = e104aidma_getType16ClickType(type,currentSize);
        var clickVars = e104aidma_getType16ClickParameters(setting.js_click_parameters,additionVars);
        e104aidma_click(clickVars);
    }

    function initBannerView(){
		if (setting.viewclick){
			var additionVarsAll = e104aidma_getType16AppearType('none');
			$eleScope.append(e104aidma_getGenerateImgViewImg(setting.content.id,setting.js_appear_parameters + '_'+additionVarsAll));
		}

	    viewTimes = e104aidma_getType16ShowHistory(setting.boardid+"_"+setting.content.id);
		cookieLimit = parseInt(setting.board.cookie_count);
		if (isNaN(cookieLimit)){
			cookieLimit = 0;
		}
		if (viewTimes < cookieLimit){//check is viewed
			currentSize = 'big';
			openBanner();
		}else{
			currentSize = 'small';
			closeBanner();
		}
    }

	function makeBanner(){

		var containerBox=$('#aidma-container-dinguagua'),
			bannerJson,
			bannerHtml,
			initHeight=0,
			gotoHeight=0,
			initWeight=0;

		openButton.hide();
        closeButton.hide();
		if (currentSize == 'small' ){
			if(isFirst){
				initHeight = setting.board.init_pic_height;
			}else{
				initHeight = setting.board.push_pic_height;
			}
			gotoHeight = setting.board.init_pic_height;
			initWeight = setting.board.init_pic_weight;
			bannerHtml = setting.url+setting.content.init_pic_filename+'?url='+domainUrl;
		}else{
			if(isFirst){
				initHeight = setting.board.push_pic_height;
			}else{
				initHeight = setting.board.init_pic_height;
			}
			gotoHeight = setting.board.push_pic_height;
			initWeight = setting.board.push_pic_weight;
			bannerHtml = setting.url+setting.content.push_pic_filename+'?url='+domainUrl;
		}

		bannerBox.css({
			'width': initWeight,
			'height': initHeight
		});

		var gotoStartSetting=function(){
			bannerBox.attr('src','');
			bannerBox.animate({
				height: gotoHeight
			}, 600);
		}
		var gotoStartBanner=function(){
			bannerBox.attr({
				'src': bannerHtml
			});

			if (currentSize == 'small' ){
				openButton.show();
				closeButton.hide();
			}else{
				openButton.hide();
				closeButton.show();
			}
		}

		if (initHeight!=gotoHeight){
			setTimeout(gotoStartSetting, 100);
			setTimeout(gotoStartBanner, 700);
		}else{
			gotoStartSetting();
			gotoStartBanner();
		}

		isFirst=false;
	}

	function getUrl(){
		var url = window.location.href;
		var arr = url.split("/");
		var result = arr[0] + "//" + arr[2]
		return result;
	}
}
function e104aidma_adActionCall(actionTAG){
	if ((actionTAG==undefined) || (actionTAG.length<=0)){
		return;
	}
	switch(actionTAG){
		case "pushDownBannerClose":
			$('.aidma_16 #aidma-fack-dinguagua').trigger('click');
			break;
	}
}
function e104aidma_setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
function e104aidma_getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
function chkArrValue(c_arr,c_str){
	var chk_flag = -1;
	for(var i=0; i<c_arr.length; i++) {
		if (c_arr[i] == c_str){
			chk_flag = i;
		}
	}
	return chk_flag;
}
function e104aidma_adReceiveMessage(e) {
    if (e.origin !== "https://static.104.com.tw")
        return;
    if (e.data=='pushDownBannerClose'){
        e104aidma_adActionCall('pushDownBannerClose');
    }
}
function e104aidma_getIEVersion(){
	var sAgent = window.navigator.userAgent;
	var Idx = sAgent.indexOf("MSIE");
	// If IE, return version number.
	if (Idx > 0)
		return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));

	// If IE 11 then look for Updated user agent string.
	else if (!!navigator.userAgent.match(/Trident\/7\./))
		return 11;

	else
		return 0; //It is not IE
}
function e104aidma_getIsSupportCanvas(){
	//return !!document.createElement('canvas').getContext;
	return !!window.CanvasRenderingContext2D;
}
function e104aidma_getIsSupportCssAnimation(){
	var animation = false,
	    animationstring = 'animation',
	    keyframeprefix = '',
	    domPrefixes = 'Webkit Moz O ms Khtml'.split(' '),
	    pfx  = '',
	    elm = document.createElement('div');

	if( elm.style.animationName !== undefined ) { animation = true; }

	if( animation === false ) {
	  for( var i = 0; i < domPrefixes.length; i++ ) {
	    if( elm.style[ domPrefixes[i] + 'AnimationName' ] !== undefined ) {
	      pfx = domPrefixes[ i ];
	      animationstring = pfx + 'Animation';
	      keyframeprefix = '-' + pfx.toLowerCase() + '-';
	      animation = true;
	      break;
	    }
	  }
	}

	return 	animation;
}
