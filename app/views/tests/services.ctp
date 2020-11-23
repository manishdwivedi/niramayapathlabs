<?php
/* SVN FILE: $Id: default.thtml 4409 2007-02-02 13:20:59Z phpnut $ */
/**
*
* PHP versions 4 and 5
*
* CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
* Copyright 2005-2007, Cake Software Foundation, Inc.
*								1785 E. Sahara Avenue, Suite 490-204
*								Las Vegas, Nevada 89104
*
* Licensed under The MIT License
* Redistributions of files must retain the above copyright notice.
*
* @filesource
* @copyright		Copyright 2005-2007, Cake Software Foundation, Inc.
* @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
* @package			cake
* @subpackage		cake.cake.libs.view.templates.pages
* @since			CakePHP(tm) v 0.10.0.1076
* @version			$Revision: 4409 $
* @modifiedby		$LastChangedBy: phpnut $
* @lastmodified	$Date: 2007-02-02 07:20:59 -0600 (Fri, 02 Feb 2007) $
* @license			http://www.opensource.org/licenses/mit-license.php The MIT License
*/
?>

<style>
.pagingSerch {
    width: auto;
    height: auto;
    float: right;
    margin: 25px 0 20px 0;
    background: #fafafa;
    padding: 3px;
    border-radius: 35px;
}
.pagingSerch span {
    width:auto !important;
    list-style: none;
    min-width: 20px;
    height: 20px;
    padding:5px;
    color: #666;
    border-radius: 25px;
    text-align: center;
    line-height: 20px !important;
    cursor: pointer;
    margin: 4px !important;
    float: left;
    -webkit-transition: .5s;
    transition: .5s;}
  
.pagingSerch span:hover, .actPg {
   background: #fafafa;
   color: #86d011 !important;}

.backPg, .nextPg {
    width: 25px;
    height: 25px;
    margin: 3px;
    padding: 4px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    display: none;}
  
.nextPg {
    background: url(/img/img/ero-R.png) center no-repeat;
    background-size:30px;
    float:right;
}

.backPg {
    background: url(/img/img/ero-L.png) center no-repeat;
    float:left;
    background-size:30px;
}
</style>
<div class="location_div">
<div class="centring">
<div class="graynavigation gap">
  <ul>
     <li><a href="/"><span itemprop="name">Home</span></a></li>
     <li class="list"> <span>Patientcare Services</span></li>
  </ul>
</div>
<div class="clr divid"></div>
<div class="right2 right"> 
  <ul id="ulpaging">
    <div>
   <?php
		if(isset($testlisting) && count($testlisting) > 0){
			$countTestslist = count($testlisting);
			for($ctr=0;$ctr<$countTestslist;$ctr++){
				$class = "";
				if(($ctr%2) == 1){
					$class = " class=\"alt\"";
				}
			
	?>
	<?php if($testlisting[$ctr]['Test']['status']==1){?>
    <li>
    <div class="greyBox">
      <h3><?php echo $html->link($testlisting[$ctr]['Test']['test_parameter'], array('action'=>'test_detail', $testlisting[$ctr]['Test']['id']  ));?></h3>
      <div class="bot">
        <div class="ReportParameter">
          
          <p title="Code"><i class="fa fa-barcode" aria-hidden="true"></i><?php echo $testlisting[$ctr]['Test']['testcode'];?></p>
          <p title="Name/Description"><i class="fa fa-info-circle" aria-hidden="true"></i><?php echo $testlisting[$ctr]['Test']['test_parameter'];?><br></p>
          <p title="Reporting Time"><i class="fa fa-history" aria-hidden="true"></i><?php echo $testlisting[$ctr]['Test']['reporting'];?></p>
       
        </div>
        <div class="IncludesBorder2">
        <div class="pretestBoxz"></div>
        <div class="phelp"><span><span class="rs">&#8377;</span><?php echo $testlisting[$ctr]['Test']['mrp'];?></span></div>
        
        <div class="LabBtn">
        	<?php echo $html->link('Add to Cart',array('controller'=>'tests','action'=>'my_cart',$testlisting[$ctr]['Test']['id']),array('escape'=>false)); ?></div> 
       
        </div>
    </div>
  </div>
  
</li>
<?php } }  }?>
</div>
</ul>
<?php echo $this->element('pagination_test'); ?>
<div class="clr"></div>
</div>
        
 </div>
</div>
<div class="clr"></div>
    
        
         
      