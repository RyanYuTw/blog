$(function(){
    String.prototype.format = function() {
        var args = arguments;
        return this.replace(/{(\d+)}/g, function(match, number) {
            return typeof (args[number] != 'undefined') ? args[number] : match;
        });
    };

    // 載入時取得縣市資料
    $(window).on("load", function () {
        $.ajax({
            url:"/admin/examples/district/city",
            type:"GET",
            dataType:"json",
            success:function(data){
                //抓縣市資料加到 html 中
                var tmpCityContent = $('<div></div>'); //儲存版型用
                $.each(data, function() {
                    var cityLi = $(('<option value="{0}">{1}</option>').format(this.city_id, this.city)).data('data' , this); //縣市用 option {0}, 將縣市的區,路段資料藏到 option 中
                    tmpCityContent.append(cityLi); //將版型加入 儲存版型用中
                });
                $('#city').empty();
                $('#city').append(tmpCityContent.contents()); //將版型加入到 html 的 cityBox 中
            }
        })
    });

    //選擇縣市事件
    $('#city')
        .on('change', function(){
            var cityValue = this.value;
            $.ajax({
                url:"/admin/examples/district/area",
                type:"GET",
                data: {"city_id": cityValue},
                dataType:"json",
                success:function(data){
                    $('#city:input[value="'+cityValue+'"]').add("selected");
                    //抓區域資料加到 html 中
                    var tmpAreaContent = $('<div></div>'); //儲存版型用
                    $.each(data, function() {
                        var areaLi = $(('<option value="{0}">{1}</option>').format(this.id, this.area)).data('data' , this); //區域用 option {0}, 將區域資料藏到 option 中
                        tmpAreaContent.append(areaLi); //將版型加入 儲存版型用中
                    });
                    $('#area').empty();
                    $('#area').append(tmpAreaContent.contents()); //將版型加入到 html 的 cityBox 中
                }
            })
        });
});
