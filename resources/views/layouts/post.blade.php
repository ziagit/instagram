<div class="card post has-background-dark">
    <div class="card-body is-transparent" style="padding: 0px;">
        <div class="card-image">
            <figure class="image is-square">
                <img src="{{ asset('images/posts/'.$post->image) }}">
            </figure>
        </div>

        <div class="card-content">
            <div class="user-info">
                <figure class="image is-48x48">
                    <img class="is-rounded" src="{{ asset('images/avatar/'.$post->user->image) }}">
                </figure>
                <div class="user-text">
                    <p class="is-size-3 has-text-white">{{ $post->user->display_name ? $post->user->display_name : $post->user->name }}</p>
                    <a class="is-size-6 has-text-info" href="{{  route('account.show', ['id' => $post->user->id]) }}">{{
                        '@'.$post->user->name }}</a>
                </div>
            </div>
            <p class="lead is-size-5 has-text-white">{{ $post->description }}</p>
            <div class="card-footer">
                <div class="buttons">
                    <button data-path="{{ route('posts.like', ['id'=>$post->id]) }}" class="post-action like {{ $post->likes->where('user_id', Auth::id())->count() > 0 ? "liked" : ""}}">
                        <span class="likes">{{ $post->likes->count() < 999 ? $post->likes->count() : "999+" }}</span>
                        <i class="fas fa-heart"></i>
                    </button>

                    @if($post->user->id === Auth::id())
                        <a href="{{ route('posts.edit', ['id'=>$post->id]) }}" class="post-action">
                            <i class="fas fa-pen"></i>
                        </a>
                    @endif
                </div>
                <time class="has-text-grey-light" datetime="{{ $post->created_at }}"></time></div>
        </div>
    </div>
</div>
