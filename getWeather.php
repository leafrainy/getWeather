<?php
/**
 * 获取最近7天的天气数据
 * 数据来源：www.weather.com.cn
 * 作者：leafrainy （leafrainy.cc）
 * 时间：2017-07-03
 */

class getWeather {


    //获取天气数据
    public function getWeatherData($cityCode=0){
        
        $this->checkCityCode($cityCode);
        $siteData = $this->get('http://www.weather.com.cn/weather/'.$cityCode.'.shtml');
        preg_match_all("/<script([\w\W]*)<\/script>/iU", $siteData, $matches);
        $rs = str_replace("var hour3data=","",str_replace("</script>","",str_replace("<script>","",$matches[0][3])));
        echo $rs;

    }


    //get请求
    private function get($url, $timeoutMs = 3000) {
        $options = array(
            CURLOPT_URL                 => $url,
            CURLOPT_RETURNTRANSFER      => TRUE,
            CURLOPT_HEADER              => 0,
            CURLOPT_CONNECTTIMEOUT_MS   => $timeoutMs,
        );
        $ch = curl_init();
        curl_setopt_array( $ch, $options);
        $rs = curl_exec($ch);
        curl_close($ch);

        return $rs;
    }


    //城市代码检查
    private function checkCityCode($cityCode){
        if(!$cityCode){
            $rs = "请输入城市代码";
            echo $rs;
            return 0;
        }else{
            //todo
            return 1;
        }
    }

}





