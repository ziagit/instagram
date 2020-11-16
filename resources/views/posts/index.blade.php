@extends('layouts.app')

@section('content')
<div class="card-container">
    @if(count($posts) > 0)
        @foreach($posts as $post)
            @include('layouts.post', $post)
        @endforeach
    @else
        @include('posts.empty')
    @endif
</div>

@if(isset($pagination['current'], $pagination['count']) && $pagination['count'] > 0)
    <nav class="pagination is-rounded" role="navigation" aria-label="pagination">
        <ul class="pagination-list">

            {{-- If current page isn't 1 --}}
            @if($pagination['current'] !== 1)
                <li><a class="pagination-link"
                        href="{{ url()->current() }}?page=1"
                        aria-label="Goto page 1">

                        1
                </a></li>
            @endif

            {{-- If there are more than 2 pages between 1 and current --}}
            @if($pagination['current'] - 2 > 1)
                <li><span class="pagination-ellipsis">&hellip;</span></li>
            @endif

            {{-- If the previous page isn't page 1 --}}
            @if($pagination['current'] - 1 > 1)
                <li><a class="pagination-link"
                        href="{{ url()->current() }}?page={{ $pagination['current'] - 1 }}"
                        aria-label="Goto page {{ $pagination['current'] - 1 }}">

                    {{ $pagination['current'] - 1 }}
                </a></li>
            @endif

            {{-- Current page--}}
            <li><a class="pagination-link is-current"
                    aria-label="Page {{ $pagination['current'] }}"
                    aria-current="page">

                {{ $pagination['current'] }}
            </a></li>

            {{-- If the next page isn't final page--}}
            @if($pagination['current'] + 1 < $pagination['count'])
                <li><a class="pagination-link"
                        href="{{ url()->current() }}?page={{ $pagination['current'] + 1 }}"
                        aria-label="Goto page {{ $pagination['current'] + 1 }}">

                    {{ $pagination['current'] + 1 }}
                </a></li>
            @endif

            {{-- If there are more than 2 pages between final and current --}}
            @if($pagination['current'] + 2 < $pagination['count'])
                <li><span class="pagination-ellipsis">&hellip;</span></li>
            @endif


            {{-- If current page isn't 1 --}}
            @if($pagination['current'] !== $pagination['count'])
                <li><a class="pagination-link"
                        href="{{ url()->current() }}?page={{ $pagination['count'] }}"
                        aria-label="Goto page {{ $pagination['count'] }}">

                {{ $pagination['count'] }}
                </a></li>
            @endif
        </ul>

        <div class="pagination-list">
            {{-- Next & Current Buttons--}}
            @if($pagination['current'] !== 1)
                <a class="pagination-previous"
                    href="{{ url()->current() }}?page={{ $pagination['current'] - 1 }}"
                    aria-label="Goto page {{ $pagination['current'] - 1 }}">

                    {{ __('Previous') }}
                </a>
            @else
                <button class="pagination-previous" aria-label="{{ __('No previous page') }}" disabled>
                    {{ __('Previous') }}
                </button>
            @endif

            @if($pagination['current'] !== $pagination['count'])
                <a class="pagination-next"
                    href="{{ url()->current() }}?page={{ $pagination['current'] + 1 }}"
                    aria-label="Goto page {{ $pagination['current'] + 1 }}">

                    {{ __('Next') }}
                </a>
            @else
                <button class="pagination-next" aria-label="{{ __('No more page') }}" disabled>
                    {{ __('Next') }}
                </button>
            @endif
        </div>
    </nav>
@endif

@endsection
