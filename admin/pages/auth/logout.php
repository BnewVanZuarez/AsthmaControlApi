<?php
session_unset(); 
session_destroy();
header('Location: '. $global_base_url);