<?php
/*
Bu sayfa ödeme başarılı olduğu taktirde kasagame tarafından ödemeinin başarılı olduğunun bildirisini alacağınız sayfadır.
*/
$_api_key = "-------------------------------------"; //kasagame api güvenlik anahtarınız
$_merchant_id = 0; //kasa game merchant id

if ($_POST)
{
    $merchant_id = $_POST["merchant_id"]; //mağaza id
    $api_key = $_POST["api_key"]; // api güvenlik anahtarı
    $order_id = $_POST["order_id"]; //sipariş numarası
    $price = $_POST["price"]; //brüt fiyat
    $net_profit = $_POST["net_profit"]; //net fiyat
    $product_id = $_POST["product_id"]; //satın alınan ürün id
    $return_id = $_POST["return_id"]; //kasagame gönderilen ilk kullanıcı parametresi
    $return_id2 = $_POST["return_id2"]; //kasagame gönderilen ikinci kullanıcı parametresi
    $extra_data = $_POST["extra_data"]; //satın alınan ürüne ait ekstra bilgi. ürünü tanımlarken girilen bakiye tutarı vb değer.
    $api_payment_id = $_POST["api_payment_id"]; //hangi ödeme yöntemi ile siparişin gerçekleştiği
    /*
    2 ise Banka Havalesi (GPAY)
    3 ise Kredi Kartı (GPAY)
    4 ise İninal
    5 ise Gpay Cüzdan
    6 ise Kredi Kartı (GPAY)
    7 ise Mobil Ödeme
    9 ise Kripto Para
    */

    if ($api_key != $_api_key || $merchant_id != $_merchant_id)
    {
        exit("api_key or merchang_id not supported!");
    }
    if ($order_id == "" || $price == "" || $net_profit == "" || $product_id == "" || $return_id == "" || $api_payment_id == "")
    {
        exit("missing data error");
    }
    
    /*
    Bu kısıma veritabanınızda oluşturduğunuz tabloya satın alımı kaydetmek veya kullanıcınızın bakiyesini yüklemek için gerekli olan sql sorgularını yazabilirsiniz. 

    NOT: Update veya insert sorgusunu yapmadan önce order_id daha önceden var olup olmadığının kontrolünü yapabilirsiniz veya veritabanınızda order_id alanını benzersiz bir değişken yaparak bu durumu önleyebilirsiniz. 
    */
   
}

?>
