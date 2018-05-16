<script src="jquery-1.7.2.min.js"></script>
<center>
    <h2>商品列表</h2>
    <button id="insert">插入数据</button>
    <a href="rizhi">查看日志</a>
    {{Session::get('user')}}
    <table border=1 >
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <tr>
            <th><input type="checkbox" name="" id=""></th>
            <th>班级名称</th>
            <th>所属学院</th>
            <th>操作</th>
        </tr>
        @foreach($classInfos as  $classInfo)
        <tr>
            <td><input type="checkbox" name="box" value="{{ $classInfo->class_info_id}}"></td>
            <td  pid="{{ $classInfo->class_info_id}}"><span class="update">{{ $classInfo->goods_name}}</span></td>
            <td pid="{{ $classInfo->class_info_id}}"><span class="price">{{ $classInfo->goods_price}}</span></td>
            <td><a href="del?id={{ $classInfo->id}}">删除</a></td>
        </tr>
        @endforeach
    </table>
    <button class="pl">批量删除</button>
</center>
<script>
    $(function(){
        $("#insert").click(function(){
            location.href="insert";
        })
        //批量删除
        $(".pl").click(function(){
            var  box = $("input[name='box']");
            length =box.length;
            //alert(length);
            var str ="";
            for(var i=0;i<length;i++){
                if(box[i].checked==true){
                    str =str+","+box[i].value;
                }

            }
            str= str.substr(1)
            //alert(str)

            location.href="del?id="+str;
        })
        //即点击该
        $(document).on("click", ".update", function () {
            var con = $(this).html();
            var pid = $(this).parent().attr('pid');
            //alert(pid)
            $(this).parent().html('<input type="text" value="'+con +'" class="input" pid="'+pid+'" />');
            $("input").focus();
            $(document).on("blur", ".input", function () {
                var goods_name = $(this).val();
                pid = $(this).attr("pid");
                //alert(pid)
                $(this).parent().html('<span class="update">'+goods_name +'</span>');
                $.post("update",{goods_name:goods_name,pid:pid},function(msg){
                    //alert(msg)
                    location.href="login_do";
                })
            });
        });

</script>