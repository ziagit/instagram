
@foreach($posts as $post)
<div class="card " style="padding: 0;width: 100%;">
    <div class="card-body is-transparent" style="padding: 0px;">
            <div class="user-info">
                <figure class="image is-32x32" style="margin-right: 0;">
                    @if($post->user->social_path != "")
                        <img class="is-rounded" src="{{ $post->user->social_path }}">
                    @else
                    <img class="is-rounded" src="{{ asset('images/avatar/'.$post->user->image) }}">
                    @endif
                </figure>
                <span style="margin-right: 10px;color: #28b351;">
                    @if(Cache::has("is_online".$post->user->id))
                    <i class="fas fa-circle" style="font-size: 9px;"></i>
                    @endif
                </span>
                <div class="user-text ">
                    <a class="is-size-6 has-text-info " href="{{  route('account.show', $post->user->id) }}">{{
                        '@'.$post->user->name }}</a>
                </div>
                <a href="#modal-center{{$post->id}}" uk-toggle class="color-dark" style="right: -20px; font-size: 25px; margin-bottom: 5px; position: absolute; right: 6%;">...</a>
            
                <div id="modal-center{{$post->id}}" class="uk-flex-top " uk-modal>
                    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-width-large ">
                        
                        <a>
                            <div  style="text-align: center; border-bottom: 1px solid #ddd; padding-bottom: 20px; color: red;">
                            <form method="POST" action="{{ route('account.follow', $post->user->id) }}" class="w100">
                                        @csrf
                                        <input type="submit" class="btn btn-link mp " style="color: red;" value="{{ __('Unfollow') }}" style="margin-left: 0;">
                                    </form>
                            </div>
                        </a>
                        <a>
                            <div class="uk-modal-close" onclick="shareOnfacebook(`{{config('app.url')}}/images/posts/{{$post->image}}`,`{{$post->user->name}}`);" style="text-align: center; border-bottom: 1px solid #ddd; padding-bottom: 20px;padding-top: 20px;">
                                <i class="fab fa-facebook"></i> Share
                            </div>
                        </a>
                        <a>
                            <div class="uk-modal-close" onclick="shareOntwitter(`{{config('app.url')}}/images/posts/{{$post->image}}`,`{{$post->user->name}}`);" style="text-align: center; border-bottom: 1px solid #ddd; padding-bottom: 20px;padding-top: 20px;">
                                <i class="fab fa-twitter"></i> Share
                            </div>
                        </a>
                        <a>
                            <div class="uk-modal-close" onclick="copyToClipboard(`{{config('app.url')}}/images/posts/{{$post->image}}`);showToast(`Link copied to clipboard.`);" class="uk-modal-close" style="text-align: center; border-bottom: 1px solid #ddd; padding-bottom: 20px;padding-top: 20px;">
                                Copy link
                            </div>
                        </a>
                        <a>
                            <div class="uk-modal-close" style="text-align: center; padding-top: 20px;">
                                Cancel
                            </div>
                        </a>
                        
                    </div>
                </div>
            </div>
        <div class="card-image">
            <img src="{{ asset($post->image) }}" >
        </div>

        <div class="card-content">
            <div class="buttons">
                <button id="button{{$post->id}}" onclick="likeFunction({{$post->id}})" style="outline: none;" data-path="{{ route('posts.like', $post->id) }}" class="post-action like {{ $post->likes->where('user_id', Auth::id())->count() > 0 ? "liked" : ""}}">
                    <span class="likes" id="likes{{$post->id}}">{{ $post->likes->count() < 999 ? $post->likes->count() : "999+" }}</span>
                    <i class="fas fa-heart mp" ></i>
                </button>
                <a href="{{route('posts.details',$post->id)}}"  class="post-action " style="margin-left: 15px; background-color: #f8f9fa;">
                    
                    <i class="fas fa-comment mp" ></i>
                </a>

                @if($post->user->id === Auth::id())
                    <a href="{{ route('posts.edit', $post->id) }}" class="post-action">
                        <i class="fas fa-pen"></i>
                    </a>
                @endif
            </div>
            <p class="lead ">
                <a href="{{  route('account.show', $post->user->id) }}" class="color-dark">
                    <b>{{$post->user->name}}</b>
                </a>
                <span class="fs-1rem" id="descriptonـ{{$post->id}}">{{  Str::limit($post->description,40) }}</span>
                @if(strlen($post->description) > 40)
                <a href="#" id="more_id{{$post->id}}" onclick="showMoreDescription({{$post}},event);">more</a>
                @endif
            </p>
            @if($post->comments->count() >0)
            <div>
                <a href="{{route('posts.details',$post->id)}}" id="mor-comment-post/{{$post->id}}" class="color-dark ml-8" >View all 
                    <span class="fs-1rem" id="comment-count{{$post->id}}">{{$post->comments->count()}}</span> comments
                </a>
            </div>
                
                @foreach($post->comments->take(2) as $comment)
                    <p class="lead ">
                        <a href="{{  route('account.show', $comment->id) }}" class="color-dark">
                            <b>{{$comment->name}}</b>
                        </a>
                        <span>{{  Str::limit($comment->pivot->comment,100) }}</span>
                        
                    </p>
                @endforeach
            @else
                <div>
                    <a href="{{route('posts.details',$post->id)}}" id="mor-comment-post/{{$post->id}}" class="color-dark ml-8" data-toggle="dropdown">View all 
                        <span id="comment-count{{$post->id}}">0</span> comments
                    </a>
                </div>
            @endif
            <div class="card-footer">
                
                <time class="has-text-grey-light ml-8" datetime="{{ $post->created_at }}"></time>
            </div>
            <hr>
            <!-- The form of comment -->
            <form class="comment" action="{{URL('comment')}}" method="post">
                <input type="hidden" value="{{csrf_token()}}" name="_token" id="token{{$post->id}}" onkeyup="submitComment({{$post->id}},event)">
                <input type="text" style="font-size: 14px;" id="comment{{$post->id}}" placeholder="Add a comment..." name="comment" autocomplete="off">
                <button  type="submit" onclick="submitFunction({{$post->id}});return false;" >post</button>
            </form>
        </div>
    </div>
</div>
@endforeach

