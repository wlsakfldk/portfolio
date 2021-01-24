/*************************************************************************************************
트위터 검색 widget 생성을 위한 함수들
2013.5 team coForward : http://coforward.com
	2013.7 : twitter_api 1.1 대응 PHP proxy 적용  
	2013.7 : HTML5 tag적용
	2013.7 : 검색어 변경, 자동갱신기능 추가 
	2013.7 : HTML5를 기본 검색어로 지정 
**************************************************************************************************/
var widget_id;
var twitter_timer=false;

/*트위터 위젯의 초기화 
	widget_id : {string} 생성된 내용을 표시할 영역의 id
*/
function ini_twitter_widget(widget_id){
	var search_form=document.getElementById('twitter_search_form');
	search_form.onsubmit=function(){
							start_twitter_widget(widget_id);
							return false;
						}
	var btn_stop=document.getElementById('btn_stop');
	btn_stop.onclick=function(){stop_twitter_widget(widget_id);}
	start_twitter_widget(widget_id);
}//End of ini_twitter_widget(widget_id)===========================================================

/*검색버튼 기능
	widget_id : {string} 생성된 내용을 표시할 영역의 id
*/
function start_twitter_widget(widget_id){
	stop_twitter_widget();
	var t_widget=document.getElementById(widget_id);
	document.getElementById('since_id').value='';
	t_widget.innerHTML='';
	mk_twitter_widget(widget_id,5);
	twitter_timer=setInterval(function(){mk_twitter_widget(widget_id,1)},10000);
}//End of start_twitter_widget(widget_id)===========================================================

/*자동갱신 중단 버튼 기능
	widget_id : {string} 생성된 내용을 표시할 영역의 id
*/
function stop_twitter_widget(){
	if(twitter_timer){
		clearInterval(twitter_timer);
	}
	return false;
}//End of stop_twitter_widget()====================================================================


/*트위터 위젯 코드를 생성함 =======================================================================
	search_word :{sting,sting...} 콤마로 구분된 검색할 단어 목록
	article_cnt : {int} 가져올 트윗의 갯수
*/
function mk_twitter_widget(widget_id,article_cnt){
	//기본 정보 설정
	var search_word=document.getElementById('search_text').value;
	var query_string=encodeURI(search_word.replace(',',' OR '));
	var since_id=document.getElementById('since_id').value;
	proxy_url='twitter-proxy.php';  //프록시 파일 경로을 지정함 
	twitter_api=proxy_url+'?url='+encodeURIComponent('search/tweets.json?q='+query_string+'&lang=ko&count='+ article_cnt+'&since_id='+since_id);
	
	//데이터 json을 받아옴
	jQuery.getJSON(twitter_api,
		//json 데이터를 받아서 다음 함수를 실행함
		function(data){
			var t_widget=document.getElementById(widget_id);
				t_widget.setAttribute('titel',search_word.replace(',',' 및 ')+' 관련 글');
			var t_objects=data.statuses;
			
			if(t_objects.length<1){
				console.log('[새로운글 없음]-갯수확인');
				return false;
			}
			for(var i=0;i<(t_objects.length);i++){
				var since_id=document.getElementById('since_id').value;	
				if(t_objects[0]['id']<=since_id){
					console.log('[새로운글 없음]-아이디확인');
					return false;
				}
				//console.log(t_objects[i]);
				//각 트위터 아이템의 영역 생성
				var t_item_div=document.createElement('article');
					t_item_div.className='twitterArticle';
					//프로필 이미지 생성	
					var profile_img=document.createElement('img');
						profile_img.src=t_objects[i]['user']['profile_image_url'];
						profile_img.alt='';
						profile_img.width='77';
						profile_img.height='77';
						profile_img.className='twitterUserProfile';
					//프로필 링크의 생성	
					var user_name=document.createElement('a');
						user_name.href='http://twitter.com/'+t_objects[i]['user']['screen_name'];
						user_name.className='twitterUserName';
						user_name.setAttribute('title',t_objects[i]['user']['screen_name']+'님의 트위터로 연결됩니다.');
						var user_name_text=document.createTextNode(t_objects[i]['user']['screen_name']);
						user_name.appendChild(user_name_text);
						
					//내용의 텍스트 생성
					var t_content=document.createElement('p');
						var t_text=url_to_link(t_objects[i]['text']);
						t_content.innerHTML=important_word(t_text,search_word);
					
					//작성일자 생성
					var t_date=document.createElement('time');
						t_date.className='twitterDate';
						var c_date=t_objects[i]['created_at'].split(' ');
						var month_array={'Jan':'01','Feb':'02','Mar':'03','Apr':'04','May':'05','Jun':'06','Jul':'07','Aug':'08','Sep':'09','Oct':'10','Nov':'11','Dec':'12'}
						var d_temp=new Date(c_date[5]+'-'+month_array[c_date[1]]+'-'+c_date[2]);
						var t_date_text_content=d_temp.getFullYear()+'년 '+(d_temp.getMonth() + 1)+'월 '+d_temp.getDate()+'일';
						var t_data_text=document.createTextNode(t_date_text_content);
						t_date.appendChild(t_data_text);
						t_date.setAttribute('datetime',(c_date[5]+'-'+month_array[c_date[1]]+'-'+c_date[2]));
						
					//아이템 영역에 프로필 이미지를 추가함
					t_item_div.appendChild(profile_img);
					
					//아이템 영역에 사용자 이름을 추가함
					t_item_div.appendChild(user_name);
					
					//아이템 영역에 콘텐츠 텍스트를 추가함
					t_item_div.appendChild(t_content);
					
					//아이템 영역에 작성일자를 추가함
					t_item_div.appendChild(t_date);
				
				//아이템을 트위터 위젯 영역에 추가함
				var twitter_article=document.getElementsByClassName('twitterArticle');
				if(twitter_article.length>0){
					t_widget.insertBefore(t_item_div,twitter_article[0]);	
				}else{
					t_widget.appendChild(t_item_div);
				}
			}//for(var i=0;i<t_objects.length;i++)
			document.getElementById('since_id').value=t_objects[0]['id'];
	});//jQuery.getJSON()
}//mk_twitter_widget(widget_id,search_word,article_cnt)=========================================

/*url 텍스트를 링크로 변환함 ===================================================================
	text : {string} 문자열
*/ 	
function url_to_link(text){
	var url_pattern=/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
	var link_text=text.replace(url_pattern,'<a href="$1">$1</a>');
	var t_pattern=/(^@)/ig;
	var t_pattern=/(@[0-9a-zA-Z_-]*)/ig;
		link_text=link_text.replace(t_pattern,'<a href="http://twitter.com/$1">$1</a>')
	return link_text 
}//url_to_link(text) ===========================================================================


/*텍스트에서 특정 단어를 강조함=================================================================
	text : {string} 문자열
	word :{sting,sting...} 콤마로 구분된 강조할 단어 목록
*/
function important_word(text,word){
	var word_array=word.split(',');
	for(var i=0;i<word_array.length;i++){
		text=text.replace(word_array[i],'<mark>'+word_array[i]+'</mark>');
	}
	return text; 
}//importance_word(text,word)====================================================================
