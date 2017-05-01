<?php

namespace App\Helpers;

/**
 * 関数のメタ情報を取得・整理・提供するクラス
 * AppServiceProviderに登録してあり、そこを通して呼ばれることを想定
 * singletonであるべきクラス
 *
 */
class MessageCreater
{
    protected $xml;

    /**
     * コンストラクタ
     *
     * XMLファイルを読込みは配列に変換する
     * 機能idごとにインデックスをつける
     */
    public function __construct()
    {
        $filepath = config('const.filepath')['messagesXml'];
        $this->xml = json_decode(json_encode(simplexml_load_file($filepath)), true);
    }

    public function getCommonErrorMessage()
    {
        return $this->xml['common']['ng']['value'];
    }

    public function getLoginMessage($str)
    {
        return $this->xml['login'][$str]['value'];
    }

    public function getLoginMiddlewareMessage($str)
    {
        return $this->xml['loginmiddleware']['str']['value'];
    }
}
