function getLikes(){

	let is_login = $('a.menu--popup-link').text();
  

	  if(is_login.includes("uživatel přihlášen")){
	    let username = is_login.split(' - ')[1];
	  
	   
	    // let result = {
	    //   "method": "get_likes",
	    //   "username": username
	    // }
	    // result = post2php(result);
	    // console.log(result);
	    // result.forEach(renderLines);
	    $("a.result--comments").click(function(e){
		  showComments(this);

		});
	  }else{
	  	// $('h4.hidden-abs').after("<br><p>Nejdřiv musíte se přihlásit.</p>");
	   //  popup.classList.remove('hidden-abs');
	  }
}

function renderLines(item){
	let elems = '<div class="result">'+
                '<div class="result--flex">'+
                '<p class="result--line">'+item['line_name']+'</p>'+
                '<div class="result--time">'+
                '<p>Čas odjezdu <b class="t_from">'+item['time_from']+'</b></p>'+
                '<p>Čas příjezdu <b class="t_to">'+item['time_to']+'</b></p>'+
                '</div>'+
                '<a href="#" class="result--comments">kommentářé</a>'+
                '<div class = "comments">'+
              	'</div>'+
                '</div>'+
                '<div class="result--bottom">'+
                '<p class="result--direction"> Směr: <span>'+item['smer_from']+' - '+item['smer_to']+'</span></p>'+
                // '<button class="heart hidden" title="Přidat do oblíbených" type="button">Přidat do oblíbených</button>'
                '</div></div>'
                
    $('h4.hidden-abs').after(elems);
}

getLikes();