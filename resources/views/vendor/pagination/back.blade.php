
@if ($paginator->hasPages())
<ul class="pagination pagination-circle" style="display:flex !important;justify-content: center !important;">
   
    @if ($paginator->onFirstPage())
        <li class="page-item page-indicator"><a class="page-link" disabled><i class="la la-angle-left"></i></a></li>
    @else
        <li class="page-item page-indicator"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="la la-angle-left"></i></a></li>
    @endif

  
    @foreach ($elements as $element)
       
        @if (is_string($element))
            <li class="page-item page-indicator disabled"><span>{{ $element }}</span></li>
        @endif


       
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active"><a class="page-link" disabled>{{ $page }}</a></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach


    
    @if ($paginator->hasMorePages())
        <li class="page-item page-indicator"><a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="la la-angle-right"></i></a></li>
    @else
        <li class="page-item page-indicator"><a class="page-link" disabled><i class="la la-angle-right"></i></a></li>
    @endif
</ul>
@endif 