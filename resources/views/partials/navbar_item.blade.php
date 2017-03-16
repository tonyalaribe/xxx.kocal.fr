<li {!! Route::currentRouteName() === $link['route'] ? 'class="active"' : '' !!}>
    <a href="{{ route($link['route']) }}">{{ $link['text'] }}</a>
</li>