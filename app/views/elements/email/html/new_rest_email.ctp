<style type="text/css">
	body,td { color:#2f2f2f; font:11px/1.35em Verdana, Arial, Helvetica, sans-serif; }
</style>
<table cellspacing="0" cellpadding="0" border="0" width="650">
	<tr><td valign="top" colspan="4">
			<p><b>New restaurants registered at Menu Review. Details about the restaurant is given as below :-</b> </p>
		</td></tr>
    <tr>
    	<td>Name</td><td><?php echo $data['Restaurant']['name'];?></td>
        <td>Username</td><td><?php echo $data['Restaurant']['user_name'];?></td>
     </tr>
    <tr>
    	<td>Phone Number</td><td><?php echo $data['Restaurant']['phone'];?></td>
        <td>Contact Number</td><td><?php echo $data['Restaurant']['contact_phone'];?></td>
     </tr> 
    <tr>
    	<td>Email</td><td><?php echo $data['Restaurant']['email'];?></td>
        <td>Address</td><td><?php echo $data['Restaurant']['address'];?></td>
     </tr> 
      <tr>
        <td>City</td><td><?php echo $data['Restaurant']['city'];?></td>
        <td>State</td><td><?php echo $data['Restaurant']['state'];?></td>
     </tr> 
     <tr>
        <td>Area</td><td><?php echo $data['Restaurant']['area'];?></td>
        <td>Cuisine</td><td><?php echo $data['Restaurant']['cuisine'];?></td>
     </tr>    
    <tr><td colspan="4"><p><b>Thanks<br />Admin</b></p></td></tr>
</table>