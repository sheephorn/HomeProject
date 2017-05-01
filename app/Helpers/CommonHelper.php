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

function createErrorLog($e, $condition)
{
    \Log::error($e->getMessage()." line:".$e->getLine()." in: ".$e->getFile() );
    \Log::error("PATH IS  ");
    \Log::error($condition->path());
    \Log::error("REQUEST IS  ");
    \Log::error($condition->all());
	return true;
}
