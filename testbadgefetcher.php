<?php
require_once(__DIR__ . '/../../config.php');
require_login();

use local_showbadges\badge_fetcher;

$badges = badge_fetcher::fetch_all_badges();

header('Content-Type: application/json');
echo json_encode($badges);
