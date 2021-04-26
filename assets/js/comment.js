let submit = document.getElementById("commentSubmit");
let input = document.getElementById("commentInput");
let id = document.getElementById("articleContent").dataset.id;
let commentDiv = document.getElementById("commentDiv");
let userSelect = document.getElementById("user");

let userId = userSelect.value;

userSelect.addEventListener("onChange", function(){
    userId = userSelect.value;
})

submit.addEventListener("click", function(e){
    e.preventDefault();
    if(input.value.length > 0){
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../../api/comment/post.php");
        xhr.send(JSON.stringify({
            "user" : userId,
            "articleId" : id,
            "content" : input.value,
        }));
    }
})

function load(){
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../../api/comment/get.php?id=" + id);
    xhr.send();
    xhr.onload = () => {
        commentDiv.innerHTML = "";
        let result = JSON.parse(xhr.responseText);
        for(let comment of result){
            commentDiv.innerHTML += `
                <div class="comment">
                    <div class="commentAuthor">
                        ${comment["author"]}
                    </div>
                    <div class="commentContent">
                           ${comment["content"]}
                    </div>
                </div>
            `
        }
    }
}

function timeOut(){
    setTimeout(() => {
        load();
        timeOut();
    }, 1000);
}

load();
timeOut();
