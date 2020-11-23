<?php ?>
<style>
  .confirmDiv {
    border: none;
    background: #a0d64a;
    margin-left: 5px;
    color: #000;
    cursor: pointer;
    display: block;
    float: left;
    font-size: 16px;
    font-weight: 400;
    height: 46px;
    line-height: 46px;
    text-align: center;
    width: 210px;
    text-decoration: none;
    font-family: 'Open Sans', sans-serif;
    font-size: 16px;
  }
  .d-column {
    margin:0px !important;
    height: 40px;
  }
  .d-row {
    margin:0px !important; 
    height: 40px;
  }
  .d-column li {
    padding: 5px;
    display: inline-block;
    height: 30px;
  }

  .d-row li {
    padding: 5px;
    display: inline-block;
    height: 30px;
  }
  
  .small{
    width: 50px;
  }

  .medium {
    width: 200px;
  }
  .large {
    width: 350px;
  }
</style>
<script type="text/javascript">
function show_tab(val)
{
	if(val == 'sample')
	{
		document.getElementById('SampleRequest').style.display = 'block';
	}
	
	if(val == 'loggedout')
	{
		window.location.href = siteUrl+'tests/logout';
	}
}
</script>
<div class="location_div">
  <div class="centring">
    <div class="graynavigation gap">
      <ul>
         <li><a href="/"><span>Home</span></a></li>
         <li class="list"> <span>Personal Details</span></li>
      </ul>
    </div>
    <div class="clr"></div>
    <div class="teamDoctors">
      <div class="doctorImg"><img src="/img/img/userdum.jpg"></div>
      <div class="doctorHeading">	
      	<h2><?php echo ucwords($member_detail['User']['first_name'].' '.$member_detail['User']['last_name']);?></h2>
          <h3>
            <p>Contact Number : <?php echo $member_detail['User']['contact'];?></p>
            <p>Email ID : <?php echo $member_detail['User']['email'];?></p>
          </h3>
      </div>

      <div class="clr"></div>
      <?php echo $form->create(null, array('url'=>'/tests/manage_subuser','id'=>'form1','name'=>'form1')); ?>
        <input type="hidden" name="id" value="<?php echo $member_detail['User']['id'];?>"/>
        <div id="menuFooterRecent" class="d-table" style="border-style: solid;border-width: thin;">
          <ul class="d-column" style="background:#a0d64a;">
            <li class="small">S No.</li>
            <li class="large">Name</li>
            <li class="small">Age</li>
            <li class="medium">Contact</li>
            <li class="medium">Status</li>
          </ul>
          <?php $count=1;
          foreach($sub_user as $key=>$val){?>
            <ul class="d-row" style="<?php if($count%2==0) echo 'background:lightgrey;'?>">
              <li class="small"><?php echo $count; ?></li>
              <li class="large"><?php echo $val['User']['name']; ?></li>
              <li class="small"><?php echo $val['User']['age']; ?></li>
              <li class="medium"><?php echo $val['User']['contact']; ?></li>
              <li class="medium">
                <select name="data[<?php echo $val['User']['id'];?>][relation]" id="UserRelation" class="input-text" required style="width:200px;height:30px;">
                  <option value="">Select Relation</option>
                  <?php foreach($relation as $r_key => $r_val) {?>
                    <option value="<?php echo $r_key;?>" <?php if($r_key==$val['User']['relation']) echo "selected"; ?>><?php echo $r_val;?></option>
                  <?php }?>
                </select>
              </li>
            </ul>
          <?php $count++;}?>
        </div>
        <br>
        <div>
          <?php echo $form->submit('Save', array('div'=>false, 'class' => 'confirmDiv','id'=>'save')); ?>
        </div>
      <?php echo $form->end(); ?>
    </div>   
  </div>
</div>
<div class="clr"></div><br>