<?php
/*
Bu sayfa sitenizde kullanıcılarınızı ödeme, yükleme vb işlemlerini yapacakları sayfadır.
*/

if (!isset($_SESSION['UserId'])) exit('<script type="text/javascript">alert("Kullanıcı girişi yapmanız gerekmektedir.");window.location="https://www.google.com";</script>');

//api detail
$api_key = "-------------------------------------"; //kasagame api güvenlik anahtarınız
$merchant_id = 0; //kasa game merchant id
$api_url = "https://api.kasagame.com/api/payment";

//return data [1,2]
$userID = $_SESSION["UserID"];
$userName = $_SESSION["UserName"];

//post data
$postData = array(
    'api_key' => $api_key,
    'merchant_id' => $merchant_id,
    'return_id' => $_SESSION['UserName'],
    'return_id2' => $_SESSION['UserID']
);


$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $api_url);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_POST, count($postData));
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
if ($err)
{
    echo 'Curl Error :' . $err;
}
else
{
    $data = json_decode($response);
    $state = $data->{'state'};
    if ($state == "true")
    {
        $url = $data->{'message'};
        echo '<iframe seamless="seamless" style="display:block; width:100%; height:653px;" frameborder="0" scrolling="yes" src="' . $url . '"></iframe>';
    }
}

?>
