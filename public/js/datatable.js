$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('#tbl-contact').DataTable({
        "lengthChange"  : false,
        "searching"     : true,
        "autoWidth"     : true,
        "info"          : true,
        "paging"        : true,
        "pageLength"    : 20,
        "scrollX"       : true,
        "scrollCollapse": true,
        "processing"    : true,
        "serverSide"    : true,
        "ajax"          : {
            "type" : "POST",
            "url": "/admin/examples/data_table"
        },
        "columnDefs": [
            { targets: [3, 4],
              className: 'text-center'
            },
            { targets: [0, 1, 2],
              className: 'text-left'
            },
            { targets: '_all',
              className: 'dt-head-center'
            }
        ],
        "columns": [
            { data: 'last_name' , render: function (data, type, row) {
                return setHitTextBackColor(data);
            }},
            { data: 'first_name' , render: function (data, type, row) {
                return setHitTextBackColor(data);
            }},
            { data: 'address' , render: function (data, type, row) {
                return setHitTextBackColor(data);
            }},
            { data: 'phone' , render: function (data, type, row) {
                return setHitTextBackColor(data);
            }},
            { data: 'date_of_birth' , render: function (data, type, row) {
                return setHitTextBackColor(parseInt(data).toString());
            }}
        ],
        "language": {
            "decimal"       : "",
            "emptyTable"    : "查無資料顯示",
            "info"          : "顯示 _START_ 到 _END_ 筆 / 共 _TOTAL_ 筆",
            "infoEmpty"     : "顯示 0 到 0 筆 / 共 0 筆",
            "infoFiltered"  : "(從 _MAX_ 總筆數中過濾)",
            "infoPostFix"   : "",
            "thousands"     : ",",
            "lengthMenu"    : "顯示 _MENU_ 筆",
            "loadingRecords": "載入中...",
            "processing"    : "處理中...",
            "search"        : "搜尋:",
            "zeroRecords"   : "查無符合資料",
            "paginate"      : {
                "first"   : "第一頁",
                "last"    : "最末頁",
                "next"    : "下一頁",
                "previous": "前一頁"
            },
            "aria": {
                "sortAscending" : ": 遞增排序",
                "sortDescending": ": 遞減排序"
            }
        },
        "dom": '<"toolbar">Bfrtip'
    });

    function setHitTextBackColor(txt)
    {
        var searchTxt = $('.dataTables_filter input').val();
        var reg = new RegExp('(' +searchTxt + ')', 'ig');
        return (txt) ? txt.replace(reg, "<span style='background-color:yellow;'>$1</span>") : null;
    }

});
