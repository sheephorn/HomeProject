<?php

/**
 * 現在時刻オブジェクトを返す
 */
function getCurrentDateTimeobject()
{
    return date_create();
}

/**
 * 現在時刻をフォーマットして返す
 */
function getAccessTime()
{
    return getCurrentDateTimeobject()->format(config('const.date_format'));
}
