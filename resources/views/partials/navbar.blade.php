<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">xxx.kocal.fr</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @each('partials.navbar_item', $links, 'link')
            </ul>

            <form action="{{ route('videos_by_search_terms') }}" method="get" class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="search" name="q" class="form-control"
                           {{-- old() throws an Exception if there is no Session attached
                           to the Request (ex: during 404) --}}
                           value="{{Request::hasSession() ? old('q') : ''}}">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>
</nav>