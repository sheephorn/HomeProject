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
    return getCurrentDateTimeobject()->format(config('const.accessTimeFormat'));
}

/**
 * 現在日をフォーマットして返す
 */
function getCurrentDate()
{
    return getCurrentDateTimeobject()->format(config('const.standardDateFormat'));
}

/**
 * 日付のフォーマットを標準に整える
 * 予期せぬフォーマットが与えられた場合は例外を投げる
 */
function getStandardDateFormat($date)
{
    $formats = config('const.expectDateFormats');
    foreach ($formats as $format) {
        $ret = date_create_from_format($format, $date);
        if($ret) {
            break;
        }
    }
    if($ret) {
        $ret = $ret->format(config('const.standardDateFormat'));
    } else {
        \Log::error($date);
        throw new \Exception(app('MessageCreater')->getFailMessage('dateformat'));
    }
    return $ret;
}

/**
 * 例外発生時にエラーログを残す
 * @param  Object $e         Exception
 * @param  Object $condition Request
 * @return Boolean
 */
function createErrorLog($e, $condition)
{
    \Log::error($e->getMessage()." line:".$e->getLine()." in: ".$e->getFile() );
    \Log::error("PATH IS  ");
    \Log::error($condition->path());
    \Log::error("REQUEST IS  ");
    \Log::error($condition->all());
	return true;
}

/**
 * ユーザーセッション情報を取得する
 * @param  Object $request Request
 * @return Array          ユーザーセッション情報
 */
function getUserSession($request)
{
    return $request->session()->get('user');
}
