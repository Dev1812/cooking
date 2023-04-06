n<?php
require SITE_ROOT.'/resources/views/tpl/head.tpl.php';
?>





<div class="reg_content">











<style type="text/css">
.reg_content{padding:34px 0}
</style>





<div class="form_block">

<div class="form_title">Настройки</div>

<div class="nav">
    <a href="/setting" class="nav-item">Инфо</a>
    <a href="/setting/change_photo" class="nav-item nav-item__active">Фото</a>
</div>

<div class="form_body">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>










<script type="text/javascript">


function selectPhoto(file) {
  var form_data = new FormData();
  form_data.append('file', file);
  $.ajax({
    url:'/photo/ajax_upload/?_token={{csrf_token()}}',
    data: form_data,
    method: 'post',
    processData: false,
    contentType: false,
    success: function(obj) {
        console.log(obj);
        obj = JSON.parse(obj);

        alert(obj);
        $('#photo-preview').css('background-image', 'url('+obj.big_photo_path+')');
        $('#big_photo_path').val(obj.big_photo_path);
    }

  });
}

function photoUpload() {
  $.ajax({
    method: 'get',
    url: '/setting/change_photo/?_token={{csrf_token()}}&big_photo='+$('#big_photo_path').val(),

    success: function(obj) {
console.log(obj);
    }
  });
}


</script>
<input type="hidden" name="" id="big_photo_path">





<style type="text/css">
    .upload_photo_content{padding:54px 0}
    input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    width: 100%;
}
</style>







<div class="__abb-block" style="width: 100%">
<div class="__abb-wrap">
    
<div class="__abb-photo__wrap">
    <div class="__abb-photo fly-block" id="photo-preview" style="background-image: url('<?php echo $user_info[0]['big_photo'];?>');"></div>
    </div>

</div>
    
</div>








<div style="margin:17px 0">
            <label class="custom-file-upload">
    <input type="file"/ onChange="selectPhoto(this.files[0]);">
    <i class="icon" style="width:17px;height: 17px; background-image: url('/image/icon/cloud-check-outline-24.png');"></i>
 Выбрать фото
</label>
</div>









<div class="form_section" style="margin-top: 9px">
    <div class="form_big_input_section__body">
        <div class="form_big_input_section__wrap"><input type="submit" name="" onClick="event.preventDefault();photoUpload()" placeholder="Ваше Имя" class="button" value="Сохранить"></div>
    </div>
</div>

</div>

</div>


















</div>













<?php
require SITE_ROOT.'/resources/views/tpl/footer.tpl.php';
?>


