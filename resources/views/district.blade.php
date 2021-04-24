<div class="row">
    <div class="col-md-6">
        <div class="input-group">
            <div class="col-md-6">縣市</div>
            <div class="dropdown col-md-6">
                <select class="selectpicker" aria-label="City select example" id="city" style="width:150px;">
                    <option selected>選擇縣市</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="input-group">
            <div class="col-md-6">區域</div>
            <div class="dropdown col-md-6">
                <select class="selectpicker" aria-label="Area select example" id="area" style="width:150px;">
                    <option selected>選擇區域</option>
                </select>
            </div>
        </div>
    </div>
</div>

<script src="/js/city_area_selector.js?v={{ filemtime(public_path('js/city_area_selector.js')) }}"></script>
