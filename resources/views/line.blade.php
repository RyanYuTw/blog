<div class="box">
    <div class="box-header">
        <h3 class="box-title"></h3>
    </div>
    <div class="box-body table-responsive no-padding" style="border-top: 1px solid #f4f4f4;">
        <div id="line_type" style="min-width: 250px; height: 400px; margin: 0 auto; padding: 10px;"></div>
    </div>
    <div class="box-footer clearfix"></div>
</div>


<script>
    $( document ).ready(function() {

        var chartData = null;
        var chartURL = "/admin/examples/charts/line";

        loadStatiData();

        function loadStatiData()
        {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method : "GET",
                url: chartURL
            })
            .done(function(obj){
                //toastr.success('查詢成功');
                chartData = obj;
                renderDiagram();
            })
            .fail(function(obj)
            {
                //toastr.warning('查詢失敗');
            });
        }

        function renderDiagram()
        {
            var option = {
                chart: {
                    type: 'line'
                },
                title: {
                    text: chartData.title
                },
                yAxis: {
                    title: {
                        text: chartData.sidetitle
                    }
                },
                tooltip: {
                    useHTML: true,
                    pointFormatter: function () {
                        var point = this,
                            series = point.series,
                            legendSymbol = "<svg width='15' height='15'>" + series.legendSymbol.element.outerHTML + "</svg>";

                        return legendSymbol + " " + series.name + ": <b>" + point.y + "</b><br/>";
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                xAxis: {
                    categories: chartData.dataColumn,
                    title: {
                        text: chartData.bottomtitle
                    }
                },
                series: chartData.dataSeries,

            };

            $('#line_type').html('');
            Highcharts.chart('line_type', option);
        }
    });
</script>
