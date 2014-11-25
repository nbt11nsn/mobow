<!DOCTYPE html>
<html>
<head>
<?php
  defined('THE_HEAD') || define('THE_HEAD', TRUE);
  include_once("include/head.php");
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
<?php
  defined('THE_HEADER') || define('THE_HEADER', TRUE);
  require_once("include/header.php");
?>
<div id="main-wrapper">
<?php
  defined('THE_MENUE') || define('THE_MENUE', TRUE);
  require_once("include/menuebar.php");
?>
<div id = "frame"
  <div class="upload_form_cont">
    <form id="upload_form" enctype="multipart/form-data" method="post" action="upload.php">
      <div>
        <div>
	  <label for="image_file">Please select image file</label>
	</div>
        <div>
	  <input type="file" name="image_file" id="image_file" onchange="fileSelected();" />
	</div>
      </div>
      <div>
        <input type="button" value="Upload" onclick="startUploading()" />
      </div>
      <div id="fileinfo">
        <div id="filename"></div>
        <div id="filesize"></div>
        <div id="filetype"></div>
        <div id="filedim"></div>
      </div>
      <div id="error">You should select valid image files only!
      </div>
      <div id="error2">An error occurred while uploading the file
      </div>
      <div id="abort">The upload has been canceled by the user or the browser dropped the connection
      </div>
      <div id="warnsize">Your file is very big. We can't accept it. Please select more small file
      </div>
      <div id="progress_info">
        <div id="progress"></div>
        <div id="progress_percent">&nbsp;</div>
        <div class="clear_both"></div>
        <div>
          <div id="speed">&nbsp;</div>
          <div id="remaining">&nbsp;</div>
          <div id="b_transfered">&nbsp;</div>
          <div class="clear_both"></div>
        </div>
        <div id="upload_response"></div>
      </div>
    </form>
    <img id="preview" />
  </div>
</div>
</div><!--main-wrapper-->
<?php
  defined('THE_FOOTER') || define('THE_FOOTER', TRUE);
  require_once("include/footer.php");
?>
</body>
</html>

