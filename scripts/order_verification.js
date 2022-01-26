"use strict";

// using ES5 structural design pattern to creating objects and API interaction

export const load_product = function(){
    

};

load_product.prototype ={
   
    product_details_mount(){

        window.addEventListener('load',(event)=>{
            
            event.preventDefault();

            const xhr = new XMLHttpRequest();
            xhr.open('GET','../backend/order_verification_data.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

            xhr.onload = ()=>{
                if (xhr.status === 200) {

                    let data_parser = JSON.parse(xhr.responseText);
                    console.log(data_parser);

                    var qrcode = new QRCode(document.querySelector(".img_qr_code"), {
                        width : 200,
                        height : 200
                    });
        
                    function makeCode () {		

                        qrcode.makeCode(data_parser.product_qr_url_string);
        
                    }
                
                    makeCode();

                } else if(xhr.status === 404) {

                    console.error("DATA PIPE NOT FOUND");

                }
                
            };

            xhr.onerror = (err)=>{

                console.error("ERROR IN SERVER RESPONSE",err);

            };

            xhr.send();
        });
    },


}

let product_binder = new load_product();
product_binder.product_details_mount();