<?php
function upperString($s) {
    return mb_strtoupper($s, 'UTF-8');
}

echo upperString("xin chào php");
?>