<li {!! Request::route()->getName() === $link['route'] ? 'class="active"' : '' !!}>
    <a href="{{ route($link['route']) }}">{{ $link['text'] }}</a>
</li>