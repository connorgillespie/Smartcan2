<?php

// Include file auth
const api = true;
require_once("database.php");

// Handle GET request
if($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check for auth token
    if(isset($_GET['token'])){
        // Validate auth token
        $token = $_GET['token'];
        $stmt = $mysqli->prepare("SELECT token, count, total FROM tokens WHERE token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if(!$arr){
            header('HTTP/1.0 403 Forbidden');
            die('Token invalid.');
        }
        $stmt->close();

        // Parse 'tip' data
        if(isset($_GET['tip'])){
            $tip = (bool) $_GET['tip'];
            if($tip === true){
                echo("Tipped over.");
            }
        }

        // Parse 'lid' data
        if(isset($_GET['lid'])){
            $lid = (bool) $_GET['lid'];
            if($lid === true){
                echo("Lid removed.");
            }
        }

        // Parse 'count' data
        if(isset($_GET['count'])){
            if(is_numeric($_GET['count'])){
                // Update values
                $count = (int) $_GET['count'];
                $stmt = $mysqli->prepare("UPDATE tokens SET count = ?, total = ? WHERE token = ?");
                $_count = (int) $arr[0]['count'] + $count;
                $_total = (int) $arr[0]['total'] + $count;
                $stmt->bind_param("iis", $_count, $_total, $token);
                $stmt->execute();
                $stmt->close();
            }
        }
    }
    else {
        header('HTTP/1.0 403 Forbidden');
        die('Token parameter was not found.');
    }
}