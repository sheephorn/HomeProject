<?php

namespace App\Helpers;

/**
 * 関数のメタ情報を取得・整理・提供するクラス
 * AppServiceProviderに登録してあり、そこを通して呼ばれることを想定
 * singletonであるべきクラス
 *
 */
class RouteCreater
{
    protected $xml;
    protected $idlist = [];

    /**
     * コンストラクタ
     *
     * XMLファイルを読込みは配列に変換する
     * 機能idごとにインデックスをつける
     */
    public function __construct()
    {
        $filepath = config('const.filepath')['functionsXml'];
        $this->xml = json_decode(json_encode(simplexml_load_file($filepath)), true);
        for ($count = 0; isset($this->xml['function'][$count]); $count ++) {
            $this->idlist[$count] = $this->xml['function'][$count]['@attributes']['id'];
        }
    }

    /**
     * 関数一覧を返す
     * @return Array 関数一覧配列
     */
    public function getFunctions()
    {
        return $this->xml['function'];
    }

    /**
     * 定数のHttpRequestMethodの一覧を返す
     * @return Array Method定数一覧
     */
    public function getMethods()
    {
        return $this->xml['const']['methods'];
    }

    /**
     * 機能IDを指定して関数情報を返す
     * @param  String $id 機能ID
     * @return Array     関数情報
     */
    public function findById($id)
    {
        $num = array_search($id, $this->idlist);
        return $this->xml['function'][$num];
    }
}
