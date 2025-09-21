<script>
    getData({'searchArray' : searchArray()})

    function searchArray() {
        var searchArray = {};
        $('.search-input').each(function (key, input) {
            if ($(this).val() !== '' && $(this).val() !== null ) { // Only include non-empty values
                searchArray[$(this).attr('name')] = $(this).val();
            }
        });
        return searchArray;
    }


    $(document).on('change', '.search-input', function (e) {
        e.preventDefault();
        getData({'searchArray' : searchArray()} )
    });

    $(document).on('keyup', '.search-input', function (e) {
        e.preventDefault();
        getData({'searchArray' : searchArray()} )
    });

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        getData({page : $(this).attr('href').split('page=')[1]  , 'searchArray' : searchArray() } )
    });

    // $('.table_loader').fadeOut('slow');


    function getData(array) {
    $.ajax({
            type: "get",
            url: "{{$index_route}}",
            data: array,
            dataType: "json",
            cache: false,
            beforeSend: function () {
                // Optional: Show a loader here
            },
            success: function (response) {
                $('.table_content_append').html(response.html);
                let search = '?';
                Object.entries(array.searchArray).forEach((item, index) => {
                    // Only add non-empty search parameters to the URL
                    if (item[1] !== '' && item[1] !== null) {
                        search += index === 0 ? `${item[0]}=${item[1]}` : `&${item[0]}=${item[1]}`;
                    }
                });
                window.history.pushState('', '', search);
            }
        });
    }


    $('.clean-input').on('click' ,function(){
        $(this).siblings('input').val(null);
        $(this).siblings('select').val(null);
        getData({'searchArray' : searchArray()} )
    });
</script>