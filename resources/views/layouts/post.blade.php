<style>
 
</style>
<div class="card " style="width: 100%; ">
    <div class="card-body is-transparent" style="padding: 0px;">
            <div class="user-info">
                <figure class="image is-32x32">
                    <img class="is-rounded" src="{{ asset('images/avatar/'.$post->user->image) }}">
                </figure>
                <div class="user-text">
                    <a class="is-size-6 has-text-info" href="{{  route('account.show', ['id' => $post->user->id]) }}">{{
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
            <p class="lead "><span id="descriptonـ{{$post->id}}">{{  str_limit($post->description,50) }}</span><a href="#" id="more_id{{$post->id}}" onclick="showMoreDescription({{$post}},event);">more</a></p>
            <div class="card-footer">
                
                <time class="has-text-grey-light" datetime="{{ $post->created_at }}"></time>
            </div>
            <hr>
            <!-- The form -->
            <form class="comment" action="{{URL('post-comment')}}/{{$post->id}}">
                <input type="text" placeholder="Add a comment..." name="search" autocomplete="off">
                <button type="submit">post</button>
            </form>
        </div>
    </div>
</div>
