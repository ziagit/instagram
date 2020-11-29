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

//share to facebook
function shareOnfacebook(image,name){
    var url = `https://www.facebook.com/sharer/sharer.php?u=${image}`;
       window.open(url, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
       return false;
}

//share to twitter
function shareOntwitter(image,name){
    var url = `https://twitter.com/intent/tweet?url=${image}&via=${name}&text=See this image`;
    TwitterWindow = window.open(url, 'TwitterWindow',width=600,height=300);
    return false;
 }

 //coppy the link
 function copyToClipboard(text) {
  var input = document.body.appendChild(document.createElement("input"));
  input.value = text;
  input.select();
  document.execCommand('copy');
  input.parentNode.removeChild(input);
}

//show toast
function showToast(text) {
  // Get the snackbar DIV
  var x = document.getElementById("snackbar");
  x.innerText = text;

  // Add the "show" class to DIV
  x.className = "show";

  // After 3 seconds, remove the show class from DIV
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

    /**show more description of a post
    *@param post,event
    */
    function showMoreDescription(post,event){
        event.preventDefault();
        document.getElementById("descriptonـ"+post.id).innerHTML = post.description;
        document.getElementById("more_id"+post.id).style.display="none";
    }

    /**
     *Search all user
     *@param event
     */
    function getUsers(event){
        var name = $("#user_name").val();
        event.preventDefault();
        if(name != ""){
            $("#spinner_loadder").show("fast");
            $(".search-dropdown").attr("style","border:1px solid rgba(0,0,0,.15);");
            $.ajax({
                url:"/get-users/"+name,
                type:"get",

                beforeSend: function()
	            {
                    $("#spinner_loadder").show("fast");
	            },
                error:function(er){
                    $("#spinner_loadder").show("fast");
                }
	        })
	        .done(function(data)
	        {
                $("#spinner_loadder").hide("fast");
	            if(data == ""){
                    $("#dropdown_menu").html("");
                    $("#no-data").text("No results found.");
	                return;
                }
                if(data != ""){
                    $("#dropdown_menu").html(data);
                }
	        })
	        .fail(function(jqXHR, ajaxOptions, thrownError)
	        {
                $("#spinner_loadder").show("fast");
	        });
        }
        else{
            $("#dropdown_menu").html("");
            $("#spinner_loadder").hide("fast");
            $("#no-data").text("");
            $(".search-dropdown").attr("style","border:0px;");

        }
        
    }

    /**
     * show the mobile menu
     */
    function showMobilemenu(event){
        var toggle = document.getElementById("navbar-burger");
        var target = document.querySelector(event.target.dataset.target);
        event.target.classList.toggle('is-active');
        target.classList.toggle('is-active');
    }
</script>