<?php
function logMessage($message) {
    error_log($message, 3, "app.log");
}