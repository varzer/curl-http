<?php
/**
 * Author   :   SetMe
 * Time     :   2021/6/9 14:32
 * FileName :   Http.php
 * WeChat   :   HzzYyr
 */

namespace varzer\service;


class Http
{
    public static function requestJSON($url, $params = [], $method = 'GET')
    {
        $opts = [
            CURLOPT_TIMEOUT        => 10,//函数执行的最长秒数
            CURLOPT_RETURNTRANSFER => true,//TRUE  获取的信息以字符串返回
            CURLOPT_SSL_VERIFYHOST => false,//0 为不检查名称
            CURLOPT_SSL_VERIFYPEER => false,//禁止验证对等证书
            CURLOPT_HEADER         => false//启用时会将头文件的信息作为数据流输出
        ];
        switch ( strtoupper( $method ) )
        {
            case 'GET':
                if ( $params )
                {
                    $opts[ CURLOPT_URL ] = $url . '?' . http_build_query( $params );
                }
                else
                {
                    $opts[ CURLOPT_URL ] = $url;
                }
                break;
            case 'POST':
                $opts += [
                    CURLOPT_URL        => $url,//
                    CURLOPT_POST       => true,//
                    CURLOPT_POSTFIELDS => $params//
                ];
                break;
        }

        $ch = curl_init();
        curl_setopt_array( $ch, $opts );
        $res = curl_exec( $ch );
        $err = curl_error( $ch );
        curl_close( $ch );

        if ( !$res )
        {
            throw new \Exception( 'curl request fail, err:' . $err );
        }

        return json_decode( $res, true );
    }
}