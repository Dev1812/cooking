<?php
require SITE_ROOT.'/resources/views/tpl/sidebar.tpl.php';
require SITE_ROOT.'/resources/views/tpl/head.tpl.php';
require SITE_ROOT.'/resources/views/tpl/common.tpl.php';
?>













  

<div class="setting_content">




<style type="text/css">
.setting_content{padding:74px 0;}
</style>








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
        $('#pretty_block__photo').css('background-image', 'url('+obj.big_photo_path+')');
        $('#big_photo_path').val(obj.big_photo_path);
    }

  });
}

function photoUpload() {
  $.ajax({
    method: 'get',
    url: '/setting/change_photo/?_token={{csrf_token()}}&big_photo='+$('#big_photo_path').val()+'&small_photo='+$('#big_photo_path').val(),

    success: function(obj) {
console.log(obj);
    }
  });
}


</script>
<input type="hidden" name="" id="big_photo_path">




<div class="form_block">

<div class="form_title">Настройки</div>

<div class="form_body">
  <FORM action="" method="POST">
    @csrf
    <?php
var_dump(session('user_id'));
    ?>
<div class="nav" style="margin:14px 0 1px">
  <a href="/setting" class="nav-wrap__item">Инфо</a>
  <a href="/setting/change_photo" class="nav-wrap__item nav-wrap__item_active">Фото</a>
</div>










<div class="too-block__info">
<div class="too-block__photo_wrap">
<div class="too-block__photo fly_block" id="pretty_block__photo" style="background-color:#EEE;background-image: url('<?php echo session('user_big_photo');?>');">

</div>
</div>

  


<div class="form_section" style="margin-top: 14px">
  <div class="form_big_input_section__body">
    <div class="form_big_input_section__wrap"><input type="file" name="" placeholder="Ваше Имя" class="input_file" onchange="selectPhoto(this.files[0]);" value="Сохранить" style="width: 100%"></div>
  </div>
</div>



<div class="form_section" style="margin-top: 14px">
  <div class="form_big_input_section__body">
    <div class="form_big_input_section__wrap"><input type="submit" name="" placeholder="Ваше Имя" onClick="event.preventDefault();photoUpload()" class="button" value="Сохранить" style="width: 100%"></div>
  </div>
</div>
  </div>


</FORM>
</div>

</div>


















</div>










<?php
require SITE_ROOT.'/resources/views/tpl/footer.tpl.php';


?>

