<?php //echo "<pre>gdfgdfgdf"; print_r($userdetail); exit;?>
<style type="text/css">
.submit {
float:left;
margin:10px 10px 0px 0px;
}
.innercontainer_bottom_right_row2{
padding:0;
}
</style>
<script type="text/javascript">
function listing(){
window.location.href=siteUrl+"members/register";
return false;
}


</script>

<!--bodycontainer div start here-->

<div class="bodycontainer">

	<div class="bodycontainer_inner"> 
    
    <!--Artist page div start here--> 
    
    	<div class="innercontainer">
        
        	<div class="innercontainer_top">
            	<h1><?php //echo ucwords($userdetail['Member']['name']);?></h1>
            </div>
            
            <div class="innercontainer_bottom">
            	<div class="innercontainer_bottom_left">
                	<?php echo $this->element('artistuser');?>
                </div>
                <div class="innercontainer_bottom_right">
                
                	
                    
                    <div class="innercontainer_bottom_right_row2">
                    	<div class="innercontainer_bottom_right_row2_top">
                        	<div class="innercontainer_bottom_right_row2_top_left" style="width:196px;">
                            	<h1><?php echo $data[0]['Pagelocale']['title'];?></h1>
                            </div>
                            <div class="innercontainer_bottom_right_row2_top_right">
                            	&nbsp;
                            </div>
                        </div>
                        <div class="innercontainer_bottom_right_row2_bottom">
							<p>
<?php echo $data[0]['Pagelocale']['content'];?></p>

                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
            
        </div>
     
    <!--Artist page div end here-->
    
    </div>
    
</div>

<!--bodycontainer div end   here-->