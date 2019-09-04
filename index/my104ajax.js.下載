/**
 * 所有ajax request 統一呼叫這此函式，不可直接呼叫$.ajax
 * 處理: permission denied, alert & redirect.
 * 使用方法同$.ajax
 * @param obj 同$.ajax參數
 */
function my104Ajax(obj)
{
	var inObj = obj;
	var $successFuc = null;
	if(typeof inObj['success'] !== "undefined"){
		$successFuc = inObj['success'];
	}

	inObj['success'] = function(data){
		var $sfunc = $successFuc;
		if(
			data !== null
			&& typeof data === 'object' 
			&& typeof data.noLoging !== 'undefined' 
			&& data.noLoging == 1
			&& typeof data.redirect !== 'undefined'
		){	//導頁
			$replaceUrl = data.redirect;
			if(typeof data.alert !== "undefined"){
				alert(data.alert);
			}
			window.location.replace($replaceUrl);
			return;
		}
		
		if(typeof $sfunc === 'function')
			$sfunc(data);
	};
	$.ajax(inObj);	
}