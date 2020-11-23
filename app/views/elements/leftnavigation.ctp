<style type="text/css">
	ul.navigation li.active_link a{
		background: url("img/bg_navigation_selected.png") no-repeat scroll -1px 0 transparent;
		border: medium none;border-bottom: 1px solid #758826;
		border-top: 1px solid #E2EEB2;
		text-decoration: none;
		text-shadow: 1px 1px 1px #0D2C35;  padding: 10px;
		position: relative;
		width: 226px;
		z-index: 2;
	} 
</style>
<div id="leftside">
    	<div class="user">
        	<?php echo $html->image('avatar.png', array('width'=>'44', 'class' => 'hoverimg')); ?>
        	<?php 
			$usertype = $this->Session->read('Admin.userType');
			
			if($usertype == 'A') {
			?>
			<p>Logged in as:</p>
            <p class="username"><?php echo $this->Session->read('Admin.userName') ;?></p>
			<?php
			}
			if($usertype == 'Agent') {
			?>
			<p>Logged in as:</p>
            <p class="username"><?php echo $this->Session->read('Admin.userName') ;?></p>
			<?php 
			}
			if($usertype != 'A' && $usertype != 'BM' && $usertype != 'Agent' && $usertype != 'Home' && $usertype != '' && $usertype != 'DA') { 
			?>
			<p>Logged in as:</p>
            <p class="username"><?php echo ucfirst($usertype).' Admin';?></p>
			<?php
			}
			if($usertype == 'Home') {
			?>
			<p>Logged in as:</p>
            <p class="username"><?php echo 'Home Collection Admin';?></p>
			<?php 
			}
			if($usertype == '') 
			{
			?>
			<p>Logged in as:</p>
            <p class="username"><?php echo 'Agent';?></p>
			<?php 
			}
			if($usertype == 'BM') 
			{
			?>
			<p>Logged in as:</p>
            <p class="username"><?php echo $this->Session->read('Admin.userName') ;?></p>
			<?php 
			}
			if($usertype == 'DA') 
			{
			?>
            <p>Logged in as:</p>
            <p class="username"><?php echo $this->Session->read('Admin.userName') ;?></p>
			<?php }?>
            
			
            <p class="userbtn"><?php echo $html->link("Logout", "/admin/admins/logout", array("title"=>"Logout")); ?></p>
        </div>
        <ul id="nav">
			<?php 
				$tag_action = array('admin_index','admin_edit','admin_add','admin_changepassword');
	 			$tag_controller = array('pages');
			?>
			<?php if($usertype == 'A') {?>
			<li>
              	<a href="javascript:void(0)" class="expanded heading">Requests</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/samples/add_request/'); ?>" title="Add New Test" class="active_link">New Request</a></li>
                    <li><a href="<?php echo $html->url('/admin/samples/index/'); ?>" title="View Test List" class="active_link">Request List</a></li>
                    <li><?php e($html->link('Sync Report',SITE_URL.'home/update_patient_report?type=manual',array('escape'=>false,'target'=>'_blank'))); ?></li>
                </ul>
            </li>
			<li>
              	<a href="javascript:void(0);" class="expanded heading">Frontend Users</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/samples/view_front_user'); ?>" title="View Frontend Users" class="active_link">View Users List</a></li>
                </ul>
            </li>
			<li>
              	<a href="javascript:void(0);" class="expanded heading">MIS Reports</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/samples/sales_report'); ?>" title="Sales Report" class="active_link">Sales Report</a></li>
					<li><a href="<?php echo $html->url('/admin/samples/product_sale_report'); ?>" title="Product Sales Report" class="active_link">Product Sales Report</a></li>
					<li><a href="<?php echo $html->url('/admin/samples/daily_collection_report'); ?>" title="Daily Collection Report" class="active_link">Daily Collection Report</a></li>
					<li><a href="<?php echo $html->url('/admin/samples/user_daily_collection_report'); ?>" title="User Daily Collection Report" class="active_link">User Collection Report</a></li>
					<li><a href="<?php echo $html->url('/admin/samples/user_collection_deposit_list'); ?>" title="Daily Collection Deposit List" class="active_link">Daily Deposit List</a></li>
					<li><a href="<?php echo $html->url('/admin/samples/all_deposit_list'); ?>" title="All Collection Deposit List" class="active_link">All Deposit List</a></li>
				</ul>
            </li>
            <li>
              	<a href="javascript:void(0);" class="expanded heading">Order Upload</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/excelupload'); ?>" title="Order Excel Upload" class="active_link">Order Excel Upload</a></li>
                </ul>
            </li>
			<?php }?>
			<?php if($usertype == '') {?>
			<li>
              	<a href="javascript:void(0)" class="expanded heading">Password</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/admins/agent_change/'); ?>" title="Change Password" class="active_link">Change Password</a></li>	          
                </ul>
            </li>
			<?php } else {?>
			<li>
              	<a href="javascript:void(0)" class="expanded heading">Password</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/admins/changepassword/'); ?>" title="Change Password" class="active_link">Change Password</a></li>	          
                </ul>
            </li>
			<?php }?>
			
			<!-- FOR BM ADMIN STARTS -->
			<?php if($usertype == 'BM') {?>
			<li>
              	<a href="javascript:void(0)" class="expanded heading">Requests</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/samples/add_request/'); ?>" title="Add New Test" class="active_link">New Request</a></li>
                    <li><a href="<?php echo $html->url('/admin/samples/index/'); ?>" title="View Test List" class="active_link">Request List</a></li>
                    <li><?php e($html->link('Sync Report',SITE_URL.'home/update_patient_report?type=manual',array('escape'=>false,'target'=>'_blank'))); ?></li>                    
                </ul>
            </li>
			<li>
              	<a href="javascript:void(0);" class="expanded heading">Frontend Users</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/samples/view_front_user'); ?>" title="Add Agent" class="active_link">View Users List</a></li>
                </ul>
            </li>
			<li>
              	<a href="javascript:void(0);" class="expanded heading">MIS Reports</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/samples/sales_report'); ?>" title="Sales Report" class="active_link">Sales Report</a></li>
					<li><a href="<?php echo $html->url('/admin/samples/product_sale_report'); ?>" title="Product Sales Report" class="active_link">Product Sales Report</a></li>
					<li><a href="<?php echo $html->url('/admin/samples/daily_collection_report'); ?>" title="Daily Collection Report" class="active_link">Daily Collection Report</a></li>
					<li><a href="<?php echo $html->url('/admin/samples/user_daily_collection_report'); ?>" title="User Daily Collection Report" class="active_link">User Collection Report</a></li>
					<li><a href="<?php echo $html->url('/admin/samples/user_collection_deposit_list'); ?>" title="Daily Collection Deposit List" class="active_link">Daily Deposit List</a></li>
                </ul>
            </li>
            <li>
              	<a href="javascript:void(0);" class="expanded heading">Order Upload</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/excelupload'); ?>" title="Order Excel Upload" class="active_link">Order Excel Upload</a></li>
                </ul>
            </li>
			<?php }?>
			<!-- FOR BM ADMIN ENDS -->
			
			<!-- FOR SUPER ADMIN STARTS -->
			<?php if($usertype == 'A') {?>
			<li>
				<a href="javascript:void(0)" class="expanded heading">Content Pages</a>
				<ul class="navigation">
					<li><a href="<?php echo $html->url('/admin/pages/index'); ?>" title="List/Add/Edit/Activate/Deactivate/Delete pages" class="active_link">Page List</a></li>	          		</ul>
			</li>
			
			
			<li>
              	<a href="javascript:void(0)" class="expanded heading">Test Master</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/tests/add_test/'); ?>" title="Add New Test" class="active_link">Add New Test</a></li>
					<li><a href="<?php echo $html->url('/admin/tests/index/'); ?>" title="View Test List" class="active_link">View Test List</a></li>	          
                </ul>
            </li>
			
			<li>
              	<a href="javascript:void(0)" class="expanded heading">Profile Master</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/profiles/add_profile/'); ?>" title="Add New Profile" class="active_link">Add Profile</a></li>
					<li><a href="<?php echo $html->url('/admin/profiles/index/'); ?>" title="View Test Profile" class="active_link">View Profile List</a></li>	          
                </ul>
            </li>
			
			<li>
              	<a href="javascript:void(0)" class="expanded heading">Patient Care Services</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/tests/add_service/'); ?>" title="Add New Services" class="active_link">Add Services</a></li>
					<li><a href="<?php echo $html->url('/admin/tests/view_service/'); ?>" title="View Services List" class="active_link">View Services List</a></li>	          
                </ul>
            </li>
			
			<li>
              	<a href="javascript:void(0)" class="expanded heading">PCC Panel</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/samples/add_pcc/'); ?>" title="Add New PCC" class="active_link">Add PCC</a></li>
					<li><a href="<?php echo $html->url('/admin/samples/view_pcc/'); ?>" title="View PCC List" class="active_link">PCC List</a></li>	          
                </ul>
            </li>
			
			<li>
              	<a href="javascript:void(0)" class="expanded heading">Users Panel</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/samples/add_user/'); ?>" title="Create New Users" class="active_link">Create New User</a></li>
					<li><a href="<?php echo $html->url('/admin/samples/view_user/'); ?>" title="View Users List" class="active_link">View Users List</a></li>	          
                </ul>
            </li>
			
			<li>
              	<a href="javascript:void(0);" class="expanded heading">Agents</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/samples/add_agent'); ?>" title="Add Agent" class="active_link">Add Agent</a></li>	          			
					<li><a href="<?php echo $html->url('/admin/samples/view_agent'); ?>" title="View Agents List" class="active_link">View Agent List</a></li>
                </ul>
            </li>
			
			<li>
              	<a href="javascript:void(0)" class="expanded heading">Banners</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/banners/add/'); ?>" title="Add Banner" class="active_link">Add Banner</a></li>
					<li><a href="<?php echo $html->url('/admin/banners/index/'); ?>" title="View Banner List" class="active_link">View Banner List</a></li>	          
                </ul>
            </li>
			<?php }?>
			<!-- FOR SUPER ADMIN ENDS -->
			
			
			
			
			
			
			
			
			<!-- FOR HELPDESK STARTS -->
			<?php if($usertype == 'Agent') {?>
			<li>
              	<a href="javascript:void(0);" class="expanded heading">Requests</a>
                <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/samples/add_request/'); ?>" title="Add New Test" class="active_link">New Request</a></li>
					<li><a href="<?php echo $html->url('/admin/samples/agent_view_list/'); ?>" title="Booked Request" class="active_link">Booked Request</a></li>
				</ul>
            </li>
			
			<!--<li>
              	<a href="javascript:void(0);" class="expanded heading">Frontend Users</a>
                 <ul class="navigation">
                    <li><a href="<?php //echo $html->url('/admin/samples/view_front_user_help'); ?>" title="Add Agent" class="active_link">View Users List</a></li>
                </ul>
            </li>-->
			<li>
              	<a href="javascript:void(0);" class="expanded heading">Frontend Users</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/samples/view_front_user'); ?>" title="Add Agent" class="active_link">View Users List</a></li>
                </ul>
            </li>
			<li>
              	<a href="javascript:void(0);" class="expanded heading">MIS Reports</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/samples/sales_report'); ?>" title="Add Agent" class="active_link">Sales Report</a></li>
					<li><a href="<?php echo $html->url('/admin/samples/daily_collection_report'); ?>" title="Add Agent" class="active_link">Daily Collection Report</a></li>
                </ul>
            </li>
			<?php }?>
			<!-- FOR HELPDESK ENDS -->
			
			
			
			
			
			
			
			
			
			<!-- FOR PCC STARTS -->
			<?php if($usertype != 'A' && $usertype != 'BM' && $usertype != 'Agent' && $usertype != 'Home' && $usertype != '' && $usertype != 'DA') {?>
			<li>
              	<a href="javascript:void(0);" class="expanded heading">Requests</a>
                 <ul class="navigation">
				 	<li><a href="<?php echo $html->url('/admin/samples/add_request/'); ?>" title="Add New Test" class="active_link">New Request</a></li>
                    <li><a href="<?php echo $html->url('/admin/samples/home/'.base64_encode($this->Session->read('Admin.userValue'))); ?>" title="View Test List" class="active_link">Request List</a></li>	          
                </ul>
            </li>
			<li>
              	<a href="javascript:void(0);" class="expanded heading">Frontend Users</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/samples/view_front_user'); ?>" title="Add Agent" class="active_link">View Users List</a></li>
                </ul>
            </li>
			<li>
              	<a href="javascript:void(0);" class="expanded heading">MIS Reports</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/samples/sales_report'); ?>" title="Sales Report" class="active_link">Sales Report</a></li>
					<li><a href="<?php echo $html->url('/admin/samples/product_sale_report'); ?>" title="Product Sales Report" class="active_link">Product Sales Report</a></li>
					<li><a href="<?php echo $html->url('/admin/samples/daily_collection_report'); ?>" title="Daily Collection Report" class="active_link">Daily Collection Report</a></li>
					<li><a href="<?php echo $html->url('/admin/samples/user_daily_collection_report'); ?>" title="User Daily Collection Report" class="active_link">User Collection Report</a></li>
					<li><a href="<?php echo $html->url('/admin/samples/user_collection_deposit_list'); ?>" title="Daily Collection Deposit List" class="active_link">Daily Deposit List</a></li>
                </ul>
            </li>
			<?php }?>
			
			
			
			<?php //if($usertype == 'Home') {?>
			<!--<li>
              	<a href="javascript:void(0);" class="expanded heading">Agents</a>
                 <ul class="navigation">
                    <li><a href="<?php //echo $html->url('/admin/samples/add_agent'); ?>" title="Add Agent" class="active_link">Add Agent</a></li>	          			
					<li><a href="<?php //echo $html->url('/admin/samples/view_agent'); ?>" title="View Agents List" class="active_link">View Agent List</a></li>
                </ul>
            </li>
			
			<li>
              	<a href="javascript:void(0);" class="expanded heading">Requests</a>
                 <ul class="navigation">
                    <li><a href="<?php //echo $html->url('/admin/samples/home/'.base64_encode($this->Session->read('Admin.userValue')).'/New'); ?>" title="New Request" class="active_link">New</a></li>
					<li><a href="<?php //echo $html->url('/admin/samples/home/'.base64_encode($this->Session->read('Admin.userValue')).'/Assign'); ?>" title="Assigned Request" class="active_link">Assigned to Agent</a></li>
					<li><a href="<?php //echo $html->url('/admin/samples/home/'.base64_encode($this->Session->read('Admin.userValue')).'/Process'); ?>" title="New Request" class="active_link">In Process</a></li>
                </ul>
            </li>-->
			<?php //}?>
			<!-- FOR PCC ENDS -->
			
			
			
			<!-- FOR AGENT STARTS -->
			 <?php if($usertype == '') {?>
			 <li>
              	<a href="javascript:void(0);" class="expanded heading">Requests</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/samples/agent_page'); ?>" title="Assigned Request" class="active_link">Assigned Requests</a></li>
                </ul>
            </li>
			<li>
              	<a href="javascript:void(0);" class="expanded heading">MIS Reports</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/samples/sales_report'); ?>" title="Add Agent" class="active_link">Sales Report</a></li>
					<li><a href="<?php echo $html->url('/admin/samples/product_sale_report'); ?>" title="Add Agent" class="active_link">Product Sales Report</a></li>
                </ul>
            </li>
			 <?php }?>
			 <!-- FOR AGENT ENDS -->
			
			 <!-- FOR DOCTOR ADMIN STARTS -->
			<?php if($usertype == 'DA') {?>
			<li>
              	<a href="javascript:void(0);" class="expanded heading">Doctors Panel</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/pages/view_doctor'); ?>" title="View Doctors List" class="active_link">View Doctors List</a></li>
					<li><a href="<?php echo $html->url('/admin/pages/view_verify_doctor'); ?>" title="Verified Doctors List" class="active_link">Verified Doctors List</a></li>
					<li><a href="<?php echo $html->url('/admin/pages/view_featured_doctor'); ?>" title="Featured Doctors List" class="active_link">Featured Doctors List</a></li>
					<li><a href="<?php echo $html->url('/admin/pages/appoint_activate'); ?>" title="Appointment Activation" class="active_link">Appointment Activation</a></li>
                </ul>
            </li>
			<li>
              	<a href="javascript:void(0);" class="expanded heading">Appointments</a>
                <ul class="navigation">
                	<li><a href="<?php echo $html->url('/admin/pages/view_doctor_appoint_clinic'); ?>" title="View Appointments" class="active_link">View Appointments</a></li>
				</ul>
            </li>
			<li>
              	<a href="javascript:void(0);" class="expanded heading">Blackout Time Slot</a>
                 <ul class="navigation">
                    <li><a href="<?php echo $html->url('/admin/pages/blackout'); ?>" title="View Appointments" class="active_link">Blackout Time Slot</a></li>
                </ul>
            </li>
			<?php }?>
			<!-- FOR DOCTOR ADMIN ENDS -->
			
			<li>
				<a href="javascript:void(0)" class="expanded heading">Ticket Management</a>
              <ul class="navigation">
                  <li><?php e($html->link('Issue Ticket',array('controller'=>'ticket','action'=>'index','admin'=>true),array('escape'=>false))); ?></li>
			  </ul>
			</li>
			

			

			<?php 
				$tag_action = array('admin_index','admin_edit','admin_add');
	 			$tag_controller = array('fabrics');
			?>
			</ul>
</div>
