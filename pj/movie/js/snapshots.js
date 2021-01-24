//snapshots.js
$(document).ready(function(){
    //배열 패턴 = ["이미지", "타이틀"]
    var $sh_arr = [
        ["cont_01.jpg", "snapshot_01"],
        ["cont_02.jpg", "snapshot_02"],
        ["cont_03.jpg", "snapshot_03"],
        ["cont_04.jpg", "snapshot_04"],
        ["cont_05.jpg", "snapshot_05"],
        ["cont_06.jpg", "snapshot_06"]
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
        $(".origin .row").append($sh_box);
    }

    $(".origin .row > div").each(function(index){
        $(this).find(".sh_box").css("background-image", "url(img/"+$sh_arr[index][0]+")");
        $(this).find("h4").text($sh_arr[index][1]);
    });


    //하단의 "+더보기" 클릭시, snapshots_add.html을 호출하여 가져온다. + 버튼 사라지기

    $(".snapshots button").click(function(){
        $.ajax({
            url : "snapshots_add.html",
            type : "post",
            success : function(result){
                $(".add").html(result);
            }
        });
        $(this).hide();
    });

    
});