"use strict";

const fraud_awareness_form = function(){

    this.form = document.querySelector('.fraud_awareness_form');

    this.username = document.querySelector(".username");
    this.user_avatar = document.querySelector(".u_avatar");


    this.complainantName = document.querySelector(".complainant_name");
    this.agentEmail = document.querySelector(".agent_email");
    this.customerComplain = document.querySelector(".complaint_box");
    this.productName = document.querySelector(".product_name");
    this.productDeliveryNumber = document.querySelector(".product_delivery_number");
 
    this.agentImagePicker = document.querySelector(".agent_image_picker");
    this.agentImagePlaceholder = document.querySelector(".agent_image_placeholder");

    this.submitBtn = document.querySelector(".fraud_awareness_submit_btn");

    this.form_notifier = document.querySelector(".fraud_form_notifier");
    this.loader = document.querySelector(".form_loader");
    
};

fraud_awareness_form.prototype ={

    select_agent_image(){

        this.agentImagePicker.addEventListener('change',()=>{

            let reader = new FileReader();
    
            reader.onload = ()=>{

                let dataurl = reader.result;
                this.agentImagePlaceholder.src = `${dataurl}`;

                let agent_image_notifier = document.querySelector(".fraud_upload_notifier");

                agent_image_notifier.style.opacity = '0';

            };
                
            reader.readAsDataURL(this.agentImagePicker.files[0]);

        });
    },

    fraud_folder_maker(){

        this.productDeliveryNumber.addEventListener("blur",()=>{

            if (this.complainantName.value != "" || this.agentEmail.value != "" || this.customerComplain.value != "" || this.productName.value != "" || this.productDeliveryNumber.value != "") {

                const params = 'complainant_name='+this.complainantName.value + '&agent_email='+this.agentEmail.value + '&complain_box='+this.customerComplain.value + '&product_name='+this.productName.value + '&product_delivery_number='+this.productDeliveryNumber.value;
                
                const xhr = new XMLHttpRequest();
                xhr.open('POST','../backend/fraud_awareness_folder_mkr.php',true);
                xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

                xhr.onload = ()=>{
                    if (xhr.status === 200) {
                        
                        console.log("File maker initiated...");
    
                    } else if(xhr.status === 404) {
    
                        console.error("FILE NOT FOUND");
    
                    }
                    
                };
    
                xhr.onerror = (err)=>{

                    console.error("ERROR IN SERVER RESPONSE",err);

                };
    
                xhr.send(params);

            } else {

                console.log(" Please fill the empty field(s) ");

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

    agent_image_upload(){

        this.agentImagePicker.addEventListener('change',(event)=>{

            event.preventDefault();

            const xhr = new XMLHttpRequest();
            xhr.open('POST','../backend/fraud_awareness_image_upload.php',true);  
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

                    let fraud_image_notifier = document.querySelector(".fraud_upload_notifier");
                    fraud_image_notifier.innerHTML = xhr.responseText;

                    if (xhr.responseText == " Picture updated successfully ") {

                        fraud_image_notifier.style.color = "rgb(40, 230, 113)";

                    }else{
                        fraud_image_notifier.innerHTML = "something went wrong";
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

    complain_full_report(){

        this.submitBtn.addEventListener('click',(event)=>{

            event.preventDefault();
            
            const params = 'complainant_name='+this.complainantName.value + '&agent_email='+this.agentEmail.value + '&complaint_box='+this.customerComplain.value + '&product_name='+this.productName.value + '&product_delivery_number='+this.productDeliveryNumber.value;

            const xhr = new XMLHttpRequest();
            xhr.open('POST','../backend/fraud_awareness_proxy.php',true);
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

    }

}

let fraud_awareness = new fraud_awareness_form();

    fraud_awareness.select_agent_image();
    fraud_awareness.load_user_data();
    fraud_awareness.fraud_folder_maker();
    fraud_awareness.agent_image_upload();
    fraud_awareness.complain_full_report();

const fraud_input_validator = function(){

    this.complainant_name_notifier = document.querySelector(".complainant_name_error_notifier");
    this.agent_email_notifier = document.querySelector(".agent_email_error_notifier");
    this.complain_box_notifier = document.querySelector(".complain_box_error_notifier");
    this.product_name_notifier = document.querySelector(".p_name_error_notifier");
    this.product_number_notifier = document.querySelector(".p_delivery_number_error_notifier");
    this.fraud_image_upload = document.querySelector(".fraud_upload_notifier");

};

fraud_input_validator.prototype  = Object.create(fraud_awareness);

fraud_input_validator.prototype = {

    validate_inputs (){

        this.complainantName.addEventListener("blur",()=>{
            
            if(this.complainantName.value == ''){
                this.complainant_name_notifier.style.opacity = "1";
            }else{
                this.complainant_name_notifier.style.opacity = "0";
            }

        });

        this.complainantName.addEventListener("input",()=>{
            
            this.complainant_name_notifier.style.opacity = "0";

        },false);


        this.agentEmail.addEventListener("blur",()=>{
            
            if(this.agentEmail.value == ''){

                this.agent_email_notifier.style.opacity = "1";

            }else{

                this.agent_email_notifier.style.opacity = "0";

            }

        });

        this.agentEmail.addEventListener("input",()=>{
            
            this.agent_email_notifier.style.opacity = '0';

        },false);


        this.customerComplain.addEventListener("blur",()=>{

            if(this.customerComplain.value == ''){

                this.complain_box_notifier.style.opacity = "1";

            }else{

                this.complain_box_notifier.style.opacity = "0";

            }

        });

        this.customerComplain.addEventListener("input",()=>{
            
            this.complain_box_notifier.style.opacity = '0';

        },false);


        this.productName.addEventListener("blur",()=>{
            
            if(this.productName.value == ''){

                this.product_name_notifier.style.opacity = "1";

            }else{

                this.product_name_notifier.style.opacity = "0";

            }

        });

        this.productName.addEventListener("input",()=>{
            
            this.product_name_notifier.style.opacity = '0';

        },false);


        this.productDeliveryNumber.addEventListener("blur",()=>{
            
            if(this.productDeliveryNumber.value == ''){

                this.product_number_notifier.style.opacity = "1";

            }else{

                this.product_number_notifier.style.opacity = "0";

            }

        });

        this.productDeliveryNumber.addEventListener("input",()=>{
            
            this.product_number_notifier.style.opacity = '0';

        },false);

    }

};

let validator = new fraud_input_validator();
                Object.assign(validator, fraud_awareness);

    validator.validate_inputs();


    // function checker() {
    //     var prtContent = document.getElementById("printme");
    //     var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
    //     WinPrint.document.write(prtContent.innerHTML);
    //     WinPrint.document.close();
    //     WinPrint.focus();
    //     WinPrint.print();
    //     WinPrint.close();
    // }

    // document.querySelector(".print_btn").addEventListener('click',checker,false);