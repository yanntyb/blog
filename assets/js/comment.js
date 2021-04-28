let submit = document.getElementById("commentSubmit");
let input = document.getElementById("commentInput");
let id = document.getElementById("articleDiv").dataset.id;
let commentDiv = document.getElementById("commentDiv");
let userSelect = document.getElementById("user");
let scroll = false;
let userId = userSelect.value;

//envoie un commentaire en Ajax
submit.addEventListener("click", function(e){
    e.preventDefault();
    if(input.value.length > 0){
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../../api/comment/post.php");
        xhr.onload = () => {
            scroll = false;
            input.value = "";
        }
        xhr.send(JSON.stringify({
            "user" : userId,
            "articleId" : id,
            "content" : input.value,
        }));
    }
})

//Affiche les commentaire en Ajax
function load(){
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../../api/comment/get.php?id=" + id);
    xhr.send();
    xhr.onload = () => {
        commentDiv.innerHTML = "";
        let result = JSON.parse(xhr.responseText);
        for (let comment of result) {
            let html = `
                <div data-id="${comment["id"]}" class="comment">
                    <div class="commentAuthor">
                        ${comment["author"]} :
                    </div>
                    <div class="commentContent">
                           ${comment["content"]}
                    </div>
            `
            if (comment["admin"] === 1) {
                html += `<span class='close'><i class="fas fa-times"></i></span>`;
            }

            commentDiv.innerHTML += html + `</div>`;
        }
        let closes = document.getElementsByClassName("close");
        for (let close of closes) {
            close.addEventListener("click", function () {
                let id = close.parentNode.dataset.id;
                let xhr2 = new XMLHttpRequest();
                xhr2.open("POST", "../../api/comment/post.php?delete=true")
                xhr2.send(JSON.stringify({"id":id}));
            })
        }
    }
}

function timeOut(){
    setTimeout(() => {
        load();
        if(!scroll){
            document.body.scrollTop = document.body.scrollHeight;
            scroll = true;
        }

        timeOut();
    }, 1000);
}

load();
timeOut();
