<!-- START SIDEBAR -->

    <div class="widget-first widget recent-posts">
        <h3>{{ Lang::get('ru.latest_projects') }}</h3>
        <div class="recent-post group">
            @if(!$portfolios->isEmpty())
                @foreach($portfolios as $item)
                <div class="hentry-post group">
                    <div class="thumb-img"><img style="width: 55px" src="{{ asset( env('THEME') ) }}/images/projects/{{ $item->img->mini }}" alt="001" title="001" /></div>
                    <div class="text">
                        <a href="{{ route('portfolios.show', ['alias'=>$item->alias]) }}" title="Section shortcodes &amp; sticky posts!" class="title">{{ $item->title }}</a>
                        </br>
                        {{ str_limit($item->text, 130) }}
                        </br>
                        <a class="read-more" href="{{ route('portfolios.show', ['alias'=>$item->alias]) }}">{{Lang::get('ru.read_more')}}</a>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>


    <div class="widget-last widget recent-comments">
        <h3>{{Lang::get('ru.latest_comments')}}</h3>
        <div class="recent-post recent-comments group">

            @if(!$comments->isEmpty())
                @foreach($comments as $item)
                    <div class="the-post group">
                        <div class="avatar">
                            @set($hash, ($item->email) ? md5($item->email) : md5($item->user->email) )
                            <img alt="" src="https://www.gravatar.com/avatar/{{ $hash }}?d=mm&s=55" class="avatar" />
                        </div>
                        <span class="author"><strong><a href="#">{{ ($item->name) ? ($item->name) : ($item->user->name) }}</a></strong> in</span>
                        <a class="title" href="{{ route('articles.show', ['alias'=>$item->article->alias]) }}">{{ $item->article->title }}</a>
                        <p class="comment">
                            {{ $item->text }} <a class="goto" href="{{ route('articles.show', ['alias'=>$item->article->alias]) }}">&#187;</a>
                        </p>
                    </div>
                @endforeach
            @endif

        </div>
    </div>

<!-- END SIDEBAR -->