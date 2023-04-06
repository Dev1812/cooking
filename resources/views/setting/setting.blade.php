<?php
require SITE_ROOT.'/resources/views/tpl/sidebar.tpl.php';
require SITE_ROOT.'/resources/views/tpl/head.tpl.php';
require SITE_ROOT.'/resources/views/tpl/common.tpl.php';
?>













  

<div class="setting_content">




<style type="text/css">
.setting_content{padding:74px 0;}
</style>






<div class="form_block">

<div class="form_title">Настройки</div>

<div class="form_body">
	<FORM action="" method="POST">
		@csrf
		<?php
var_dump(session('user_id'));
		?>
<div class="nav" style="margin:14px 0 1px">
	<a href="/setting" class="nav-wrap__item nav-wrap__item_active">Инфо</a>
	<a href="/setting/change_photo" class="nav-wrap__item">Фото</a>
</div>

<div class="form_section">
	<div class="form_big_input_section__title"><span class="form_big_input_section__title_label">Имя:</span></div>

	<div class="form_big_input_section__body">
		<div class="form_big_input_section__wrap"><input type="text" name="setting_first_name" placeholder="Ваше имя" class="form_big_input_section__text_field" value="<?php echo $user_info[0]['first_name'];?>"></div>
	</div>
</div>


<div class="form_section">
	<div class="form_big_input_section__title"><span class="form_big_input_section__title_label">Фамилия:</span></div>

	<div class="form_big_input_section__body">
		<div class="form_big_input_section__wrap"><input type="text" name="setting_last_name" placeholder="Ваша фамилия" class="form_big_input_section__text_field" value="<?php echo $user_info[0]['last_name'];?>"></div>
	</div>
</div>


<div class="form_section">
	<div class="form_big_input_section__title"><span class="form_big_input_section__title_label">Логин:</span></div>

	<div class="form_big_input_section__body">
		<div class="form_big_input_section__wrap"><input type="text" name="setting_login" placeholder="Ваш логин" class="form_big_input_section__text_field" value="<?php echo $user_info[0]['login'];?>"></div>
	</div>
</div>


<div class="form_section">
	<div class="form_big_input_section__title"><span class="form_big_input_section__title_label">Email:</span></div>

	<div class="form_big_input_section__body">
		<div class="form_big_input_section__wrap"><input type="text" name="setting_email" placeholder="Ваш email" class="form_big_input_section__text_field" value="<?php echo $user_info[0]['email'];?>"></div>
	</div>
</div>

<div class="form_section">
	<div class="form_big_input_section__title"><span class="form_big_input_section__title_label">Биография:</span></div>

	<div class="form_big_input_section__body">
		<div class="form_big_input_section__wrap"><TEXTAREA type="text" name="setting_bio" placeholder="Ваша биография" class="form_big_input_section__text_field" style="padding:12px 14px;height:64px"><?php echo $user_info[0]['bio'];?></TEXTAREA></div>
	</div>
</div>


<div class="form_section" style="margin-top: 9px">
	<div class="form_big_input_section__body">
		<div class="form_big_input_section__wrap"><input type="submit" name="setting_submit" placeholder="Ваше Имя" class="button" value="Зарегестрироваться"></div>
	</div>
</div>

<div class="form_section" style="margin-top: 9px">
	<div class="form_big_input_section__body">
		<div class="form_big_input_section__wrap">
<a href="/setting/change_photo">Фото</a>

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

