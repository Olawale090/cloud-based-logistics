"use strict";

const product_pick_up = function(){

    this.form = document.querySelector('.product_receiver_registration');

    this.username = document.querySelector(".profile_username");
    this.user_avatar = document.querySelector(".user_image_placeholder");

    this.receiverName = document.querySelector(".receiver_name");
    this.receiverEmail = document.querySelector(".receiver_email");
    this.productQuantity = document.querySelector(".product_quantity_input");

    this.receiverSerialNumber = document.querySelector(".receiver_serial_number");
    this.serialNumberGenerator = document.querySelector(".number_generator");
    this.SNGplaceholder = document.querySelector(".number_value_placeholder"); 

    this.receiversAddress = document.querySelector(".receiver_address");
    this.receiverImageSelection = document.querySelector(".receiver_upload_button");
    this.receiverQRURL = document.querySelector(".qr_code_container");

    this.receiverImagePlaceholder = document.querySelector(".r_image_placeholder");

    this.submitBtn = document.querySelector(".receiver_details_submit_btn");
    this.form_notifier = document.querySelector(".receiver_form_notifier");

    this.loader = document.querySelector(".form_loader");
    
};

product_pick_up.prototype ={

    product_delivery_number_generator(){

        this.serialNumberGenerator.addEventListener("click",(event)=>{

            event.preventDefault();

            let numberGenerator = Math.floor(Math.random()* 999000000000 ) + 1000000000;
            
            this.SNGplaceholder.innerHTML = numberGenerator;
            this.receiverSerialNumber.value = numberGenerator;
            this.receiverSerialNumber.focus();

        },false);

    },

    select_receiver_image(){

        this.receiverImageSelection.addEventListener('change',()=>{

            let reader = new FileReader();
    
            reader.onload = ()=>{

                let dataurl = reader.result;
                this.receiverImagePlaceholder.src = `${dataurl}`;

                let receiver_image_notifier = document.querySelector(".r_image_upload_notifier");

                receiver_image_notifier.style.opacity = '0';

            };
                
            reader.readAsDataURL(this.receiverImageSelection.files[0]);

        });
    },

    receiver_folder_maker(){

        this.receiverSerialNumber.addEventListener("blur",()=>{

            if ( this.receiverName.value != "" || this.receiverEmail.value != "" || this.productQuantity.value != "" || this.receiverSerialNumber.value != "") {

                // this.receiverQRURL.value = `https://donlogistics.epizy.com/directories/receiver_information.php?receiver_email=${this.receiverEmail.value}&receiver_serial_number=${this.receiverSerialNumber.value}`;
                this.receiverQRURL.value = `http://localhost/cloud-based%20delivery/directories/receiver_information.php?receiver_email=${this.receiverEmail.value}&receiver_serial_number=${this.receiverSerialNumber.value}`;

                const params = 'r_name='+this.receiverName.value+'&r_email='+this.receiverEmail.value + '&p_quantity='+this.productQuantity.value + '&r_serial_number='+this.receiverSerialNumber.value;
                
                const xhr = new XMLHttpRequest();
                xhr.open('POST','../backend/receiver_folder_mkr.php',true);
                xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

                xhr.onload = ()=>{

                    if (xhr.status === 200) {
                        
                        console.log(xhr.responseText);
    
                    } else if(xhr.status === 404) {
    
                        console.error("FILE NOT FOUND");
    
                    }
                    
                };
    
                xhr.onerror = (err)=>{
                    console.error("ERROR IN SERVER RESPONSE",err);
                };
    
                xhr.send(params);

            } else {
                console.log("Please fill the empty field");
            }


        },false);


    },

    load_user_data(){

        window.addEventListener('load',(event)=>{

            event.preventDefault();

            const xhr = new XMLHttpRequest();
            xhr.open('GET','../backend/user_account_carrier.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

            xhr.onload = ()=>{
                if (xhr.status === 200) {

                    let data_parser = JSON.parse(xhr.responseText);

                    this.username.innerHTML = data_parser.fullname;

                    if (data_parser.user_img_dir == null || data_parser.user_img_dir == "") {

                        this.user_avatar.src = "../assets/images/033-user.svg";

                    } else {

                        this.user_avatar.src = `${data_parser.user_img_dir}`;

                    }

                } else if(xhr.status === 404) {

                    console.error("DATA PIPE NOT FOUND");

                }
                
            };

            xhr.onerror = (err)=>{
                console.error("ERROR IN SERVER RESPONSE",err);
            };

            xhr.send();

        },false);

    },

    receiver_image_upload(){

        this.receiverImageSelection.addEventListener('change',(event)=>{

            event.preventDefault();

            const xhr = new XMLHttpRequest();
            xhr.open('POST','../backend/receiver_image_upload.php',true);  
            let file_data = new FormData(this.form);

            xhr.onloadstart = ()=>{

                this.loader.style.display = "block";
                
            };

            xhr.onprogress = ()=>{

                this.loader.style.display = "block";
                
            };

            xhr.onloadend = ()=>{

                this.loader.style.display = "none";
                
            };

            xhr.onload = ()=>{

                if (xhr.status === 200) {

                    let receiver_image_notifier = document.querySelector(".r_image_upload_notifier");
                    receiver_image_notifier.innerHTML = xhr.responseText;
                    console.log(xhr.responseText);

                    if (xhr.responseText == " Picture updated successfully ") {

                        receiver_image_notifier.style.color = "rgb(40, 230, 113)";

                    }else{
                        receiver_image_notifier.innerHTML = "Something went wrong";
                    }

                } else if(xhr.status === 404) {

                    console.error("DATA PIPE NOT FOUND");

                }
                
            };

            xhr.onerror = (err)=>{

                console.error("ERROR IN SERVER RESPONSE",err);

            };

            xhr.send(file_data);

        },false);

    },

    receiver_details_update(){

        this.submitBtn.addEventListener('click',(event)=>{

            event.preventDefault();
            
            const params = 'r_name='+this.receiverName.value +'&r_email=' + this.receiverEmail.value + '&p_quantity=' + this.productQuantity.value + '&r_serial_number=' + this.receiverSerialNumber.value + '&r_address='+ this.receiversAddress.value + '&r_qr_code_string=' + this.receiverQRURL.value;
            console.log(this.receiverQRURL.value);

            const xhr = new XMLHttpRequest();
            xhr.open('POST','../backend/receiver_details_update.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            
            xhr.onload = ()=>{

                if (xhr.status === 200) {
                    
                    this.form_notifier.innerHTML = xhr.responseText;

                } else if(xhr.status === 404) {

                    console.error("DATA PIPE NOT FOUND");

                }
                
            };

            xhr.onerror = (err)=>{

                console.error("ERROR IN SERVER RESPONSE",err);

            };

            xhr.send(params);

        },false);

    },

    qrCodeGenerator(){
        this.receiverSerialNumber.addEventListener("blur",()=>{

            var qrcode = new QRCode(document.querySelector(".img_qr_code"), {
                width : 200,
                height : 200
            });

            function makeCode () {		
                var elText = document.getElementById("text");
                qrcode.makeCode(elText.value);

            }
        
            makeCode();

        },false);
    },

    print_qr_code(){
        document.querySelector(".product_pick_up_QR").addEventListener('click',()=>{

            var prtContent = document.querySelector(".img_qr_code");
            var WinPrint = window.open('', '', 'left=0,top=50,width=800,height=900,toolbar=0,scrollbars=0,status=0');
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();

        },false);
        
    }

}

let product_pick_up_setup = new product_pick_up();
    product_pick_up_setup.product_delivery_number_generator();
    product_pick_up_setup.select_receiver_image();
    product_pick_up_setup.load_user_data();
    product_pick_up_setup.receiver_folder_maker();
    product_pick_up_setup.receiver_image_upload();
    product_pick_up_setup.receiver_details_update();
    product_pick_up_setup.qrCodeGenerator();
    product_pick_up_setup.print_qr_code();





const receiver_input_validator = function(){

    this.receiver_name_notifier = document.querySelector(".r_name_error_notifier");
    this.receiver_email_notifier = document.querySelector(".r_email_error_notifier");
    this.product_quantity_notifier = document.querySelector(".p_quantity_error_notifier ");
    this.receiver_address_notifier = document.querySelector(".r_address_error_notifier");
    this.receiver_image = document.querySelector(".p_image_upload_notifier");

};

receiver_input_validator.prototype  = Object.create(product_pick_up_setup);

receiver_input_validator.prototype = {

    validate_inputs (){

        this.receiverName.addEventListener("blur",()=>{
            
            if(this.receiverName.value == ''){
                this.receiver_name_notifier.style.opacity = "1";
            }else{
                this.receiver_name_notifier.style.opacity = "0";
            }

        });

        this.receiverName.addEventListener("input",()=>{
            
            this.receiver_name_notifier.style.opacity = "0";

        },false);


        this.receiverEmail.addEventListener("blur",()=>{
            
            if(this.receiverEmail.value == ''){

                this.receiver_email_notifier.style.opacity = "1";

            }else{

                this.receiver_email_notifier.style.opacity = "0";

            }

        });

        this.receiverEmail.addEventListener("input",()=>{
            
            this.receiver_email_notifier.style.opacity = '0';

        },false);


        this.productQuantity.addEventListener("blur",()=>{

            if(this.productQuantity.value == ''){

                this.product_quantity_notifier.style.opacity = "1";

            }else{

                this.product_quantity_notifier.style.opacity = "0";

            }

        });

        this.productQuantity.addEventListener("input",()=>{
            
            this.product_quantity_notifier.style.opacity = '0';

        },false);

        this.receiversAddress.addEventListener("blur",()=>{
        
            if( this.receiversAddress.value == ''){

                this.receiver_address_notifier.style.opacity = "1";

            }else{

                this.receiver_address_notifier.style.opacity = "0";

            }

        });

        this.receiversAddress.addEventListener("input",()=>{
            
            this.receiver_address_notifier.style.opacity = '0';

        },false);


    }

};


let validator = new receiver_input_validator();
                Object.assign(validator, product_pick_up_setup);

    validator.validate_inputs();



