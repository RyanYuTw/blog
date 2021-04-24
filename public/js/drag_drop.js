
    $( function() {
        var url = "/admin/examples/drag_drop"
        $('ul[id^="sort"]').sortable({
            connectWith: ".sortable",
            receive: function (e, ui) {
                var status_id = $(ui.item).parent(".sortable").data("status-id");
                var task_id = $(ui.item).data("task-id");
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: {"status_id": status_id, "task_id": task_id},
                    success: function(response){
                        toastr.success(response.message);
                    }
                });
            }
        }).disableSelection();
    });
