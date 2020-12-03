@extends('layouts.app')

@section('content')
@foreach($posts as $post)
<div class="row container" >
    <div class="col-md-2 col-sm-12"></div>
    <div class="col-md-6">
        <div class="card " style="padding: 0; width: 100%;">
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
                        <a class="is-size-6 has-text-info " href="{{  route('account.show',  $post->user->id) }}">{{
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
                    <button style="outline: none;" data-path="{{ route('posts.like', $post->id) }}" class="post-action like {{ $post->likes->where('user_id', Auth::id())->count() > 0 ? "liked" : ""}}">
                        <span class="likes">{{ $post->likes->count() < 999 ? $post->likes->count() : "999+" }}</span>
                        <i class="fas fa-heart mp" ></i>
                    </button>
                    <a href=""  class="post-action " style="margin-left: 15px; background-color: #f8f9fa;">
                        
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
                
            
                <div class="card-footer">
                    
                    <time class="has-text-grey-light ml-8" datetime="{{ $post->created_at }}"></time>
                </div>
                <hr>
            </div>
                </div>
            </div>
        </div>
   <div  class="user_menu col-md-3 " style="padding-left: 10%;">
        <div style="margin-top: 10px; position: fixed;">

            <div class="row" >
            <span id="comment-count{{$post->id}}">{{$post->comments->count()}}</span> comments
                <div style="margin-top: 10px; width: 100%; overflow-y: scroll; height: 350px;min-height: 200px;" >
                    @foreach($post->comments as $comment)
                    <div class="row" style="display: inline-block; margin-top: 10px; width: 100%;">
                        <div class="col-md-4">
                            <a  href="/user/{{$comment->id}}" tabindex="0" style="width: 56px; height: 56px;">
                            @if($comment->social_path != "")
                                <img alt="profile picture" class="circle-user-image-32" data-testid="user-avatar" draggable="false" src="{{ $comment->social_path }}">
                            @else
                            <img alt="profile picture" class="circle-user-image-32" data-testid="user-avatar" draggable="false" src="{{ asset('images/avatar/'.$comment->image)}}">
                            @endif
                            </a>
                        </div>
                        <div  class="col-md-8">
                            <div class="row">
                                <div class="col-md-8">
                                <a href="{{  route('account.show',  $comment->id) }}" class="color-dark fs-10">
                                    <b>{{$comment->name}}</b>
                                </a>
                                <span class="fs-1rem" class="fs-10">{{  $comment->pivot->comment }}</span>

                            
                                </div>
                            </div>
                        </div>
                            
                        
                    </div>
                    @endforeach
                    <div class=" " style="padding: 0; width: 55%;margin-left: 0;">
                    <div class="card-body is-transparent" style="padding: 0px;">
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
            </div>
            <div class="row">
                
                
            </div>
            </div>
        </div>
    </div>

</div>
@endforeach

@include('layouts.script')


@endsection
