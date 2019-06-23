<?php
require_once('../../Config/config.php');

session_start();
session_destroy();

header('Location:' . INDEX_URL);