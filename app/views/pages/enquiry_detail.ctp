<?php /*payment History */ ?>
<script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
<script>
function print_user_receipt(val1,val2)
{
	window.open('<?php echo SITE_URL;?>tests/print_user_receipt_new/'+val1+'/'+val2,'name','height=500,width=600,scrollbars=yes');
}

function show_more(id)
{
  $('.more').hide();
  $('.hide').hide();
  $('.show').show();
  $('#more_'+id).show();
  $('#hide_'+id).show();
  $('#show_'+id).hide();
}

function hide(id)
{
  $('#more_'+id).hide();
  $('#hide_'+id).hide();
  $('#show_'+id).show();
}
</script>
<div class="article_in_inner">
    <div class="article_in">
       <div class="preview">
        <?php echo $this->Session->flash(); ?>
      <div class="preBox2">Enquiry List</div>
      <div class="pacakgeBox list">
        <table width="100%" cellspacing="0" cellpadding="0" border="0"><thead> 
      	  <tr>
            <td style="width: 0px !important;" valign="middle" align="center" class="yellow2">Ticket Id</td>
            <td valign="middle" align="center" class="yellow2">Date</td>
        		<td valign="middle" align="center" class="yellow2">Request No.</td>
        		<td valign="middle" align="center" class="yellow2">Title</td>
        		<td valign="middle" align="center" class="yellow2">Category</td>
        		<td valign="middle" align="center" class="yellow2">Priority</td>
            <td valign="middle" align="center" class="yellow2">Status</td>
        		<td valign="middle" align="center" class="yellow2">Action</td>
          </tr>

          <?php foreach($ticket_detail as $key => $val) {?>
            <tr>
              <td valign="top" align="center" class="gray2">
              <?php echo $val['Ticket']['ticket_id']; ?>
              </td>
              <td valign="top" align="center" class="gray2">
          	  <?php echo date('d-m-Y',strtotime($val['Ticket']['date'])); ?>
          	  </td>
          	  <td valign="top" align="center" class="gray2"><?php if(!empty($val['Ticket']['request_id'])) { echo $val['Ticket']['request_id'];} else { echo "-";}?></td>
          	  <td valign="top" align="center" class="gray2"><?php echo $val['Ticket']['title'];?></td>
          	  <td valign="top" align="center" class="gray2"><?php echo $category[$val['Ticket']['category']];?></td>
          	  <td valign="top" align="center" class="gray2"><?php echo $priority[$val['Ticket']['priority']];?></td>
              <td valign="top" align="center" class="gray2"><?php echo $status[$val['Ticket']['status']];?></td>
          	  <td valign="top" align="center" class="gray2">
                <a href="#" class="show" id="show_<?php echo $val['Ticket']['id']; ?>" onclick="show_more(<?php echo $val['Ticket']['id']; ?>)">Show More</a>
                <a href="#" class="hide" id="hide_<?php echo $val['Ticket']['id']; ?>" style="display:none"; onclick="hide(<?php echo $val['Ticket']['id']; ?>)">Hide</a> 
              </td>
            </tr>
            <tr id="more_<?php echo $val['Ticket']['id']; ?>" class="more" style="padding-top:20px;padding-bottom:30px;display:none;">
              <td colspan="7">
                <?php echo $form->create(array('id'=>'form'.$val['Ticket']['id'],'name'=>'form'.$val['Ticket']['id'],'enctype'=>'multipart/form-data','method'=>'POST','action'=>'/update_patient_task/'.$val['Ticket']['id']));?>
                <?php echo $form->hidden('Ticket.id',array('value'=>$val['Ticket']['id']));?>
                <?php echo $form->hidden('Ticket.date',array('value'=>$date));?>
                <?php echo $form->hidden('Ticket.assigned_to',array('value'=>$assigned_to));?>
                  <label style="vertical-align: top;">Description</label>
                  <textarea style="padding-left: 20px;margin-left: 20px;width:300px;" name="desc<?php echo $val['Ticket']['id']; ?>" id="desc<?php echo $val['Ticket']['id']; ?>"rows="5"></textarea>
                  <br>
                  <label>Upload Document</label>
                  <?php 
                      echo $form->file('Ticket.doc.'.$key2, array('class'=>'input-text','style'=>'margin-left:10px;width:200px;','required'=>'required')); 
                  ?>
                  <img id="process_img<?php echo $val['Ticket']['id']; ?>" alt="" style="display:none; height:10px;" src="<?php echo SITE_URL;?>img/admin/p_rocess.gif">
                  <label id="success<?php echo $val['Ticket']['id']; ?>" style="color:green"></label>
                  <label id="failure<?php echo $val['Ticket']['id']; ?>" style="color:red"></label>
                  <label style="display:none;margin-left: 50px;" id="counter<?php echo $val['Ticket']['id']; ?>"><span style="color:green;" id="time">5</span>Seconds </label> 
                  <div class="LabBtn">
                    <input type="submit" name="submit" class="btn btn-success submitBtn" value="SUBMIT"/>
                    <!--<a href="#" onclick="submit(<?php echo $val['Ticket']['id']; ?>)">Submit</a>-->
                  </div>
                <?php echo $form->end();?>
              </td>
            </tr>
          <?php }?>
        </thead></table>
      </div>  
    </div>
    </div>
    <div class="clr"></div>  
  </div>
  <div class="clr"></div>
  <br><br>