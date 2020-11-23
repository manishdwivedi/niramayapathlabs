Supply Order Request
Facility Name: <?php echo $data['Page']['facility']?>
Requested By: <?php echo $data['Page']['requested_by']?>
Email Address: <?php echo $data['Page']['email']?>


						Description				Packaging			Qty/Pack			Amount
===========================================================================================
10% Formalin			20 ml					Box					Each			<?php echo $data['Page']['formalin_20ml']?>
						60 ml					Box					Each			<?php echo $data['Page']['formalin_60ml']?>
						90 ml					Box					Each			<?php echo $data['Page']['formalin_90ml']?>
						120 ml					Box					Each			<?php echo $data['Page']['formalin_120ml']?>
						Cube					5 Gal.				Each			<?php echo $data['Page']['formalin_cube']?>
-------------------------------------------------------------------------------------------
Alcohol					Alcohol filled			Bottle				Each			<?php echo $data['Page']['alcohol_slide_carrier']?>
						container for 
						slide transport
-------------------------------------------------------------------------------------------
Plain Specimen			8 oz.										Each			<?php echo $data['Page']['container_8oz']?>
Containers				32 oz										Each			<?php echo $data['Page']['container_32oz']?>
						86 oz										Each			<?php echo $data['Page']['container_86oz']?>
						172 oz										Each			<?php echo $data['Page']['container_172oz']?>
-------------------------------------------------------------------------------------------
Pap Smear kit			Boxed organizer -		Box					36				<?php echo $data['Page']['pap_box_organizer']?>
						1 slide
						SurePath				Box					25				<?php echo $data['Page']['surepath']?>
						blue cap
						ThinPrep				Box					25				<?php echo $data['Page']['thinprep']?>
						white cap
-------------------------------------------------------------------------------------------
FNA's					ThinPrep Cytolyt		Bottle				Each			<?php echo $data['Page']['fna_cytolyt']?>
						Solution 
-------------------------------------------------------------------------------------------
Transport Bags			Extra-large				Pkg.				Each			<?php echo $data['Page']['transport_bags']?>
-------------------------------------------------------------------------------------------   
Biohazard Bags			Medium					Pkg.								<?php echo $data['Page']['biohazard_bags']?>
-------------------------------------------------------------------------------------------
95% Alcohol Container												Each			<?php echo $data['Page']['alcohol_95_percent']?>
-------------------------------------------------------------------------------------------
Cardboard Slide Holder												Each			<?php echo $data['Page']['cardboard_slide_carrier']?>
-------------------------------------------------------------------------------------------
Other: <?php echo $data['Page']['other']?>

===========================================================================================

FORM REQUEST

===========================================================================================
Pap Smear postcard		PF2434					Pkg.				100				<?php echo $data['Page']['postcards']?>
-------------------------------------------------------------------------------------------
Pap Smear requisition							Pkg.				100				<?php echo $data['Page']['pap_reqs']?>
-------------------------------------------------------------------------------------------
Surgical requisition							Pkg.				100				<?php echo $data['Page']['surg_reqs']?>
-------------------------------------------------------------------------------------------
Specimen tracking sheet 1212-126				Pkg.				100				<?php echo $data['Page']['tracking_sheets']?>

===========================================================================================
Notes
<?php echo $data['Page']['notes']?>