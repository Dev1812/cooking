<?php
require SITE_ROOT.'/resources/views/tpl/sidebar.tpl.php';
require SITE_ROOT.'/resources/views/tpl/head.tpl.php';
require SITE_ROOT.'/resources/views/tpl/common.tpl.php';
?>

<div class="photo_content">
<style type="text/css">
  
  
    @media (max-width: 1199.98px) {
.photo_content{width: 100%!important;padding:0 14px}
.too-block{width: 100%!important}
    }

</style>



<script type="text/javascript">
  
function unFollow(profile_id) {
  $('#follow_action').show();
  $('#un_follow_action').hide();

  //'/photo/ajax_un_follow'
  $.ajax({
    url: '/photo/ajax_un_follow?item_id='+profile_id,
    method: 'get',
    success: function(obj) {
      alert(obj);
    }
  });
}

function  follow(profile_id) {
  //un_follow_action
  $('#follow_action').hide();
  $('#un_follow_action').show();
  $.ajax({
    url: '/photo/ajax_follow?item_id='+profile_id,
    method: 'get',
    success: function(obj) {
      alert(obj);
    }
  });
}

</script>

<div style="text-align: center;">





<div class="too-block" style="margin: 0 auto ;width:78%">
<div class="too-block__wrap">

<div class="too-block__photo_wrap">
<div class="too-block__photo fly_block" style="background-image: url('<?php echo $owner_info[0]['big_photo'];?>');margin:auto; background-color: #EEE;width:40%">

</div>
</div>



<div class="too-block__info">
<div class="too-block__info_title">

 <?php echo $owner_info[0]['first_name'];?>


</div>
  

  <div class="too-block__info_body too-block__info_body___photo">
    <span><?php echo $owner_info[0]['bio'];?>
    </span>
  </div>
</div>



<?php

if(isUserAuth()) {

?>


      <button<?php if($is_i_follow) echo ' style="display:none"';?>  id="follow_action" onClick="follow(<?php echo $profile_id;?>);" class="button button_solid">Подписаться</button>

      <button<?php if(!$is_i_follow) echo ' style="display:none"';?> class="button button_solid button_gray" id="un_follow_action"  onClick="unFollow(<?php echo $profile_id;?>);">Отписаться</button>
<?php
}
?>





</div>  





</div>
  
</div>















<div style="clear: both;"></div>










<div class="nav">
  <div class="nav-wrap">
    <a href="" class="nav-wrap__item nav-wrap__item_active">Фото</a>
  </div>
</div>

  


<script type="text/javascript">
  window.__glob = {};
  __glob.is_user_auth = <?php if(isUserAuth()){echo 'true';}else{echo 'false';};?>;

function addLike(item_id) {
  if(!__glob.is_user_auth){
    console.log('addLike: User is not Auth()');
return false;
  } 
  var chtr = $('#like_counter_'+item_id).val();

  console.log(chtr);

  chtr = ++chtr;

$('#add_like_coounter_'+item_id).text(chtr);

$('#remove_like_coounter_'+item_id).text(chtr);


$('#add_like_block_'+item_id).hide();
$('#remove_like_block_'+item_id).show();
$('#like_counter_'+item_id).val(chtr);
$.ajax({
  url: '/photo/ajax_add_like?item_id='+item_id,
  method:  'get',
  success: function(obj) {
    alert(obj);
  }
});
}
function removeLike(item_id) {

  var chtr = $('#like_counter_'+item_id).val();

  console.log(chtr);

  chtr = --chtr;
  if(chtr < 1) {
    chtr = 0;
  }

$('#add_like_coounter_'+item_id).text(chtr);

$('#remove_like_coounter_'+item_id).text(chtr);


$('#add_like_block_'+item_id).show();
$('#remove_like_block_'+item_id).hide();
$('#like_counter_'+item_id).val(chtr);

$.ajax({
  url: '/photo/ajax_remove_like?item_id='+item_id,
  method:  'get',
  success: function(obj) {
    alert(obj);
  }
});

}






function addDisLike(item_id) {
  var chtr = $('#dis_like_counter_'+item_id).val();

  console.log(chtr);

  chtr = ++chtr;

$('#add_dis_like_coounter_'+item_id).text(chtr);

$('#remove_dis_like_coounter_'+item_id).text(chtr);


$('#add_dis_like_block_'+item_id).hide();
$('#remove_dis_like_block_'+item_id).show();

$('#dis_like_counter_'+item_id).val(chtr);




$.ajax({
  url: '/photo/ajax_add_dis_like?item_id='+item_id,
  method:  'get',
  success: function(obj) {
    alert(obj);
  }
});



}

function removeDisLike(item_id) {
  var chtr = $('#dis_like_counter_'+item_id).val();

  console.log(chtr);

  chtr = --chtr;

  if(chtr < 1) {
    cntr=0;
  }

$('#add_dis_like_coounter_'+item_id).text(chtr);

$('#remove_dis_like_coounter_'+item_id).text(chtr);


$('#add_dis_like_block_'+item_id).show();
$('#remove_dis_like_block_'+item_id).hide();


$('#dis_like_counter_'+item_id).val(chtr);

$.ajax({
  url: '/photo/ajax_remove_dis_like?item_id='+item_id,
  method:  'get',
  success: function(obj) {
    alert(obj);
  }
});

}


function deletePhoto(item_id) {
alert(item_id);
$.ajax({
  url: '/photo/delete/?item_id='+item_id,
  method: 'get',
  success: function(obj) {
    alert(obj);
    $('#q_'+item_id).show();
    $('#too-block__menu_'+item_id).hide();
  }
});
}
function unDeletePhoto(item_id) {
alert(item_id);
$.ajax({
  url: '/photo/un_delete/?item_id='+item_id,
  method: 'get',
  success: function(obj) {
    alert(obj);
    $('#q_'+item_id).hide();
    $('#too-block__menu_'+item_id).show();
  }
});
}
</script>


<style type="text/css">
.too-block__menu_item{padding:5px 9px;border-radius:9px}
.too-block__menu_item:hover{background-color: #EEE;cursor: pointer;}
</style>



<?php 
foreach($photos as $v){
  ?>


<input type="hidden" id="like_counter_<?php echo $v['data']['id'];?>" value="<?php echo $v['likes_counter'];?>">

<input type="hidden" id="dis_like_counter_<?php echo $v['data']['id'];?>" value="<?php echo $v['dis_likes_counter'];?>">

<?php
//var_dump($v['dis_likes_counter']);
?>

<div class="too-block" style="position: relative;">
<div class="too-block__wrap">

<?php

if(isUserAuth()) {

?>
<div style="position: absolute;top:0;right: 0;background-color:  #000;color: #FFF;padding: 5px 9px 5px 9px;margin:4px;border-radius:5px;z-index: 9" onClick="$('#too-block__menu_<?php echo $v['data']['id'];?>').show();">x</div>

<?php
}
?>





<div class="too-block__photo_wrap" style="position: relative;">


<?php

if(isUserAuth()) {

?>
<div onClick="$('#too-block__menu_<?php echo $v['data']['id'];?>').hide();" style="position: absolute;top:0;left: 0;right: 0;bottom: 0;background-color:#000;opacity: .4;z-index: 4">
</div>

<div style="position: absolute;z-index: 94;width: 100%" id="too">
  
  <div style="width:75%;background-color: #FFF;margin:55px auto;border-radius:9px;box-shadow: 0 0 9px #808080 ;display: none;" class="too-block__menu" id="too-block__menu_<?php echo $v['data']['id'];?>">
<div class="too-block__menu_item" onClick="deletePhoto(<?php echo $v['data']['id'];?>);">Удалить</div>
<div class="too-block__menu_item">Жалоба</div>
<div class="too-block__menu_item" style="border-top: 2px solid #EEE">Отмена</div>
  </div>
</div>

<?php
}
?>



<div style="display: none;" id="q_<?php echo $v['data']['id'];?>">
<div style="position: absolute;top:0;left: 0;right: 0;bottom: 0;background-color:#000;opacity: .4;z-index: 4">
</div>


<div style="position: absolute;top:0;left: 0;right: 0;bottom: 0;z-index: 95;text-align: center;display: bn">
  <div style="color: #FFF;margin-top:97px  ">
<div>
  <div style="font-size:1.7em;margin-bottom:17px">Фото удалено</div>
  <div  onClick="unDeletePhoto(<?php echo $v['data']['id'];?>);$('#q_<?php echo $v['data']['id'];?>').hide();" style="border:1px solid #FFF;display: inline-block;padding: 3px 9px 3px 9px;border-radius:4px">Восстановить</div>
</div>
  </div>
</div></div>


<div class="too-block__photo fly_block" style="background-image: url('<?php echo $v['owner_info'][0]['big_photo'];?>');background-color: #EEE;">

</div>
</div>



<div class="too-block__info">
<div class="too-block__info_title">

  <?php echo $v['data']['title'];?>


</div>
  

  <div class="too-block__info_body too-block__info_body___photo">
    <span><?php echo $v['date_created'];?></span>
  </div>







  <div class="too-block__counters">



    <div id="add_like_block_<?php echo $v['data']['id'];?>" class="counter-block" style="<?php if(!$v['is_my_like']) echo ' display:none';?>"  onClick="addLike(<?php echo $v['data']['id'];?>);">
      <i class="icon icon__like icon__like_on"></i>
      <span class="counter-block__counter_text" id="add_like_coounter_<?php echo $v['data']['id'];?>"><?php echo $v['likes_counter'];?></span>
    </div>





    <div id="remove_like_block_<?php echo $v['data']['id'];?>" class="counter-block"   style="<?php if($v['is_my_like']) echo ' display:none';?>"   onClick="removeLike(<?php echo $v['data']['id'];?>);">
      <i class="icon icon__like icon__like_off"></i>
      <span class="counter-block__counter_text" id="remove_like_coounter_<?php echo $v['data']['id'];?>"><?php echo $v['likes_counter'];?></span>
    </div>




    <div id="add_dis_like_block_<?php echo $v['data']['id'];?>"  class="counter-block"<?php if(!$v['is_my_dis_like']){echo ' style="display:none"';};?> onClick="addDisLike(<?php echo $v['data']['id'];?>);">
      <i class="icon icon__like icon__dis_like_on"></i>
      <span class="counter-block__counter_text" id="add_dis_like_coounter_<?php echo $v['data']['id'];?>"><?php echo $v['dis_likes_counter'];?></span>
    </div>





    <div id="remove_dis_like_block_<?php echo $v['data']['id'];?>"  class="counter-block"<?php if($v['is_my_dis_like']){echo ' style="display:none;"';};?> onClick="removeDisLike(<?php echo $v['data']['id'];?>);">
      <i class="icon icon__like icon__dis_like_off"></i>
      <span class="counter-block__counter_text" id="remove_dis_like_coounter_<?php echo $v['data']['id'];?>"><?php echo $v['dis_likes_counter'];?></span>
    </div>





  </div>



</div>



</div>
  
</div>
  <?php
}
?>



</div>