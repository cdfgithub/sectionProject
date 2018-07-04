<?php
/*改代码仅供学习，不可用于商业用途
 *
 * */
$data=json_encode($_POST['return_code']);
error_log($data,3,"./errors.log");
