$(document).ready(function(){
        //배열 패턴 = ["이미지", "타이틀"]
        var $sh_arr = [
            ["cont_07.jpg", "snapshot_07"],
            ["cont_08.jpg", "snapshot_08"],
            ["cont_09.jpg", "snapshot_09"],
            ["cont_10.jpg", "snapshot_10"],
            ["cont_11.jpg", "snapshot_11"],
            ["cont_12.jpg", "snapshot_12"],
            ["cont_13.jpg", "snapshot_13"],
            ["cont_14.jpg", "snapshot_14"],
        ];
    
        var $sh_box = `
        <div class="col-lg-6 pad_h_10">
            <div class="sh_box">
                <div class="dark">
                    <h4>snapshot_01</h4>
                </div>
            </div>
        </div>
        `;
    
        for(i=0; i<$sh_arr.length; i++){
            $(".row.add_box").append($sh_box);
        }
    
        $(".row.add_box > div").each(function(index){
            $(this).find(".sh_box").css("background-image", "url(img/"+$sh_arr[index][0]+")");
            $(this).find("h4").text($sh_arr[index][1]);
        });
    
});