

function hideNotification() {
    document.getElementById('notification').style.display = 'none';
}

function showButton() {
    document.getElementById('submitButton').style.display = 'block';
}

function showButton1() {
    document.getElementById('submitButton1').style.display = 'block';
}

function showButton2() {
    document.getElementById('submitButton2').style.display = 'block';
}

/*function openQueBefore1() {
    document.getElementById('secondQuestion').style.display = 'none';
    document.getElementById('beforeQue1').style.display = 'block';
}*/

function hideButton() {
    document.getElementById('submitButton').style.display = 'none';
}

/*function showMail() {
    document.getElementById('showMailDiv').style.display = 'block';
}*/

function nextQuestion() {
    document.getElementById('firstQuestion').style.display = 'none';
    document.getElementById('secondQuestion').style.display = 'block';
}

function toolTip1() {
    document.getElementById('toolTip1').style.display = 'block';
}

function toolTipOut1() {
    document.getElementById('toolTip1').style.display = 'none';
}

function toolTip2() {
    document.getElementById('toolTip2').style.display = 'block';
}

function toolTipOut2() {
    document.getElementById('toolTip2').style.display = 'none';
}

function toolTip3() {
    document.getElementById('toolTip3').style.display = 'block';
}

function toolTipOut3() {
    document.getElementById('toolTip3').style.display = 'none';
}

function toolTip4() {
    document.getElementById('toolTip4').style.display = 'block';
}

function toolTipOut4() {
    document.getElementById('toolTip4').style.display = 'none';
}

function toolTip5() {
    document.getElementById('toolTip5').style.display = 'block';
}

function toolTipOut5() {
    document.getElementById('toolTip5').style.display = 'none';
}

function toolTip6() {
    document.getElementById('toolTip6').style.display = 'block';
}

function toolTipOut6() {
    document.getElementById('toolTip6').style.display = 'none';
}

function toolTip7() {
    document.getElementById('toolTip7').style.display = 'block';
}

function toolTipOut7() {
    document.getElementById('toolTip7').style.display = 'none';
}

function toolTip8() {
    document.getElementById('toolTip8').style.display = 'block';
}

function toolTipOut8() {
    document.getElementById('toolTip8').style.display = 'none';
}

function toolTip9() {
    document.getElementById('toolTip9').style.display = 'block';
}

function toolTipOut9() {
    document.getElementById('toolTip9').style.display = 'none';
}

		jQuery(document).ready(function(){
			jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});

			
			jQuery('#responsive').change(function(){
			  $('#responsive_wrapper').width(jQuery(this).val());
			});
			
		});
/*-------------------------------------------------*/			
(function($) {
    $(document).ready(function() {
  //lazy load of images
        $("img.lazy").lazyload({
            effect: "fadeIn",
            effectspeed: 1000
        });
        });
})(jQuery);
/*-------------------------------------------------*/
	function login_window(val)
{
	if(val == 'customer')
	{
		$('#customerLogin').show();
		$('#partnerLogin').hide();
	}
	if(val == 'partner')
	{
		$('#customerLogin').hide();
		$('#partnerLogin').show();
	}
}
/*-------------------------------------------------*/
	function login_window_footer(val)
	{
		if(val == 'viewreport')
		{
			document.getElementById('ViewReportFooter').style.display = 'block';
			document.getElementById('CustomerFooter').style.display = 'none';
		}
		if(val == 'customer')
		{
			document.getElementById('CustomerFooter').style.display = 'block';
			document.getElementById('ViewReportFooter').style.display = 'none';
		}
	}
/*-------------------------------------------------*/
function validationcc()
{
var str=true;
document.getElementById("msg11").innerHTML="";
document.getElementById("msg12").innerHTML="";
if(document.form3.LoginUsername.value=='Please Enter Email/Phone')
{
	document.getElementById("msg11").innerHTML="Please Enter Email/Phone";
	str=false;
}

if(document.form3.LoginPass.value=='password')
{
	document.getElementById("msg12").innerHTML="Please Enter Password";
	str=false;
}

return str;
}
/*-------------------------------------------------*/

$(document).ready(function(){
  $('#slider1').bxSlider({
});
$('#slider2').bxSlider({
    controls: false,
       mode: 'horizontal', //mode: 'fade',            
            speed: 500,
            auto: true,
            infiniteLoop: true,
            hideControlOnEnd: true,
            useCSS: false

});
});


/*-------------------------------------------------*/
$(window).load(function() {
    
      $("#flexiselDemo3").flexisel({
        visibleItems: 5,
        animationSpeed: 1000,
        autoPlay: true,
        autoPlaySpeed: 1500,            
        pauseOnHover: true,
        enableResponsiveBreakpoints: false,
        responsiveBreakpoints: { 
            portrait: { 
                changePoint:480,
                visibleItems: 1
            }, 
            landscape: { 
                changePoint:640,
                visibleItems: 2
            },
            tablet: { 
                changePoint:768,
                visibleItems: 3
            }
        }
    });
});
	
