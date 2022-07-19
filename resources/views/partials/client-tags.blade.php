<script>
    $(function () {
        $("#addTags").select2({
            placeholder: "{{trans('clients.labels.newTag_ph')}}",
            tags: true,
            tokenSeparators: [',']
        });
    });
</script>
<script type="text/javascript">
    // Set up the Select2 control
    $('#tags').select2({
        multiple: 'multiple',
        theme: 'bootstrap-5',
        ajax: {
            url: '/manageTags',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }

                    })
                };
            },
            cache: true
        }
    });

    // Fetch the preselected item, and add to the control
    var tags = $('#tags');
    var clientId = <?php echo $client->id ?>;
    $.ajax({
        type: 'GET',
        url: '/selectedTags/' + clientId
    }).then(function (data) {
        let numberSelected = 0;
        for (let i = 0; i < data.length; i++) {
            var option = new Option(data[i].name, data[i].id, true, true);
            tags.append(option).trigger('change');
            numberSelected++;
        }
        // manually trigger the `select2:select` event
        tags.trigger({
            type: 'select2:select',
            params: {
                data: data
            }
        });
    });

</script>
