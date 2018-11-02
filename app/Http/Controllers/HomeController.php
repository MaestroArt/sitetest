<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weather=$this->getWeather();

        return view('home',$weather);
    }

    protected function getWeather()
    {
        $dataResult=[];
        $startTag='class="section higher"';
        $notFound="Not found";
        
        $typeStartTag='div';
        $content=$this->getCurlContents("https://www.gismeteo.ua/weather-zaporizhia-5093/");
        
        $pos=strpos($content,$startTag);
        if(false===$pos)return "Wrong start tag.<br>".$content;

        $pos=strpos($content,'>',$pos)+1;
        if(false===$pos)return "Wrong start tag2.";

        $content=substr($content,$pos); 

        $pos=$this->findEndTag($content,$typeStartTag);
        if(false===$pos) {
            $pos=strpos($content, "footer_content");
            if(false===$pos)return "End tag not found";
        }

        $content=substr($content,0,$pos);
        $dataResult['content']=$content;

        //osadki
        if(preg_match('/<dt [^>]*?title=\"([^\"]*?)\"[^>]*?background-image: url\(([^\)]+)\)\">/i',$content,$osadki)) {
            $dataResult["osadki"]="".$osadki[1]." <img src='".$osadki[2]."'/>";
        } else {
            $dataResult["osadki"]=$notFound;
        }
        //temperature
        if(preg_match('/class=\"temp\">[^<]*?<dd class=\'value m_temp c\'>([^<]*?)</i',$content,$temperature)) {
            $dataResult["temperature"]=$temperature[1];
        } else {
            $dataResult["temperature"]=$notFound;
        }
        //wind
        if(preg_match('/wicon wind\">[^<]*?<dl [^>]*?title=[\"\']([^\"\']*?)[\"\'][^>]*?>[^<]*?<dd [^>]*?value m_wind ms[^>]*?>([^<]*?)</i',$content,$wind)) {
            $dataResult["wind"]=$wind[1]." ".$wind[2];
        } else {
            $dataResult["wind"]=$notFound;
        }
        //Pressure
        if(preg_match('/<dd class=\'value m_press torr\'>([^<]*?)</i',$content,$pressure)) {
            $dataResult["pressure"]=$pressure[1];
        } else {
            $dataResult["pressure"]=$notFound;
        }
        //Humidity
        if(preg_match('/class=\"wicon hum\"[^>]*?>([^<]*?)</i',$content,$humidity)) {
            $dataResult["humidity"]=$humidity[1];
        } else {
            $dataResult["humidity"]=$notFound;
        }
        //Update time
        if(preg_match('/class=\"wrap f_link\"[^>]*?>[^<]*?<span[^>]*?>([^<]*?)</i',$content,$upd)) {
            $dataResult["upd"]=$upd[1];
        } else {
            $dataResult["upd"]=$notFound;
        }

        return $dataResult;
    }

    protected function getCurlContents($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_REFERER, "http://maestrotools.ru");
        $html = curl_exec($ch);
    
        curl_close($ch);

        return $html;
    }

    protected function findEndTag($str,$tag="div",$posStart=0,$posEnd=0)
    {
        $startTagpos=stripos($str, "<$tag",$posStart);
        $endTagpos=stripos($str, "</$tag",$posEnd);
        if(false===$startTagpos||false===$endTagpos) {
            return $endTagpos;
        }
        if($endTagpos<$startTagpos) {
            return $endTagpos;
        }
        return $this->findEndTag($str,$tag,$startTagpos+1,$endTagpos+1);
    }
}
