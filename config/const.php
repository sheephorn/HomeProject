<?php

return [
    /**
     * ファイル保管場所・ファイル名を定義
     */
    'filepath' => [
        'functionsXml' => env('ROOT_DIR') . DIRECTORY_SEPARATOR . 'xmls' . DIRECTORY_SEPARATOR . 'functions.xml',
        'codesXml' => env('ROOT_DIR') . DIRECTORY_SEPARATOR . 'xmls' . DIRECTORY_SEPARATOR . 'codes.xml',
        'messagesXml' => env('ROOT_DIR') . DIRECTORY_SEPARATOR . 'xmls' . DIRECTORY_SEPARATOR . 'messages.xml',
    ],

    /**
     * 現在時刻取得のフォーマットを定義
     * CommonHelper関数 getAccessTimeのフォーマット形式
     * システム全体の現在時刻管理
     *
     */
    'accessTimeFormat' => 'Y/m/d H:i:s',
    'standardDateFormat' => 'Y-m-d',
    'expentDateFormats' => [
        'Y-m-d',
        'Ymd',
        'Y/m/d',
    ],

    /**
     * リスト表示関連　１ページあたりの標準表示件数
     */
    'showListRecordsNumber' => 25,

    /**
     * リスト表示関連　標準初期表示ページ数
     */
     'startPage' => 1,

];
