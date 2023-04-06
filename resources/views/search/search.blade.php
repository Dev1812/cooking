<?php
require SITE_ROOT.'/resources/views/tpl/sidebar.tpl.php';
require SITE_ROOT.'/resources/views/tpl/head.tpl.php';
require SITE_ROOT.'/resources/views/tpl/common.tpl.php';
?>



<style type="text/css">
  
    @media (max-width: 1199.98px) {
.photo_content{width: 100%!important;padding:0 14px}
.too-block{width: 100%!important}
    }
</style>
<script type="text/javascript">
  
function unFollow(profile_id) {
  $('#follow_action_'+profile_id).show();
  $('#un_follow_action_'+profile_id).hide();


  //'/photo/ajax_un_follow'
  $.ajax({
    url: '/photo/ajax_un_follow?item_id='+profile_id,
    method: 'get',
    success: function(obj) {
      alert(obj);
    }
  });
}

function follow(profile_id) {
  //un_follow_action
  $('#follow_action_'+profile_id).hide();
  $('#un_follow_action_'+profile_id).show();

  $.ajax({
    url: '/photo/ajax_follow?item_id='+profile_id,
    method: 'get',
    success: function(obj) {
      alert(obj);
    }
  });
}

</script>


<div class="photo_content">



<?php
foreach($result as $v) {
?>



<div class="too-block">
<div class="too-block__wrap">

<a href="/id<?php echo $v['id'];?>" target="_blank">
<div class="too-block__photo_wrap">
<div class="too-block__photo fly_block" style="background-image: url('<?php echo $v['big_photo'];?>');background-color:#EEE;">

</div>
</div>

</a>

<div class="too-block__info" style="padding:9px 0">
<div class="too-block__info_title">
<?php echo $v['first_name'];?> 
</div>
<div style="margin:14px 0"> 
	@<?php echo $v['login'];?> 

</div>
<div>
      <button<?php if($v['is_i_follow']) echo ' style="display:none"';?>  id="follow_action_<?php echo $v['id'];?>" onClick="follow(<?php echo $v['id'];?>);" class="button button_solid">Подписаться</button>

      <button<?php if(!$v['is_i_follow']) echo ' style="display:none"';?> class="button button_solid button_gray"  id="un_follow_action_<?php echo $v['id'];?>" onClick="unFollow(<?php echo $v['id'];?>);">Отписаться</button>

</div>

</div>



</div>
	
</div>
<?php
}
?>



</div>

</div>



<?php
require SITE_ROOT.'/resources/views/tpl/footer.tpl.php';


?>

