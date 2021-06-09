# curl-http
    
##### a http require package

    use varzer/service/Http;
    
    GET:
    $url = 'https://api.about.xx.cn/user?id=100';
    $jsonObject = Http::requestJSON($url);
    
    POST:
    $url = 'https://api.about.xx.cn/user';
    $params = [
        "name"=>"varzer",
        "pwd"=>"***",
        "xx"=>"xx",
    ];
    
    $jsonObject = Http:requestJSON($url,$params,'POST');
    

