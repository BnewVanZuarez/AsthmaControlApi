<?php
include("model.php");
switch (isset($get['sub_page']) ? $get['sub_page'] : '') {
    case 'depan':
        include("depan.php");
        break;
    case 'baru':
        include("baru.php");
        break;
    case 'edit':
        include("baru.php");
        break;
    default :
        include("depan.php");
        break;
}