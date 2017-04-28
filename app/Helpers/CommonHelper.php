<?php

function getCurrentDateTimeobject()
{
    return date_create();
}
function getAccessTime()
{
    return getCurrentDateTimeobject()->format('Y/m/d H:i:s');
}
