<?php
require_once(__DIR__ . '/../../config.php');
require_once('./classes/dashboard_fetcher.php');
require_login();

$userid = $USER->id;
$user_progress = local_showbadges\dashboard_fetcher::fetch_user_progress($userid);

header('Content-Type: application/json');
echo json_encode($user_progress);
