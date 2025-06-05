<?php
session_start();
session_destroy();
header('location:/adiestramiento/login');
