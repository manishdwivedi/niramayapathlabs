<script type="text/javascript">
$(document).ready(function(){
     $("#profitSharingUpdate").submit(function(){
        
    });

    //validate number only
    $(".numberOnly").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
   
</script>
<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Profit Sharing Configuration ( <?php echo $lab_data['Lab']['pcc_name']; ?>)</h2>
    </div>
    <div class="contentbox">
        <?php echo $this->Session->flash(); ?>
        <?php echo $html->link('Home', '/admin/admins/index', array('title'=>'Home')); ?>&nbsp;&#187;&nbsp;Profilt Sharing Configuration
	<div>&nbsp;</div>
	<?php echo $form->create('profit_conf', array('url'=>array('controller'=>'profit_sharing','action'=>'save_profit_conf'),'id'=>'profitSharingUpdate','name'=>'formreport')); ?>
            <?php echo $form->hidden('ProfitShareConf.id',array()); ?>
            <?php echo $form->hidden('ProfitShareConf.lab_id',array('value'=>$pcc_id)); ?>
            <table border="0" cellspacing="2" cellpadding="0" align="center" width="100%">
                <tr>
                    <td>Category</td>
                    <td>Booked By</td>
                    <td>Service By</td>
                </tr>
                <?php foreach(Configure::read('Profit.Category') as $key=>$value) { ?>
                <tr>
                    <td><?php echo $value['title']."(".$value['desc'].")"; ?> </td>
                    <td><?php echo $form->text('ProfitShareConf.bb_'.$value['title'],array('class'=>'numberOnly','maxlength'=>2)); ?>%</td>
                    <td><?php echo $form->text('ProfitShareConf.sb_'.$value['title'],array('class'=>'numberOnly','maxlength'=>2)); ?>%</td>
                </tr>
                <?php } ?>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>
                        <?php echo $form->submit("Save",array('class'=>'btn','div'=>false)); ?>
                        <?php echo $html->link("Back",array('controller'=>'profit_sharing','action'=>'index','admin'=>true),array('escape'=>false,'class'=>'btn','style'=>'color:#fff;text-decoration:none;')); ?>
                    </td>
                </tr>
            </table>
        <?php echo $form->end(); ?>
    </div>
</div>