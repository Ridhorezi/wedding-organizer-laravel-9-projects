{{-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}

@if ($paginator->hasPages())
    <ul class="pagination d-flex align-items-center">
       
        {{-- @if ($paginator->onFirstPage())
            <li class="disabled"><span>← Previous</span></li>
        @else
            <li class="pagination-page"><a class="pagination-page_link d-flex align-items-center justify-content-center" href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a></li>
        @endif --}}


      
        @foreach ($elements as $element)
           
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif


           
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active my-active"><span>{{ $page }}</span></li>
                    @else
                        <li><a class="pagination-page_link d-flex align-items-center justify-content-center" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach


        
        {{-- @if ($paginator->hasMorePages())
            <li class="pagination-page"><a class="pagination-page_link d-flex align-items-center justify-content-center" href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a></li>
        @else
            <li class="disabled"><span>Next →</span></li>
        @endif --}}
    </ul>
@endif 