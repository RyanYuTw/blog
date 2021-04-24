
$(document).ready(function(){
    var size;
    $('#cropbox').Jcrop({
      aspectRatio: 1,
      onSelect: function(c){
       size = {x:c.x,y:c.y,w:c.w,h:c.h};
       $("#crop").css("visibility", "visible");
      }
    });

    $("#crop").click(function(){
        var img = $("#cropbox").attr('src');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            url:"/admin/examples/image_crop",
            type:"PUT",
            dataType:"json",
            data: {
                "x"  : size.x,
                "y"  : size.y,
                "w"  : size.w,
                "h"  : size.h,
                "img": img
            },
            success:function(obj){
                $("#cropped_img").show();
                $("#cropped_img").attr('src', obj.target);
            }
        });
    });
});
