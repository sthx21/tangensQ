<div wire:ignore>
<div class="width: 800px">


    <strong>Globale Suche: {{ $selectWorkshop }}</strong><br>

{{--    <div wire:ignore>--}}

        <select class="globalSearch js-states form-control" id="globalSearch" name="globalSearch" style="width: 400px" >



        </select>



</div>

<script type="text/javascript">

    $('.globalSearch').select2({
    // multiple: 'multiple',
        placeholder: 'Was wird gesucht?',
        fuzzySearch: true,
        theme: 'bootstrap-5',
        ajax: {
            url: '/globalSearch',
            dataType: 'json',
            delay: 250,
            fuzzySearch: {
                toggleSmart: true
            },
            processResults: function (data) {

    return {

        results: $.map(data, function (item) {

            if( item.title !== undefined){
                var res = item.title

            };
            if( item.last_name !== undefined){
                var res = item.last_name +' '+ item.first_name

            };
            if( item.name !== undefined){
                var res = item.name + ' PE: ' + item.hr_last_name

            };

            return {

                text:  res



                ,
                id: item.id,
                url:
                    item.baseUrl + item.slug,
            }
        })
    };


            },
            cache: true
        }

    });
    $("#globalSearch").on("select2:select", function (e) {
        window.location.assign(e.params.data.url);
    });
</script>

</div>
