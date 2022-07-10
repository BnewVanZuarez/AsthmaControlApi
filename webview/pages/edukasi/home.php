<?php
include("model.php");
switch (isset($get['sub_page']) ? $get['sub_page'] : '') {
    case 'depan':
        include("depan.php");
        break;
    default :
        include("depan.php");
        break;
}