<?php

AddEventHandler("main", 'OnPageStart', 'setApplication');
function setApplication()
{
    include_once 'styles.php';
}
