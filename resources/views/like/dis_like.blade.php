<?php
require SITE_ROOT.'/resources/views/tpl/sidebar.tpl.php';
require SITE_ROOT.'/resources/views/tpl/head.tpl.php';
require SITE_ROOT.'/resources/views/tpl/common.tpl.php';
?>

<style type="text/css">
.owner_photo{display: inline-block;position: relative;width:24px;height: 24px;background-color: #EEE;position: relative;top:9px;margin-right:7px;border-radius:3px}

.content {
    margin-top: 48px;

    }
</style>
<div class="photo_content">


<div class="nav">
  <div>

    <a href="/like" class="nav-wrap__item">лайки</a>

    <a href="/like/dis_like" class="nav-wrap__item nav-wrap__item_active">дизлайки</a>

  </div>
</div>


<script type="text/javascript">
var Profile = {
addLike: function(item_id) {
  var counter = $('#add_block__counter_'+item_id).val();
  counter = parseInt(++counter);
  
  $('#add_like_block_'+item_id).hide();
  //$('#add_like_coounter_'+item_id).hide();
  $('#remove_like_block_'+item_id).show();


  $('#add_like_coounter_'+item_id).text(counter);
  $('#remove_like_coounter_'+item_id).text(counter);

  $('#add_block__counter_'+item_id).val(counter);

  $.ajax({
  	url: '/photo/ajax_add_dis_like?item_id='+item_id,
  	method: 'get',
  	success: function(obj) {
  		alert(obj);
  	}
  });
},
removeLike: function(item_id) {
  var counter = $('#add_block__counter_'+item_id).val();
  counter = parseInt(--counter);

  if(counter < 1) {
	counter=0;
  }

  $('#add_like_block_'+item_id).show();
  $('#remove_like_block_'+item_id).hide();

  $('#add_like_coounter_'+item_id).text(counter);
  $('#remove_like_coounter_'+item_id).text(counter);

  $('#add_block__counter_'+item_id).val(counter);

  $.ajax({
  	url: '/photo/ajax_remove_dis_like?item_id='+item_id,
  	method: 'get',
  	success: function(obj) {
  		alert(obj);
  	}
  });
}

}
</script>

<?php
if(empty($photos)) {
echo '<div class="block_not_found_empty">Ни найдено ни одного диз-лайка</div>';
} else {
  echo '<div style="padding:7px 0;font-weight:bold;">Диз-Лайки('.$likes_counter.')</div>';
foreach($photos as $v) {
?>

<input type="hidden" name="" id="add_block__counter_<?php echo $v['data'][0]['id'];?>" value="<?php echo $v['likes_counter'];?>">

<div class="too-block">
<div class="too-block__wrap">

<div class="too-block__photo_wrap">
<div class="too-block__photo fly_block" style="background-image: url('<?php echo $v['data'][0]['big_photo'];?>');background-color: #EEE">

</div>
</div>



<div class="too-block__info">
<div class="too-block__info_title">

  <?php echo $v['data'][0]['title'];?>

</div>
  

  <div class="too-block__info_body too-block__info_body___photo">
    <a href="/id21"><i class="icon fly_block" style="background-image: url('<?php echo $v['owner_info'][0]['small_photo'];?>');top:6px;margin-right:7px;background-color: #EEE;"></i><?php echo $v['owner_info'][0]['first_name'];?></a>
    <span class="divider">|</span>
    <span><?php echo $v['date_created'];?></span>
  </div>






  <div class="too-block__counters">



    <div id="add_like_block_<?php echo $v['data'][0]['id'];?>" class="counter-block" style=" display:none" onclick="Profile.addLike(<?php echo $v['data'][0]['id'];?>);">
      <i class="icon icon__like icon__dis_like_on"></i>
      <span class="counter-block__counter_text" id="add_like_coounter_<?php echo $v['data'][0]['id'];?>"><?php echo $v['likes_counter'];?></span>
    </div>





    <div id="remove_like_block_<?php echo $v['data'][0]['id'];?>" class="counter-block" style="" onclick="Profile.removeLike(<?php echo $v['data'][0]['id'];?>);">
      <i class="icon icon__like icon__dis_like_off"></i>
      <span class="counter-block__counter_text" id="remove_like_coounter_<?php echo $v['data'][0]['id'];?>"><?php echo $v['likes_counter'];?></span>
    </div>






  </div>





</div>



</div>
  
</div>

<?php
}
}
?>



</div>

</div>



<?php
require SITE_ROOT.'/resources/views/tpl/footer.tpl.php';


?>

