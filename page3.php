 <?php
    session_start();
    require_once 'config.php';
    include('header_.php');
    //include('header-banner1.php');
    ?>
 <style>
     .wrap {
         padding: 30px 20px;
         padding-bottom: 0px;
     }

     .form-step {
         margin-bottom: 30px;
     }

     .form-row {
         display: flex;
         margin-bottom: 10px;
         font-size: 16px;
     }

     .form-row label {
         flex: 0 0 170px;
         line-height: 30px;
     }

     h3.step {
         font-size: 18px;
         font-weight: bold;
         color: #325754;
         margin-bottom: 10px;
     }

     .form-row input,
     .form-input input,
     .form-row select {
         flex-grow: 1;
         border: 1px solid #325754;
         height: 30px;
         outline: none;
         padding: 0 10px;
         border-radius: 4px;
     }

     .w-full {
         width: calc(100% - 50px);
     }

     .notice {
         /* border: 2px solid red; */
         padding: 10px;
         border-radius: 5px;
         color: #777977;
         margin: 30px 0 40px;
         background: #f0f0eb;
     }

     .extra-text {
         margin-top: 20px;
     }

     @media(max-width: 767px) {
         .submit-btn {
             background-color:  #DA291C;
             padding: 11px 24px;
             font-size: 1rem;
             display: block;
             width: 100%;
             min-width: 120px;
             margin-left: auto;
             margin-right: auto;
             line-height: 22px;
             border-radius: 32px;
             color: #fff;
             border-color: #ffc80c;
             height: auto;
             cursor: pointer;
         }

         .submit-btn:hover:hover {
             background-color: #ffc80c;
             border-color: #ffc80c;
         }
     }

     @media(max-width: 425px) {
         .w-full {
             width: 100%;
         }
     }

     .input-text label.error {
         font-size: 12px;
         color: red;
         line-height: initial;
         position: inherit;
         position: relative;
         top: 4px;
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

     }
 </style>

 <div class="wrap">

     <div class="form">
         <form action="./page4.php" method="POST" id="detailsForm" novalidate>
             <!-- <input type="hidden" name="contact_number" value="<?php echo  isset($_SESSION['step1Data']['username']) ? $_SESSION['step1Data']['username'] : ''; ?>"> -->
             <div class="form-step">
                 <h3 class="step">Dirección de envío</h3>
                 <div class="form-row">
                     <label for="">Nombre completo</label>
                     <div class="input-text w-full">
                         <input type="text" name="recipients_name" class="w-full">
                     </div>
                 </div>
                 <div class="form-row">
                     <label for="">Dirección</label>
                     <div class="input-text w-full">
                         <!--                        <select name="country" class="w-full">-->
                         <!--                            <option value="中華人民共和國香港特別行政區">中華人民共和國香港特別行政區</option>-->
                         <!--                            <option value="中華人民共和國">中華人民共和國</option>-->
                         <!--                            <option value="臺灣">臺灣</option>-->
                         <!--                            <option value="澳門">澳門</option>-->
                         <!--                            <option value="other">其他（請輸入）</option>-->
                         <!--                        </select>-->
                         <input type="text" name="country" required class="w-full">
                     </div>
                 </div>
                 <div class="other-country-row"></div>
                 <div class="form-row">
                     <label for="">Estado/Provincia</label>
                     <div class="input-text w-full">
                         <!--                        <select name="idtype" class="w-full">-->
                         <!--                            <option value="香港身份證">香港身份證</option>-->
                         <!--                            <option value="護照">護照</option>-->
                         <!--                        </select>-->
                         <input type="text" name="idtype" class="w-full">
                     </div>
                 </div>
                 <div class="form-row">
                     <label for="">Ciudad</label>
                     <div class="input-text w-full">
                         <input type="text" name="id_number" class="w-full">
                         <!-- <input type="text" name="details_address" class="w-full"> -->
                     </div>
                 </div>
                 <div class="form-row">
                     <label for="">Número De Contacto</label>
                     <div class="input-text w-full">
                         <input type="text" name="contact_number" class="w-full">
                         <!-- <input type="text" name="details_address" class="w-full"> -->
                     </div>
                 </div>

             </div>

             <div class="center"><button class="btn submit-btn" name="submit" type="submit">Continuar</button></div>
         </form>
         <div class="extra-text">
             <h3>Seguridad y privacidad</h3>
             <div class="notice" style="margin-top:0px;font-size:13px;">
                 <p>Mantenemos medidas físicas, técnicas y administrativas estándar de la industria para proteger su información personal.</p>
                 <p></p>
             </div>
         </div>
     </div>


 </div>


 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
 <script>
     //script to check input
     // jQuery('.form-step input').on('input', function() {
     //     let check = true;
     //     jQuery('.form-step input').each(function() {
     //         if (jQuery(this).val() == '') check = false;
     //         console.log(jQuery(this).val());

     //     });
     //     console.log(check);

     //     if (check) jQuery('.btn').removeClass('disabled');
     //     else jQuery('.btn').addClass('disabled')
     // });
     jQuery(document).ready(function() {
         jQuery('select[name=country]').change(function() {
             if (this.value == 'other') {
                 jQuery('.other-country-row').html('<div class="form-row other-country"><label for=""></label><div class="input-text w-full other-country-input"><input type="text" name="other_country" class="w-full"></div></div>');
             } else
                 jQuery('.other-country-row').html();
         })
     });
 </script>

 <script>
     jQuery.extend(jQuery.validator.messages, {
         required: "Compruebe y rellene los datos correctos"
     });
     $("#detailsForm").validate({
         rules: {
             recipients_name: "required",
             country: "required",
             idtype: "required",
             id_number: "required",
             contact_number: "required",
         }
     });
 </script>

 <?php
    include('footer_.php');
