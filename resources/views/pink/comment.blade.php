@foreach($items as $it)
<li id="li-comment-{{ $it->id }}" class="comment even {{ ($it->user_id == $article->user_id) ? 'bypostauthor odd' : ''}}">
    <div id="comment-{{ $it->id }}" class="comment-container">
        <div class="comment-author vcard">
            @set($hash, isset($it->email) ? md5($it->email) : md5($it->user->email) )
            <img alt="" src="https://www.gravatar.com/avatar/{{ $hash }}?d=mm&s=75" class="avatar" height="75" width="75" />
            <cite class="fn">{{ $it->user->name or $it->name }}</cite>
        </div>
        <!-- .comment-author .vcard -->
        <div class="comment-meta commentmetadata">
            <div class="intro">
                <div class="commentDate">
                    <a href="#comment-2">
                        {{ is_object($it->created_at) ? $it->created_at->format('F d, Y \a\t H:i') : ''}}</a>
                </div>
                <div class="commentNumber">#&nbsp;</div>
            </div>
            <div class="comment-body">
                <p>{{ $it->text }}</p>
            </div>
            <div class="reply group">
                <a class="comment-reply-link" href="#respond" onclick="return addComment.moveForm(&quot;comment-{{$it->id}}&quot;, &quot;{{$it->id}}&quot;, &quot;respond&quot;, &quot;{{$it->article_id}}&quot;)">Reply</a>
            </div>
            <!-- .reply -->
        </div>
        <!-- .comment-meta .commentmetadata -->
    </div>
    <!-- #comment-##  -->

    @if(isset($com[$it->id]))
        <ul class="children">
            @include(env('THEME') . '.comment', ['items' => $com[$it->id]])
        </ul>
    @endif

</li>
@endforeach