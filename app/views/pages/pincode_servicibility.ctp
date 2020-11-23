<?php ?>
<script>
	function check_pincode()
	{
		var pin = $('#pincode').val();
		if(pin.length==6)
		{
			$('#pincodedetail').html('<img src="/img/frontend/loading.gif" width="40" height="40"/>');
			document.getElementById("msg11").innerHTML="";
			jQuery.ajax({
				type:'GET',
				url:siteUrl+'pages/check_pincode?pin='+pin,
				success: function(response) {
					console.log(response);
					var html = "<h3 style='color:#a6d263'>Pincode Detail</h3><hr><label>Pincode Servicibility : "+response.result+"</label><br>";
					html = html+"<label>Pincode : "+response.pincode+"</label><br>";
					html = html+"<label>City : "+response.city+"</label><br>";
					html = html+"<label>State : "+response.state+"</label><br><hr>";
					$('#pincodedetail').html(html);
				},
				 dataType:"json"
			});
			
		}
		else{
			document.getElementById("msg11").innerHTML="Please Enter valid Pincode";
		}
	}
</script>
<div class="location_div CurrentOpenings">
	<div class="centring">
		<div class="graynavigation gap">
		  <ul>
		     <li><a href="/"><span itemprop="name">Home</span></a></li>
		     <li class="list"> <span>Pincode Servicibility</span></li>
		  </ul>
		</div>
		<div class="sliderOpening"> <img src="/img/img/pincode.png" alt="Pincode Servicibility" class="list"></div>
		<div class="clr"></div><br>
		<div class="clr divid"></div>
		<div style="/*text-align: center;*/"><br>  
		    <label >Pincode</label>
			<input style="height: 30px;font-size: 16px;"  id="pincode" name="pincode" type="number" value="" maxlength="6" class="field1" placeholder="Pincode" required onkeyup="check_pincode();" />
			<div id="pincodedetail" style="padding-top:20px;/*width: 361px;padding-top: 20px;padding-left: 39%;text-align: initial;*/"></div>
			<div id="msg11" style="color:#FF0000; font-size:12px;"></div>
		</div>
		<div>
			<h3 style="margin-top:15px;"> Servicable City</h3>
			<hr>
			<p style="margin-top:10px;">Following is the List of Servicable Cities:- <p>
				<?php foreach($servicable_city as $val) { ?>
					<li style="width: 180px;float: left;margin-top: 15px;"><?php echo  $val['c']['name'];?></li>
				<?php } ?> 
		</div>      
	</div>
</div>
<div class="clr"></div>
<br><br><br>