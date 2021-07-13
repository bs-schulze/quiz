<?php
require_once "db/Store.php";
$databaseDirectory = __DIR__ . "/gamedb";
$questionStore = new \SleekDB\Store("question", $databaseDirectory);
$userStore = new \SleekDB\Store("user", $databaseDirectory);
$answerStore = new \SleekDB\Store("answer", $databaseDirectory);