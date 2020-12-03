@foreach($users as $user)
@if($user->id != auth()->id())
<a href="/user/{{$user->id}}">
<div style="display: inline-block; margin-top: 10px; width: 100%; border-bottom: 1px solid lightgray;" class="ml-15">
    <div class="display-inline">
        <span tabindex="0" style="width: 56px; height: 56px;">
            @if($user->social_path != "")
            <img alt="hassani.esmatullah's profile picture" class="circle-user-image-32" data-testid="user-avatar" draggable="false" src="{{ $user->social_path }}">
            @else
            <img alt="hassani.esmatullah's profile picture" class="circle-user-image-32" data-testid="user-avatar" draggable="false" src="{{ asset('images/avatar/'.$user->image)}}">
            @endif
            <span style="color: #28b351;">
                @if(Cache::has("is_online".$user->id))
                <i class="fas fa-circle" style="font-size: 9px;"></i>
                @endif
            </span>
        </span>
    
    </div>
    <div  class="display-inline">
        <span class="margin-left-10 color-dark" >{{$user->display_name}}</span><br>
    
        <span class="margin-left-10 color-dark" style="font-size: 15px;">{{$user->name}}</span>
    </div>
    
</div>
</a>
<br>
@endif
@endforeach