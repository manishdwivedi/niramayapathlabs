<script>
function submit_ticket(){
	var healthId = $('#HealthRequestId').val();
	
	$data = $('#form10').serialize();
	var error=0;
	if($("#priority").val() == 'r')
	{
		if($("#TicketFromDate").val() == '')
		{
			$("#ticket_from_date_error").html("From Date cannot be Empty");
			error++;
		}

		if($("#TicketToDate").val() == '')
		{
			$("#ticket_to_date_error").html("To Date Cannot Be Empty");
			error++;
		}
	}
			
	if($("#TicketTickettitle").val() == '')
	{
		$("#tickettitle_error").html("Title cannot be empty");
		error++;
	}
	else
		$("#tickettitle_error").html("");
		
	if($("#TicketConcernRaised").val() == '')
	{
		$("#ticket_concern_error").html("Raised By cannot be empty");
		error++;
	}
	else
		$("#ticket_concern_error").html("");
		
	if($("#TicketEmail").val() == '')
	{
		$("#ticket_email_error").html("Email cannot be empty");
		error++;
	}
	else
		$("#ticket_email_error").html("");
	
	if($("#TicketPhone").val() == '')
	{
		$("#ticket_phone_error").html("Phone Number cannot be empty");
		error++;
	}
	else
		$("#ticket_phone_error").html("");
	
	if($("#TicketDescription").val()=='')
	{
		$("#ticket_description_error").html("description cannot be empty");
		error++;
	}
	else
		$("#ticket_description_error").html("");
	console.log(error);
	if(error==0)
	{
		return true;
	}
	else{
		return false;
	}
}

function check_type()
{
	var type = $('#number_type').val();
	if(type!="")
	{
		$('#TicketRequestId').attr("required",true);
		$('#TicketRequestId').show();
		$('#crosscheck').show();
		$('#crosscheck_error').show();
	}
	else
	{
		$('#TicketRequestId').attr("required",false);
		$('#TicketRequestId').hide();
		$('#crosscheck').hide();
		$('#crosscheck_error').hide();
	}
}

function check_req()
{
	var value = $('#TicketRequestId').val();

	jQuery.ajax({
		type:'GET',
		url:siteUrl+'ticket/cross_check?type=request&value='+value,
		success:function(response){
			console.log(response);
			if(response.message=="success"){
				$('#req_error').css("color","green");
				$('#req_error').html(response.type+" Attached");
				$('#ticketsubmit').show();
			}
			else{
				$('#req_error').css("color","red");
				$('#req_error').html(response.type+" Not Found");
				$('#ticketsubmit').hide();
			}
		},
		dataType:"json"
	});	
}

function check_lab()
{
	var value = $('#TicketLabNo').val();

	jQuery.ajax({
		type:'GET',
		url:siteUrl+'ticket/cross_check?type=lab_no&value='+value,
		success:function(response){
			console.log(response);
			if(response.message=="success"){
				$('#lab_error').css("color","green");
				$('#lab_error').html(response.type+" Attached");
				$('#ticketsubmit').show();
			}
			else{
				$('#lab_error').css("color","red");
				$('#lab_error').html(response.type+" Not Found");
				$('#ticketsubmit').hide();
			}
		},
		dataType:"json"
	});	
}
</script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<style type="text/css">
	.location-search a {
       height: 40px;
    }
    .cartvalue{
    	height: 24px;
    }
    ul.location-list li {
        width: 185px;
    }
    ul.location-list li a {
        padding: 4px 0 5px 11px;
    }
    .table td{
    	border-top: unset; 
    }
    .NewpreviewBox {
	    padding-bottom: unset;
	    border-bottom: unset;
	}
</style>
    <div class="NewpreviewBox">

<div class="webinar_main table-resonsive">

    <?php echo $this->Session->flash(); ?>
	<div>&nbsp;</div>	

	
	<?php echo $form->create(array('url'=>'/pages/save_ticket','id'=>'form10', 'class'=>'form-horizontal orderBox', 'name'=>'form10','enctype'=>'multipart/form-data'));?>
	<h2>Create Task</h2>
  <div class="form-group">
    <label class="control-label col-sm-2">Category<font color="#FF0000">*</font></label>
    <div class="col-sm-10">
            <select id="category" name="data[Ticket][category]" class="form-control" required>
				<option value="">Select a Category</option>
				<?php foreach($category as $key => $val) {?>
					<option value="<?php echo $key;?>"><?php echo $val;?></option>
				<?php }?>
			</select>
    </div>
  </div>



  <div class="form-group">
    <label class="control-label col-sm-2" for="">Request No</label>
    <div class="col-sm-10" style="display: flex;">
            <?php echo $form->text('Ticket.request_id', array('class'=>'input-text form-control','style'=>'width: 40%; margin-right:10px;')); ?>
			<input id="req_check" class="btn btn-primary btn-sm" type="button" style="float: left" onclick="check_req()" value="Attach"/>
			<span id="req_error"></span>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="">Lab No</label>
    <div class="col-sm-10" style="display: flex;">
            <?php echo $form->text('Ticket.lab_no', array('class'=>'input-text form-control','style'=>'width: 40%; margin-right:10px;')); ?>
			<input id="lab_check" class="btn btn-primary btn-sm" type="button" style="float: left" onclick="check_lab()" value="Attach"/>
			<span id="lab_error"></span>
    </div>
  </div>

   <div class="form-group">
    <label class="control-label col-sm-2" for="">Subject<font color="#FF0000">*</font></label>
    <div class="col-sm-10" >
    	<?php echo $form->text('Ticket.tickettitle', array('class'=>'input-text form-control','style'=>'','required')); ?>
					<label id="tickettitle_error" style="color:#FF0000; font-size:12px; clear:both;"></label>
            
    </div>
  </div>


  <div class="form-group">
    <label class="control-label col-sm-2" for="">Description<font color="#FF0000">*</font></label>
    <div class="col-sm-10">
    	<?php echo $form->textarea('Ticket.description', array('class'=>'input-text form-control','rows'=>5,'cols'=>50,'style'=>'font-size:12px;','required')); ?>
					<label id="ticket_description_error" style="color:#FF0000; font-size:12px; clear:both;" ></label>
            
    </div>
  </div>

  <div class="form-group" >
    <label class="control-label col-sm-3" for="">Image Upload<font color="#FF0000">*</font></label>
    <div class="col-sm-9">
    	<?php echo $form->file('Ticket.image_upload',array('class'=>'input-text form-control-file','required'));?>
					<div id="msgReportFile" style="color:#FF0000; font-size:12px; clear:both;"></div>
            
    </div>
  </div>



 
  <div class="form-group text-center">
    <div class="col-sm-12">
    	<span id="ticketprocessing" style="color:Red;display:none;font-size: x-small;">Ticket is Being Raised.</span>
		<span id="ticketcompleted" style="color:Green;display:none;font-size: x-small;">Ticket submitted successfully.</span>
		<input id="ticketsubmit" class="btn btn-primary" type="submit" onclick="return submit_ticket()" value="Submit"/>				
    </div>
  </div>
	
<?php echo $form->end();?>
</div>
</div>&nbsp;