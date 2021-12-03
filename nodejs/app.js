"use strict"

const { default: axios } = require("axios");
const express = require("express"),
bodyParser = require("body-parser"),
prop = require("./prop"),
axius = require("axios");

const app = express();

app.use(bodyParser.json())
app.set("view engine", "ejs")
app.use(express.urlencoded({
    extended: true
}))

app.listen(prop.SERVER_PORT, () => {console.log(`${prop.SERVER_PORT} port listen...`);});

app.get('/', (req, res) => {
    axios.post(prop.API_URL, {
        api_key: prop.API_KEY,
        merchant_id: prop.MERCHANT_ID,
        return_id: "username",
        return_id2: "email"
    }).then(result => {
        if(result.data.state)
        {
          res.render("index", {title: "Kasagame Payment", url: result.data.message})  
        }
        else
        {
            res.status(400).res.send("api error")
        }
    }).catch(err => {
        console.log(err)
    })
})

app.post('/payment/result', (req, res) => {
    const merchant_id = req.body.merchant_id; //mağaza id
    const api_key = req.body.api_key; //api güvenlik anahtarı
    const order_id = req.body.order_id; //sipariş numarası
    const price = req.body.price; //brüt fiyat
    const net_profit = req.body.net_profit;//net fiyat
    const product_id = req.body.product_id; //satın alınan ürün id
    const return_id = req.body.return_id; //kasagame gönderilen ilk kullanıcı parametresi
    const return_id2 = req.body.return_id2; //kasagame gönderilen ikinci kullanıcı 
    const extra_data = req.body.extra_data; //satın alınan ürüne ait ekstra bilgi. ürünü tanımlarken girilen bakiye tutarı vb değer.
    const api_payment_id = req.body.api_payment_id; //hangi ödeme yöntemi ile siparişin gerçekleştiği
     /*
    2 ise Banka Havalesi (GPAY)
    3 ise Kredi Kartı (GPAY)
    4 ise İninal
    5 ise Gpay Cüzdan
    6 ise Kredi Kartı (GPAY)
    7 ise Mobil Ödeme
    9 ise Kripto Para
    */

    if(api_key != prop.API_KEY || merchant_id != prop.MERCHANT_ID){
        res.send("api_key or merchang_id not supported!")
    }

    if(order_id == "" || price == "" || net_profit == "" || product_id == "" || return_id == "" || api_payment_id == "")
    {
        res.send("missing data error")
    }
     /*
    Bu kısıma veritabanınızda oluşturduğunuz tabloya satın alımı kaydetmek veya kullanıcınızın bakiyesini yüklemek için gerekli olan sql sorgularını yazabilirsiniz. 

    NOT: Update veya insert sorgusunu yapmadan önce order_id daha önceden var olup olmadığının kontrolünü yapabilirsiniz veya veritabanınızda order_id alanını benzersiz bir değişken yaparak bu durumu önleyebilirsiniz. 
    */

})