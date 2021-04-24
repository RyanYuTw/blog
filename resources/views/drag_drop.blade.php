<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/drag_drop.js?v={{ filemtime(public_path('js/drag_drop.js')) }}"></script>
<style>
    .task-board {
        background: #2c7cbc;
        display: inline-block;
        padding: 12px;
        border-radius: 3px;
        width: 100%;
        white-space: nowrap;
        overflow-x: scroll;
        min-height: 300px;
    }

    .status-card {
        width: 250px;
        margin-right: 8px;
        background: #e2e4e6;
        border-radius: 3px;
        display: inline-block;
        vertical-align: top;
        font-size: 0.9em;
    }

    .status-card:last-child {
        margin-right: 0px;
    }

    .card-header {
        width: 100%;
        padding: 10px 10px 0px 10px;
        box-sizing: border-box;
        border-radius: 3px;
        display: block;
        font-weight: bold;
    }

    .card-header-text {
        display: block;
    }

    ul.sortable {
        padding-bottom: 10px;
    }

    ul.sortable li:last-child {
        margin-bottom: 0px;
    }

    ul {
        list-style: none;
        margin: 0;
        padding: 0px;
    }

    .text-row {
        padding: 15px 10px;
        margin: 10px;
        background: #fff;
        box-sizing: border-box;
        border-radius: 3px;
        border-bottom: 1px solid #ccc;
        cursor: pointer;
        font-size: 0.8em;
        white-space: normal;
        line-height: 20px;
    }

    .ui-sortable-placeholder {
        visibility: inherit !important;
        background: transparent;
        border: #666 2px dashed;
    }
</style>

<div class="task-board">
    @foreach ($statusResult as $statusRow)
        <div class="status-card">
            <div class="card-header">
                <span class="card-header-text">{{ $statusRow->status_name }}</span>
            </div>
            <ul class="sortable ui-sortable"
                id="sort{{ $statusRow->id }}"
                data-status-id={{ $statusRow->id }}>

                @if (count($taskResult) > 0)
                    @foreach ($taskResult as $key => $taskRows)
                        @if (count($taskRows) > 0 && $key == $statusRow->id)
                            @foreach ($taskRows as $taskRow)
                                <li class="text-row ui-sortable-handle" data-task-id={{ $taskRow["id"] }}>
                                    {{ $taskRow["title"] }}
                                </li>
                            @endforeach
                        @endif
                    @endforeach
                @endif

            </ul>
        </div>
    @endforeach

</div>
