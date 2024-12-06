<div class="flex-grow-1 front-header-search d-flex align-items-center bg-white mx-xl-5">
    <div class="position-relative flex-grow-1 px-3 px-lg-0">
        <form action="{{ route('search') }}" method="GET" class="stop-propagation">
            <div class="d-flex position-relative align-items-center">
                <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                    <button class="btn px-2" type="button"><i class="la la-2x la-long-arrow-left"></i></button>
                </div>
                <div class="search-input-box">
                    <input type="text" class="border border-soft-light form-control fs-14 hov-animate-outline" id="search" name="keyword" @isset($query) value="{{ $query }}" @endisset placeholder="{{ translate('I am shopping for...') }}" autocomplete="off">

                    <svg id="Group_723" data-name="Group 723" xmlns="http://www.w3.org/2000/svg" width="20.001" height="20" viewBox="0 0 20.001 20">
                        <path id="Path_3090" data-name="Path 3090" d="M9.847,17.839a7.993,7.993,0,1,1,7.993-7.993A8,8,0,0,1,9.847,17.839Zm0-14.387a6.394,6.394,0,1,0,6.394,6.394A6.4,6.4,0,0,0,9.847,3.453Z" transform="translate(-1.854 -1.854)" fill="#b5b5bf" />
                        <path id="Path_3091" data-name="Path 3091" d="M24.4,25.2a.8.8,0,0,1-.565-.234l-6.15-6.15a.8.8,0,0,1,1.13-1.13l6.15,6.15A.8.8,0,0,1,24.4,25.2Z" transform="translate(-5.2 -5.2)" fill="#b5b5bf" />
                    </svg>
                </div>
            </div>
        </form>
        <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100" style="min-height: 200px">
            <div class="search-preloader absolute-top-center">
                <div class="dot-loader">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div class="search-nothing d-none p-3 text-center fs-16">

            </div>
            <div id="search-content" class="text-left">

            </div>
        </div>
    </div>
</div>

<script>
    $('#search').on('keyup', function() {
        search();
    });

    $('#search').on('focus', function() {
        search();
    });

    function search() {
        var searchKey = $('#search').val();
        if (searchKey.length > 0) {
            $('body').addClass("typed-search-box-shown");

            $('.typed-search-box').removeClass('d-none');
            $('.search-preloader').removeClass('d-none');
            $.post('{{ route('search.ajax ') }}', {
                    _token: AIZ.data.csrf,
                      search: searchKey
                },
                function(data) {
                    if (data == '0') {
                        // $('.typed-search-box').addClass('d-none');
                        $('#search-content').html(null);
                        $('.typed-search-box .search-nothing').removeClass('d-none').html('{{ translate('sorry, nothing found for ') }} <strong>"' + searchKey + '"</strong>');
                        $('.search-preloader').addClass('d-none');

                    } else {
                        $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                        $('#search-content').html(data);
                        $('.search-preloader').addClass('d-none');
                    }
                });
        } else {
            $('.typed-search-box').addClass('d-none');
            $('body').removeClass("typed-search-box-shown");
        }
    }
</script>