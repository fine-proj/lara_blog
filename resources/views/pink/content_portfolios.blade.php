<!-- START CONTENT -->
<div id="content-page" class="content group">
    <div class="hentry group">
       <!-- <script>
            jQuery(document).ready(function($){
                $('.sidebar').remove();

                if( !$('#primary').hasClass('sidebar-no') ) {
                    $('#primary').removeClass().addClass('sidebar-no');
                }

            });
        </script> -->

        @if($portfolios)
        <div id="portfolio" class="portfolio-big-image">

            @foreach($portfolios as $item)

            <div class="hentry work group">
                <div class="work-thumbnail">
                    <div class="nozoom">
                        <img src="{{ asset(env('THEME')) }}/images/projects/{{ $item->img->max }}" alt="0061" title="0061" />
                        <div class="overlay">
                            <a class="overlay_img" href="{{ asset(env('THEME')) }}/images/projects/{{ $item->img->path }}" rel="lightbox" title=""></a>
                            <a class="overlay_project" href="{{ route('portfolios.show', ['alias'=>$item->alias]) }}"></a>
                            <span class="overlay_title">{{ $item->title }}</span>
                        </div>
                    </div>
                </div>
                <div class="work-description">
                    <h3>{{ $item->title }}</h3>
                    <p>{!!  str_limit($item->text, 200) !!} [...]</p>
                    <div class="clear"></div>
                    <div class="work-skillsdate">
                        <p class="skills"><span class="label">Filter:</span> {{ $item->filter->title }}</p>
                        <p class="workdate"><span class="label">Customer:</span>{{ $item->customer }}</p>
                        @if($item->created_at)
                            <p class="workdate"><span class="label">Year:</span>{{$item->created_at->format('Y')}}</p>
                        @endif
                    </div>
                    <a class="read-more" href="{{ route('portfolios.show', ['alias'=>$item->alias]) }}">View Project</a>
                </div>
                <div class="clear"></div>
            </div>

            @endforeach

            <!--------START PAGINATIONS ELEMENT-------->
                <div class="general-pagination group">
                    @if ($portfolios->lastPage() > 1)
                        <ul class="pagination">

                            @if ($portfolios->currentPage() !== 1)
                                <a  href="{{ $portfolios->url(($portfolios->currentPage()-1)) }}">{!! Lang::get('pagination.previous') !!}</a>
                            @endif
                            @for ($i = 1; $i <= $portfolios->lastPage(); $i++)

                                @if ($portfolios->currentPage() == $i)
                                    <a class="selected disabled">{{ $i }}</a>
                                @else
                                    <a href="{{ $portfolios->url($i) }}">{{ $i }}</a>
                                @endif


                            @endfor

                            @if ($portfolios->currentPage() !== $portfolios->lastPage())

                                <a href="{{ $portfolios->url($portfolios->currentPage()+1) }}" >{!! Lang::get('pagination.next') !!}</a>
                            @endif
                        </ul>
                    @endif
                </div>
            <!--------END PAGINATIONS ELEMENT-------->

        </div>


        @endif
        <div class="clear"></div>
    </div>
    <!-- START COMMENTS -->
    <div id="comments">
    </div>
    <!-- END COMMENTS -->
</div>
<!-- END CONTENT -->