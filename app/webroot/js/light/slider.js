
<!--DocuSafe Forgot Security Code:Start-->
  $(function() {
            function launch() {
                 $('signup-Div').lightbox_me({centered: true, onLoad: function() { $('#signup-Div').find('input:first').focus()}});
            }
            
            $('#try-1').click(function(e) {
                $("#signup-Div").lightbox_me({centered: true, onLoad: function() {
					$("#signup-Div").find("input:first").focus();
				}});
				
                e.preventDefault();
            });
 $('table tr:nth-child(even)').addClass('stripe');
        });
<!--DocuSafe Forgot Security Code:End-->