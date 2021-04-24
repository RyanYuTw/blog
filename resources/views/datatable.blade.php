<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>

<script src="/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="/js/datatable.js?v={{ filemtime(public_path('js/datatable.js')) }}" type="text/javascript"></script>
<link rel="stylesheet"  href="/css/jquery.datatables.min.css">

<link href="/css/style.css" rel="stylesheet" type="text/css" />

<div class="datatable-container">
    <table name="tbl-contact" id="tbl-contact" class="display stripe row-border order-column" style="width:100%" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>姓氏</th>
                <th>名字</th>
                <th>地址</th>
                <th>電話</th>
                <th>生日</th>
            </tr>
        </thead>
    </table>
</div>
