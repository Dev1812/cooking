<?php
require SITE_ROOT.'/resources/views/tpl/head.tpl.php';
?>


<script type="text/javascript">



function udDeletePhotoBlock(item_id) {

$('#un-delete__layer_'+item_id).show();
$('#un-delete__body_'+item_id).show();
$.ajax({
	url: '/photo/delete_photo?item_id='+item_id,
	success: function(obj) {
		alert(obj);
	}
});
}


function restorePhoto(item_id) {
$('#un-delete__layer_'+item_id).hide();
$('#un-delete__body_'+item_id).hide();
$.ajax({
	url: '/photo/un_delete_photo?item_id='+item_id,
	success: function(obj) {
		alert(obj);
	}
});

}



function addLike(item_id) {

  var counter = $('#like-counter_'+item_id).val();
  alert(counter);
 var new_counter  = ++counter;
$('#add_like_counter_'+item_id).text(new_counter);
$('#remove_like_counter_'+item_id).text(new_counter);
$('#mark-block-add-like-'+item_id).hide();
$('#mark-block-remove-like-'+item_id).show();
   $('#like-counter_'+item_id).val(new_counter);
$.ajax({
	url: '/photo/ajax_add_like?item_id='+item_id,
	method:'get',
	success: function(obj){
alert(obj);
	} 
});



}
function removeLike(item_id) {
  var counter = $('#like-counter_'+item_id).val();
  alert(counter);
 var new_counter  = --counter;
 if (new_counter < 1) {
 	new_counter=0;
 }
$('#add_like_counter_'+item_id).text(new_counter);
$('#remove_like_counter_'+item_id).text(new_counter);
$('#mark-block-add-like-'+item_id).show();
$('#mark-block-remove-like-'+item_id).hide();
   $('#like-counter_'+item_id).val(new_counter);

$.ajax({
	url: '/photo/ajax_remove_like?item_id='+item_id,
	method:'get',
	success: function(obj){
alert(obj);
	} 
});

  
}
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

<div class="reg_content">


<?php
if(empty($photos)) {
echo '<div class="block-not-founded">Не найдено ни отдного фото</div>';
} else {
foreach($photos as $v) {
	?>

	<input type="hidden" id="like-counter_<?php echo $v['data']['id'];?>" value="<?php echo $v['likes_counter'];?>">
<div class="__abb-block">

<div class="__abb-wrap" style="position: relative;">
	

	<?php
	if(isUserAuth() && isOwner(session('user_id'), $v['data']['owner_id'])){
	 ?>
	
	<div style="width: 35px;
    height: 35px;
    background-color: #000;
    color: #FFF;
    position: absolute;
    top: 0;
    right: 0;
    z-index: 8;text-align: center;margin:9px" onClick="udDeletePhotoBlock('<?php echo $v['data']['id'];?>');"><i class="icon"  style="width:25px;height: 25px; background-image: url('/image/icon/close-custom.png');background-position: center;"></i></div>


	<?php
}
	 ?>

<div class="__abb-photo__wrap" style="position: relative;">
	<div class="__abb-photo fly-block" style="background-image: url('<?php echo $v['data']['big_photo'];?>');"></div>


	<?php
	if(isUserAuth()){
	 ?>
	
	<div style="background-color: #000;opacity:.7;z-index: 84;position: absolute;top: 0;left: 0;right: 0;bottom:0;display: none;" id="un-delete__layer_<?php echo $v['data']['id'];?>"></div>



	
	<div id="un-delete__body_<?php echo $v['data']['id'];?>" style="z-index: 94;
	position: absolute;top: 0;left: 0;right: 0;bottom:0;text-align: center;padding-top: 74px;display: none;"><div>
		<div style="color: #FFF;font-size:1.6em">Фото удалено</div>
		<div style="color: #FFF;margin-top:21px"><button style="color: #fff;
    background-color: transparent;
    border: 1px solid;
    padding: 7px 14px;
    border-radius: 7px;" onClick="restorePhoto(<?php echo $v['data']['id'];?>);">Восстановить</button></div>
	</div></div>
<?php

}
?>


	</div>

	<div class="__abb-info">
		<div class="__abb-title"><?php echo $v['data']['title'];?></div>
		<div class="__abb-body">
			<div class="__abb-body__info" style="text-align: left;">
				<a href="/id<?php echo $v['owner_info'][0]['id'];?>" class="__abb-body__owner_info">
                  <i class="icon fly-block user_small_bar user_small_photo" style="background-image: url(<?php echo $v['owner_info'][0]['small_photo'];?>);"></i>
                  <span><?php echo $v['owner_info'][0]['first_name'];?></span></a>
				<span>|</span>
				<span class="date_created"><?php echo $v['date_created'];?></span>
			</div>
<style type="text/css">

.mark-wrap{margin-top:14px}
.mark-title{
    position: relative;
    top: -3px;
    font-size: .9em;
    font-weight: bold;}
</style>
			<div class="mark-wrap">
				<style type="text/css">
				.mark-block{
    padding: 4px 7px 3px 6px;display: inline-block;background-color: #EEE;border-radius:7px;cursor: pointer;transition: background 0.04s ease}
				.mark-block:hover{background-color: #DDD}
				</style>
				<div class="mark-block" id="mark-block-add-like-<?php echo $v['data']['id'];?>"  style="<?php if(!$v['is_my_like']) echo ' display:none';?>"  onclick="addLike(<?php echo $v['data']['id'];?>);">
					<i class="icon icon-like" style="background-image: url('/image/icon/thumb-up-outline.png');width: 17px;height: 17px;"></i>
					<span id="add_like_counter_<?php echo $v['data']['id'];?>" class="mark-title"><?php echo $v['likes_counter'];?></span>
				</div>
				<div class="mark-block" id="mark-block-remove-like-<?php echo $v['data']['id'];?>" style="<?php if($v['is_my_like']) echo ' display:none';?>" onclick="removeLike(<?php echo $v['data']['id'];?>);">
					<i class="icon icon-like" style="background-image: url('/image/icon/thumb-up.png');width: 17px;height: 17px;"></i>
					<span id="remove_like_counter_<?php echo $v['data']['id'];?>" class="mark-title"><?php echo $v['likes_counter'];?></span>
				</div>
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















<?php
require SITE_ROOT.'/resources/views/tpl/footer.tpl.php';
?>


