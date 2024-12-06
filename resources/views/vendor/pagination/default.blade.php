@if ($paginator->hasPages())






<div class="pagination__area bg__gray--color px-0 mx-0">
    <nav class="align-items-center flex-wrap justify-content-center justify-content-lg-between pagination">
        <p class="product__showing--count text-gray p-0 py-2 m-0">Showing {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} of {{ $paginator->total() }} results</p>
        <ul class="pagination__wrapper d-flex align-items-center justify-content-center">

            @if ($paginator->onFirstPage())



            <li class="pagination__list disabled" aria-disabled="true">
                Previous
                <span class="visually-hidden" aria-hidden="true">pagination arrow</span>

            <li>


                @else

            <li class="pagination__list">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination__item--arrow  link ">
                    Previous
                    <span class="visually-hidden">pagination arrow</span>
                </a>
            <li>


                @endif


                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
            <li class="pagination__list disabled" aria-disabled="true"><span class="pagination__item pagination__item--current">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li class="pagination__list active" aria-current="page"><span class="pagination__item pagination__item--current">{{ $page }}</span></li>
            @else
            <li class="pagination__list"><a href="{{ $url }}" class="pagination__item link">{{ $page }}</a></li>
            @endif
            @endforeach
            @endif
            @endforeach



            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())


            <li class="pagination__list">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination__item--arrow  link ">
                    Next
                    <span class="visually-hidden">pagination arrow</span>
                </a>
            <li>



                @else

            <li class="pagination__list disabled" aria-disabled="true">
                Next
                <span class="visually-hidden" aria-hidden="true">pagination arrow</span>

            <li>

                @endif







        </ul>
    </nav>
</div>





@endif