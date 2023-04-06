<?php
require SITE_ROOT.'/resources/views/tpl/sidebar.tpl.php';
require SITE_ROOT.'/resources/views/tpl/head.tpl.php';
require SITE_ROOT.'/resources/views/tpl/common.tpl.php';
?>


<div class="reg_content">



<style type="text/css">



 .not_found{padding:74px 0;}
</style>	


	


<style type="text/css">
	.sidebar_desktop{position: fixed;top:59px;}
	.sidebar_desktop__user_photo{width:94px;height: 94px;background-size: cover;margin:3px 11px;border-radius:9px;background-color: #EEE}
	.sidebar_desktop__body__item{display: block;padding:5px 11px 5px;color: #000}
	.sidebar_desktop__body__item:hover{background-color: #EEE}
</style><style type="text/css">
	.sidebar_desktop{position: fixed;top:59px;}
	.sidebar_desktop__user_photo{width:94px;height: 94px;background-size: cover;margin:3px 11px;border-radius:9px;background-color: #EEE}
	.sidebar_desktop__body__item{display: block;padding:5px 11px 5px;color: #000}
	.sidebar_desktop__body__item:hover{background-color: #EEE}
</style>




<style type="text/css">
.not_found__title{font-size:1.5em}
</style>


<div class="not_found" style="text-align: center;">

<div class="not_found__title">Страница не найдена</div>




<div class="not_found__body" style="line-height:29px">
<div style="padding:17px 0">Страница не найдена, не существует или была удалена</div>
<a href="/" style="border-bottom:1px dashed #000">На главную</a>

</div>

</div>




















</div>


<?php

require SITE_ROOT.'/resources/views/tpl/footer.tpl.php';
?>