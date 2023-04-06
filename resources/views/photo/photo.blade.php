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
function addLike(item_id) {
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

</script>






<?php 
foreach($photos as $v){
	?>


<input type="hidden" id="like_counter_<?php echo $v['data']['id'];?>" value="<?php echo $v['likes_counter'];?>">

<input type="hidden" id="dis_like_counter_<?php echo $v['data']['id'];?>" value="<?php echo $v['dis_likes_counter'];?>">

<?php
//var_dump($v['dis_likes_counter']);
?>

<div class="too-block">
<div class="too-block__wrap">

<div class="too-block__photo_wrap">
<a href="/food/<?php echo $v['data']['id'];?> ">
  
<div class="too-block__photo fly_block" style="background-image: url('<?php echo $v['data']['big_photo'];?> ');background-color: #EEE">

</div>

</a>  
</div>




<div class="too-block__info">
<div class="too-block__info_title">

	<?php echo $v['data']['title'];?>


</div>
	

	<div class="too-block__info_body too-block__info_body___photo">
		<a href="/id<?php echo $v['owner_info'][0]['id'];?>"><i class="icon fly_block"  style="background-image: url('<?php echo $v['owner_info'][0]['small_photo'];?>');top:6px;margin-right:7px;background-color: #EEE;"></i><?php echo $v['owner_info'][0]['first_name'];?></a>
		<span class="divider">|</span>
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