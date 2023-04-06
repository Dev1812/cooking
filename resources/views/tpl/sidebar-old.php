<?php
if(!isUserAuth()) { 
  ?>

<div class="sidebar-desktop">
  <div class="sidebar__photo_wrap">
    <div class="sidebar__photo" style="background-image: url('<?php echo session('user_small_photo');?>');background-color: #EEE"></div>
  </div>
  <div>

    <style type="text/css">
    .icon-sidebar__item{width: 
  21px;height:21px;top:0px  ;margin-right:5px}
  .sidebar__item_title{position: relative;top:-5px}
    </style>
  
    
  <a href="/id<?php echo session('user_id');?>"><div class="sidebar__item sidebar__name"><i class="icon icon-sidebar__item" style="background-image: url('/image/icon/temp/information-outline-custom.png');"></i>
   <span class="sidebar__item_title" style="font-weight:bold;"> <?php echo session('user_first_name');?></span></div></a>
  <a href="/photo"><div class="sidebar__item"><i class="icon icon-sidebar__item" style="background-image: url('/image/icon/temp/image-custom.png');"></i><span class="sidebar__item_title">Фото</span></div></a>
  <a href="/search"><div class="sidebar__item"><i class="icon icon-sidebar__item" style="background-image: url('/image/icon/temp/account-multiple-custom.png');"></i><span class="sidebar__item_title">Люди</span></div></a>

  <a href="/like"><div class="sidebar__item"><i class="icon icon-sidebar__item" style="background-image: url('/image/icon/temp/thumb-up-outline-custom.png');"></i><span class="sidebar__item_title">Лайки</span></div></a>
  <a href="/setting"><div class="sidebar__item"><i class="icon icon-sidebar__item" style="background-image: url('/image/icon/temp/cog-outline-custom.png');"></i><span class="sidebar__item_title">Настройки</span></div></a>
  <a href="/logout"><div class="sidebar__item"><i class="icon icon-sidebar__item" style="background-image: url('/image/icon/temp/exit-to-app-custom.png');"></i><span class="sidebar__item_title">ВЫход</span></div></a>
  </div>
</div>
<?php
}
?>