<?php
require SITE_ROOT.'/resources/views/tpl/sidebar.tpl.php';
require SITE_ROOT.'/resources/views/tpl/head.tpl.php';
require SITE_ROOT.'/resources/views/tpl/common.tpl.php';
?>
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
        $('#upload_image').css('background-image', 'url('+obj.big_photo_path+')');
        $('#big_photo_path').val(obj.big_photo_path);
    }

  });
}

function photoUpload() {
  $.ajax({
    method: 'post',
    url: '/photo/save_photo/?_token={{csrf_token()}}',



    data: {'big_photo': $('#big_photo_path').val(),
    'small_photo': $('#big_photo_path').val(),
'text': tinyMCE.activeEditor.getContent(),
    'title': $('#title').val()},
    success: function(obj) {
console.log(obj);
    }
  });
}


</script>

<div class="photo_content" style="text-align: center;padding:24px 0">

<input type="hidden" name="" id="big_photo_path">




<div class="too-block" style="width: 75%">
<div class="too-block__wrap">

<div class="too-block__photo_wrap">
<div class="too-block__photo fly_block" id="upload_image" style="width: 35%; background-color: #EEE">

</div>
</div>



<div class="too-block__info">


  <div class="form_section">
  <div class="form_big_input_section__title" style="text-align: left;"><span class="form_big_input_section__title_label">Имя:</span></div>

  <div class="form_big_input_section__body">
    <div class="form_big_input_section__wrap"><input type="text" name="reg_first_name" id="title" placeholder="Ваше имя" class="form_big_input_section__text_field"></div>
  </div>
</div>


  <script src="https://cdn.tiny.cloud/1/9urzehoowv03rdhn0hd1jm3v6wntvgmcmz5lk43qc4mu9dtu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
  <textarea>
     Welcome to TinyMCE!
  </textarea>
  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ]
    });
  </script>



  <div class="form_section" style="margin:14px 0">

  <div class="form_big_input_section__body">
    <div class="form_big_input_section__wrap"><input type="file" name="reg_first_name" onchange="selectPhoto(this.files[0])" placeholder="Ваше имя" class=""></div>
  </div>
</div>


  <div class="form_section" style="margin:5px 0">

  <div class="form_big_input_section__body">
    <div class="form_big_input_section__wrap"><input type="submit" name="reg_first_name" onClick="event.preventDefault();photoUpload()"  placeholder="Ваше имя" class="button"></div>
  </div>
</div>






</div>



</div>
  
</div>


</div>