<!-- Script for comment in a post -->
<script>
    function submitFunction(id)
{
    var comment = document.getElementById("comment"+id);
    var _token = document.getElementById("token"+id);
    var formData = new FormData(); 
     if(comment.value != ""){
        formData.append(comment.name, comment.value);
        formData.append("post_id",id);
        formData.append(_token.name,_token.value);
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function()
        {
            if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
            {
                try {
                var data = JSON.parse(xmlHttp.responseText);
                if(data.status == true){
                    var comment_count = document.getElementById("comment-count"+id);
                    comment_count.textContent = parseInt(comment_count.innerText)+1;
                    comment.value = "";
                }
                } catch(err) {
                    console.log(err.message + " in " + xmlHttp.responseText);
                    return;
                }
                
            }
        }
        xmlHttp.open("post", "/comment"); 
        xmlHttp.send(formData);
     } 
}

//Press enter key will call the submitFunction
function submitComment(id,event){
    var comment = document.getElementById("comment"+id);
    if(comment.value != ""){
        if(event.keyCode == 13){
            submitFunction(id);
        }
    }
}
</script>