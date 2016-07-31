<?php
$directory = 'users';
$users = array_diff(scandir($directory), array('..', '.'));

define('API_KEY','3f6487b86e4ccd78e101a74c1ca17108');

function makeHTTPRequest($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY
."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

function ufile($f){
$content = (int)  file_get_contents($f);
if($content > 1) file_put_contents($f,($content+1));
}

$i = 0;
foreach($users as $u ){
$i++;
if($i > 10 ){
sleep(2);
$i=0;
}
$j = json_decode(file_get_contents("users/$u"));
$r =(makeHTTPRequest("sendMessage",[
'chat_id'=>$j->id,
'text'=>"❗️ روبات مثل این روبات ساخته میشود با هزینه کم

سورس این روبات به زودی در کانال قرار میگیرد، روباتی مانند همین روبات با هزینه کم ساخته میشود .
جهت سوالات بیشتر با @AriyaUp_A تماس بگیرید.

https://telegram.me/joinchat/DKSu6T16bieqJtQ5_UvNcA",
'parse_mode'=>'HTML'
]));


if ($r->ok){
ufile("ok");
}
else{
ufile("nok");
}

}
