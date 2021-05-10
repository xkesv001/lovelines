$.getScript("js/getLikes.js", function() {
   console.log("Parser is ready.");
 });
const btn = document.querySelector('.menu--btn');
const menu = document.querySelector('.nav');

const remooveMenu = (evt) => {
  evt.preventDefault();
  menu.classList.add('hidden-abs');
  btn.classList.remove('menu__close');
  btn.classList.add('menu__open');
}

const createMenu = (evt) => {
  evt.preventDefault();
  menu.classList.remove('hidden-abs');
  btn.classList.add('menu__close');
  btn.classList.remove('menu__open');
}

const testContains = (evt) => {
  if (innerWidth < '480') {
    if (btn.classList.contains('menu__close')) {
      remooveMenu(evt);
    } else {
      createMenu(evt);
    }
  }
}
const onEnterKeydown = (evt) => {
  if (evt.keyCode === 13 || evt.key === 13 || evt.keyIdentifier === 13) {
    testContains(evt);
  }
};
const onEscKeydown = (evt) => {
  if (evt.keyCode === 27 && innerWidth < '480') {
    remooveMenu(evt);
  }
}
btn.addEventListener('click', testContains);
btn.addEventListener('keydown', onEnterKeydown);
window.addEventListener('keydown', onEscKeydown);



// btn popup 

const closeBtn = document.querySelector('.login--btn__close');
const popup = document.querySelector('.popup');

const closePopup = (evt) => {
  evt.preventDefault();
  popup.classList.add('hidden-abs');
  closeBtn.removeEventListener('click', closePopup);
};
closeBtn.addEventListener('click', closePopup);



const popupLink = document.querySelector('.menu--popup-link');

const openPopup = (evt) => {
  evt.preventDefault();
  popup.classList.remove('hidden-abs');
  closeBtn.addEventListener('click', closePopup);
};

popupLink.addEventListener('click', openPopup);

const escKeydownHandler = (evt) => {
  if (evt.keyCode === 27 || evt.key === 27 || evt.keyIdentifier === 27) {
    closePopup(evt);
  }
}
// const hearts = document.querySelectorAll('.heart');
// for (heart of hearts) {
//   heart.addEventListener('click', openPopup);
// }

window.addEventListener('keydown', escKeydownHandler);



//mocks


const getRandomInt = () => {
  return Math.floor(Math.random() * 100);
}

const getRandomInteger = (a = 0, b = 1) => {
  const lower = Math.ceil(Math.min(a, b));
  const upper = Math.floor(Math.max(a, b));

  return Math.floor(lower + Math.random() * (upper - lower + 1));
};


const emojis = ['angry', 'puke', 'smile', 'sleeping'];

const comments = ['Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima debitis aut totam ea aliquid nemo quibusdam, atque neque iusto ratione magnam corporis! Quisquam delectus et rem, excepturi adipisci earum doloremque.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima debitis aut totam ea aliquid nemo quibusdam, atque neque iusto ratione magnam corporis!']

const commentContainer = () => {
  return `<section class="comments">
  <h4 class="comment--title">Kommentáře</h4>
  <button type="button" class="hidden comment--btn__close">Zavřít</button>
</section>`;
}

const commentTemplate = (k) => {
  return `<div class="comment">
      <p class="comment--description">${comments[k%3]}</p>
    <div class="comment--emoji"><img src="img/emoji/${emojis[k%4]}.png" title="ilustráční smajlik" width="100" height="100" class="comment-emoji--img"></div>
  </div>`;
}

const commentCounts = document.querySelectorAll('.result--comment__count');
const main = document.querySelector('.main');

const renderComment = () => {
  renderTemplate(main, commentContainer(), `beforeend`);
  const randomCommentsCount = getRandomInteger(1, 10);
  const container = document.querySelector('.comments');
  for (let k = 0; k < randomCommentsCount; k++) {
    renderTemplate(container, commentTemplate(k), `beforeend`);
  }
  const commentBtnClose = document.querySelector('.comment--btn__close');

  commentBtnClose.addEventListener('click', () => {
    main.removeChild(container);
  });
  window.addEventListener('keydown', (evt) => {
    if (evt.keyCode === 27 || evt.key === 27 || evt.keyIdentifier === 27) {
      main.removeChild(container);
    }
  });
}

for (commentCount of commentCounts) {
  commentCount.addEventListener('click', renderComment);
}


const linesCount = getRandomInteger(1, 20);

const directions = ['Braník', 'Kobylisy', 'Kbely', 'Petřiny', 'Červený vrch', 'Strahov', 'Želivského', 'Vinohrady', 'Náměstí míru', 'Pankrác', 'Vyšehrad', 'Holešovice', 'Krč', 'Háje', 'Zličín', 'Budějovická', 'Suchdol'];

const lineTemplate = () => {
  return `<div class="result">
  <h3 class="hidden">Výsledky hledání</h3>
  <div class="result--flex">

    <p class="result--line">${getRandomInt()}</p>
    <div class="result--time">
      <p class="t_from">Čas odjezdu ${getRandomInteger(0, 24) + ':' + getRandomInteger(10, 60)}</p>
      <p class="t_to">Čas příjezdu ${getRandomInteger(0, 24) + ':' + getRandomInteger(10, 60)}</p>
    </div>
    <a href="#" class="result--comments"><span class="result--comment__count">${getRandomInt()}</span> kommentářů</a>
  </div>
  <div class="result--bottom">
    <p class="result--direction"> Směr: <span>${directions[Math.round(Math.random()*directions.length)]} - ${directions[Math.round(Math.random()*directions.length)]}</span></p>
    <button class="heart hidden" title="Přidat do oblíbených" type="button">Přidat do oblíbených</button>
  </div>`;

}

$("button.heart").click(function(e){
  // $(this).closest(':has(.item-3)').find('.item-3');
  let is_login = $('a.menu--popup-link').text();
  

  if(is_login.includes("uživatel přihlášen")){
    let username = is_login.split(' - ')[1];
  
    let smer = $(this).closest('.result').find('.result--direction span').text();
    // let smer = $(e.target).closest("p.result--direction span").val();
    console.log(smer);
    let line = $(this).closest(".result").find(".result--line").text();
    console.log(line);
    let t_from = $(this).closest(".result").find("b.t_from").text();
    console.log(t_from);
    let t_to = $(this).closest(".result").find("b.t_to").text();
    console.log(t_to);
    let subs = smer.split(' - ')
    let smer_from = subs[0];
    let smer_to = subs[1];
    let result = {
      "method": "add_like",
      "username": username,
      "smer_from": smer_from,
      "smer_to": smer_to,
      "line": line,
      "t_from": t_from,
      "t_to": t_to
    }
    result = post2php( result);
    console.log(result);
  }else{
    popup.classList.remove('hidden-abs');
  }
});

$("div.comments").hide();

$("a.result--comments").click(function(e){
  
  showComments(this);
});

function showComments(e){
  let line = $(e).closest(".result").find(".result--line").text();
  let comments_div = $(e).closest(".result").find(".comments");
  console.log(line);
  let comments = getComments(line);
  comments_to_ren = '<div class="comment">'+
                        '<p class="comment--description">No comments exists.</p>'+
                        '</div>'
  if ((comments)&&(comments.length > 0)){
    comments_to_ren = '';
    comments.forEach(renderComments);
    console.log(comments_to_ren);
  }
  comments_div.append(comments_to_ren);
  comments_div.append('<fieldset>'+
                      '<label for="comm">Write your comment:</label>'+
                      '<textarea id="comm" name="comm" rows="4" cols="44"></textarea>'+
                      '<a href="#" class="btn-comm">ADD</a>'+
                      '</fieldset>');
  sendComment(comments_div, line);
  comments_div.show();
  comments_div.dialog({
        autoOpen: false,
        title: 'Kommentáře',
        width: 500,
        height: 400,
        close: function(event, ui){
            comments_div.dialog("destroy");
            comments_div.hide();
            comments_div.children(".comment").remove();
            comments_div.children("fieldset").remove();
        }
  });
  comments_div.dialog('open');
}

function sendComment(div_selector, line){
  div_selector.children("fieldset").children("a.btn-comm").click(function(e){
    let comm=$('textarea').val();
    console.log(comm);

    let is_login = $('a.menu--popup-link').text();

    if(is_login.includes("uživatel přihlášen")){
      let username = is_login.split(' - ')[1];
      let result = {
      "method": "add_comment",
      "line_name": line,
      "username": username,
      "comment": comm
    }
    result = post2php( result);
    console.log(result);
    alert("Your comment has been sent.")
    div_selector.children("fieldset").remove();
    }else{
    popup.classList.remove('hidden-abs');
  }

  });
}

function renderComments(item){
  let elems = '<div class="comment">'+
                  '<i>'+item['username']+'</i>'+
                  '<p class="comment--description">'+item['comment']+'</p>'+
              '</div>'
  comments_to_ren += elems;         
      // $('div.comments').after(elems);
}

function getComments(line_name){
  let data = {
    "method": "get_comments",
    "line_name": line_name
  }
  let result = post2php(data);
  if (!result){
    return false;
  }
  return result;
}

function replaceTrash(data) {
    data = JSON.stringify(data);
    data = data.replace(/"\[/g, '[');
    data = data.replace(/]"/g, ']');
    data = data.replace(/\\/g, '');
    return data;
}

function post2php( data) {
    // console.log(method);
    console.log(data);
    let result = null;
    // dataReq = "method=add_like&username=admin&smer_from=Dejvicka&smer_to=Hradcanska&line=Tram+26&t_from=1736&t_to=1740";
    $.ajax({
        url: 'php/post_manager.php',
        type: 'POST',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        async: false,
        dataType: 'json',
        data: data,
        success: function(dataBack){
            console.log(dataBack);
            result = dataBack;
        },
        error: function (e) {
            // console.log(dataReq);
            console.log(e);
            result = false;
          }
    });
    return result;
}

// var xhr = new XMLHttpRequest();
// var url = "url";
// xhr.open("POST", url, true);
// xhr.setRequestHeader("Content-Type", "application/json");
// xhr.onreadystatechange = function () {
//     if (xhr.readyState === 4 && xhr.status === 200) {
//         var json = JSON.parse(xhr.responseText);
//         console.log(json.email + ", " + json.password);
//     }
// };
// var data = JSON.stringify({"email": "hey@mail.com", "password": "101010"});
// xhr.send(data);


// const renderTemplate = (container, template, place) => {
//   container.insertAdjacentHTML(place, template);
// };

// const container = document.querySelector('.results');

// const searchBtn = document.querySelector('.search--btn');

// searchBtn.addEventListener('click', (evt) => {
//   evt.preventDefault();
//   for (let i = 0; i < linesCount; i++) {
//     renderTemplate(container, lineTemplate(), 'beforeend');
//   }
//   const hearts = document.querySelectorAll('.heart');
//   for (heart of hearts) {
//     heart.addEventListener('click', openPopup);
//   }
//   const commentCounts = document.querySelectorAll('.result--comment__count');
//   for (commentCount of commentCounts) {
//     commentCount.addEventListener('click', renderComment);
//   }
// });


