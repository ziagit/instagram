<style>
 
</style>
<div class="card " style="width: 100%; ">
    <div class="card-body is-transparent" style="padding: 0px;">
            <div class="user-info">
                <figure class="image is-32x32">
                    <img class="is-rounded" src="{{ asset('images/avatar/'.$post->user->image) }}">
                </figure>
                <div class="user-text ">
                    <a class="is-size-6 has-text-info " href="{{  route('account.show', ['id' => $post->user->id]) }}">{{
                        '@'.$post->user->name }}</a>
                </div>
            </div>
        <div class="card-image">
            <figure class="image is-square">
                <img src="{{ asset('images/posts/'.$post->image) }}" >
            </figure>
        </div>

        <div class="card-content">
            <div class="buttons">
                <button data-path="{{ route('posts.like', ['id'=>$post->id]) }}" class="post-action like {{ $post->likes->where('user_id', Auth::id())->count() > 0 ? "liked" : ""}}">
                    <span class="likes">{{ $post->likes->count() < 999 ? $post->likes->count() : "999+" }}</span>
                    <i class="fas fa-heart user-like" ></i>
                </button>
                <a href=""  class="post-action " style="margin-left: 15px; background-color: #f8f9fa;">
                    
                    <i class="fas fa-comment user-like" ></i>
                </a>

                @if($post->user->id === Auth::id())
                    <a href="{{ route('posts.edit', ['id'=>$post->id]) }}" class="post-action">
                        <i class="fas fa-pen"></i>
                    </a>
                @endif
            </div>
            <p class="lead ">
                <a href="{{  route('account.show', ['id' => $post->user->id]) }}" class="color-dark">
                    <b>{{$post->user->name}}</b>
                </a>
                <span id="descriptonـ{{$post->id}}">{{  str_limit($post->description,20) }}</span>
                <a href="#" id="more_id{{$post->id}}" onclick="showMoreDescription({{$post}},event);">more</a>
            </p>
            @if($post->comments->count() >0)
                <a href="#" id="mor-comment-post/{{$post->id}}" class="color-dark ml-8">View all {{$post->comments->count()}} comments</a>
                @foreach($post->comments->take(2) as $comment)
                    <p class="lead ">
                        <a href="{{  route('account.show', ['id' => $comment->id]) }}" class="color-dark">
                            <b>{{$comment->name}}</b>
                        </a>
                        <span>{{  str_limit($comment->pivot->comment,100) }}</span>
                        
                    </p>
                @endforeach
            @endif
            <div class="card-footer">
                
                <time class="has-text-grey-light ml-8" datetime="{{ $post->created_at }}"></time>
            </div>
            <hr>
            <!-- The form of comment -->
            <form class="comment" action="{{URL('comment')}}" method="post">
                <input type="hidden" value="{{csrf_token()}}" name="_token" id="token{{$post->id}}" onkeyup="submitComment({{$post->id}},event)">
                <input type="text" id="comment{{$post->id}}" placeholder="Add a comment..." name="comment" autocomplete="off">
                <button  type="submit" onclick="submitFunction({{$post->id}});return false;" >post</button>
            </form>
        </div>
    </div>
</div>

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
                    comment.value = "";
                }
                } catch(err) {
                    console.log(err.message + " in " + xmlhttp.responseText);
                    return;
                }
                
            }
        }
        xmlHttp.open("post", "comment"); 
        xmlHttp.send(formData);
     } 
}

function submitComment(id,event){
    var comment = document.getElementById("comment"+id);
    if(comment.value != ""){
        if(event.keyCode == 13){
            submitFunction(id);
        }
    }
}
</script>
