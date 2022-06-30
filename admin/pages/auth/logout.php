<?php
session_unset(); 
session_destroy();
header('Location: '. $admin_base_url);