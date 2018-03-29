<!-- START CONTENT -->
<div id="content-blog" class="content group">

    @if($articles)
        @foreach($articles as $item)
            <div class="sticky hentry hentry-post blog-big group">
                <!-- post featured & title -->
                <div class="thumbnail">
                    <!-- post title -->
                    <h2 class="post-title"><a href="{{ route('articles.show', ['articles'=>$item->alias]) }}">{{ $item->title }}</a></h2>
                    <!-- post featured -->
                    <div class="image-wrap">
                        <img src="{{ asset(env('THEME')) }}/images/articles/{{ $item->img->max }}" alt="001" title="001" />
                    </div>
                    <p class="date">
                        <span class="month">{{ $item->created_at->format('M') }}</span>
                        <span class="day">{{ $item->created_at->format('d') }}</span>
                    </p>
                </div>
                <!-- post meta -->
                <div class="meta group">
                    <p class="author"><span>by <a href="#" title="{{ $item->user->name }}" rel="author">{{ $item->user->name }}</a></span></p>
                    <p class="categories"><span>In: <a href="{{ route('articlesCat', ['cat_alias'=>$item->category->alias]) }}" title="View all posts in {{ $item->category->title }}" rel="category tag">{{ $item->category->title }}</a></span></p>
                    <p class="comments"><span><a href="{{ route('articles.show', ['articles'=>$item->alias]) }}#respond" title="Comment on Section shortcodes &amp; sticky posts!">{{ count($item->comments)>0 ? count($item->comments) : '0' }} {{ Lang::choice('ru.comments', count($item->comments) ) }}</a></span></p>
                </div>
                <!-- post content -->
                <div class="the-content group">
                    {!! $item->desc !!}
                    <p><a href="{{ route('articles.show', ['articles'=>$item->alias]) }}" class="btn   btn-beetle-bus-goes-jamba-juice-4 btn-more-link">{{ Lang::get('ru.read_more') }}</a></p>
                </div>
                <div class="clear"></div>
            </div>

        @endforeach
    @endif

    <div class="general-pagination group"><a href="#" class="selected">1</a><a href="#">2</a><a href="#">&rsaquo;</a></div>

</div>
<!-- END CONTENT -->