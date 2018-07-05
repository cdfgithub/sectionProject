<?php
/*该代码请勿商用*/
$data=json_encode($_POST['return_code']);
error_log($data,3,"./errors.log");
