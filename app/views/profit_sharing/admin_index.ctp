<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Business Partner Discount Configuration </h2>
    </div>
    <div class="contentbox">
        <?php echo $this->Session->flash(); ?>
        <?php echo $html->link('Home', '/admin/admins/index', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Business Partner Discount Configuration 
	<div>&nbsp;</div>

        <table width="100%" cellspacing="2" cellpadding="0" border="0" align="center">
	<thead>
            <tr>
                <th width="5%" style="text-align:center;"><h4>S.No.</h4></th>
                <th><h4>PCC Name</h4></th>
                <th><h4>PPC Code</h4></th>
                <th><h4>Contact</h4></th>
                <th><h4>PCC Email</h4></th>
                <th style="text-align:center;"><h4>Action</h4></th>
            </tr>
	</thead>
	<tbody>
            <?php $counter=1; foreach($data as $key=>$value) { ?>
                <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo $value['Lab']['pcc_name']; ?> </td>
                    <td><?php echo $value['Lab']['pcc_lab_name']; ?> </td>
                    <td><?php echo $value['Lab']['pcc_contact']; ?> </td>
                    <td><?php echo $value['Lab']['pcc_email']; ?> </td>
                    <td><?php echo $html->link('Update',array('controller'=>'profit_sharing','action'=>'save_profit_conf',base64_encode($value['Lab']['id']),'admin'=>true),array('escape'=>false)); ?> </td>
                </tr>
            <?php } ?>
        </tbody>
        </table>
    </div>
</div>