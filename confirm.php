<?php 

if (session_status() === PHP_SESSION_NONE){
    session_start();
    if (!isset($_COOKIE['session_name()'])) setcookie(session_name(), session_id(), 0, NULL, NULL, 0);
}

require_once($_SERVER['DOCUMENT_ROOT']."/common/monologger.php");
//get_logger()->info('monologger verification', array('Called from' => __FILE__));

require '../vendor/autoload.php';
require_once 'ANetConstants.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

$folder = dirname( __FILE__, 3 ) . '/Logs/ANet';
$logfile = $folder . '/' . date('Y-m') . '.anet.nntx.log' ;
define("AUTHORIZENET_LOG_FILE", $logfile);

$_root  =$_SERVER['DOCUMENT_ROOT'];

require_once($_root."/common/utils.php");
require_once($_root."/common/ezMysql_ntw.php");

require_once($_root."/common/Z_NNTXglobals.php");
require_once($_root."/common/connect_REAL.php");

require_once($_root."/email_groups/email_groups.php");
require_once($_root."/common/email_funcs.php");

//  set to the user defined error handler
//dbine.ntw:  Replaced with monologger.php $old_error_handler=set_error_handler("myErrorHandler");
date_default_timezone_set("America/Los_Angeles");

$sid =trim($_POST['sid']) ;

// get incoming via POST
// $visitorArgs
$visitor_Args=array();
// personal
$visitor_Args['sid']     =trim($_POST['sid']);
$visitor_Args['fname']   =ucfirst(strtolower(trim($_POST['FN']))) ;
$visitor_Args['lname']   =ucfirst(strtolower(trim($_POST['LN']))) ;
$visitor_Args['addr']    =trim($_POST['ADDR']);
$visitor_Args['addr2']   =trim($_POST['addr2']);
$visitor_Args['city']    =trim($_POST['CTY']);
$visitor_Args['state']   =trim($_POST['ST']);
$visitor_Args['zip']     =trim($_POST['ZIP']);
$visitor_Args['email']   =trim($_POST['EM']);
$visitor_Args['visitor_details']="Y";
// charge stuff
/// modification to accomodate Radio Buttons for Extra Donation  SAVE!!!
if (isset($_POST["donateRadioGroup"])):
    if ($_POST["donateRadioGroup"] == 'other'):
        $visitor_Args['contrib'] = $_POST['CONAMT'];
    else:
        $visitor_Args['contrib'] = $_POST["donateRadioGroup"];
    endif;
else:
    $visitor_Args['contrib'] = 0;
endif;
$visitor_Args['cc_name']   = $_POST['CNAME'];
$visitor_Args['cc_number'] = $_POST['CN'];
$visitor_Args['cc_type']   = strtoupper($_POST['CT']);
$visitor_Args['cc_last5']  = substr($_POST['CN'], -4); // changed to last 4
$visitor_Args['cc_month']  = $_POST['CD1'];
$visitor_Args['cc_year']   = $_POST['CD2'];
$visitor_Args['cc_cvv']    = trim($_POST['CVV']);

// NNT SKA stuff
if ( $_POST["corpGroup"] == "1"  ) :
 $corp_card = 1;
 $visitor_Args['corp_card']    =$corp_card ;
 $visitor_Args['occupation']   =NULL;
 $visitor_Args['employer']     =NULL;
 $visitor_Args['corp_name']    =trim($_POST['NCORP']);
 $visitor_Args['corp_address'] =trim($_POST['ACORP']);
 $visitor_Args['corp_city']    =trim($_POST['CCORP']);
 $visitor_Args['corp_state']   =trim($_POST['SCORP']);
 $visitor_Args['corp_zip']     =trim($_POST['ZCORP']); 
else:
 $corp_card = 0 ;
 $visitor_Args['corp_card']    =$corp_card ;
 $visitor_Args['occupation']   =trim($_POST['OCUP']);
 $visitor_Args['employer']     =trim($_POST['EMPL']);
 $visitor_Args['corp_name']    =NULL;
 $visitor_Args['corp_address'] =NULL;
 $visitor_Args['corp_city']    =NULL;
 $visitor_Args['corp_state']   =NULL;
 $visitor_Args['corp_zip']     =NULL; 
endif ;

setlocale(LC_MONETARY, 'en_US');
$to_charge = '$ ' . sprintf("%01.2f", $visitor_Args['contrib'] ) ;


/// tracer
hjtaorgLog( 'Stage 01 ' , "Confirm form $sid" , __FILE__ . ' Line: ' . __LINE__ , "NNTX");

////////////////// END 


$PAGE_TITLE = "No New Taxes | Howard Jarvis Taxpayers Association";
$HEADER_TITLE = "No New Taxes Committee: Secure Online Donation Form";

ob_start();

include('../global/ui-components/header.php');
?>


<div class="siteorigin-widget-tinymce textwidget">

        <!-- WORK AREA -->
		<form name = "confirm_charge_form" action="complete.php" method="post" onsubmit="return process(this)">
		<fieldset id="totals" name="totals">
					<div id="totals-wrap">
						<h2 class="pageTitle confirm">Please Confirm</h2>
						<h3 style="padding-bottom:6px;">Your card will be charged the following:</h3>
						<strong id="totals-label"><span><?php echo( $to_charge ) ; ?></span> <span class="tLabel">Donation</span></strong>
						<p class="warning"><span class="important">IMPORTANT:</span><br/>Authorizing might take 30 seconds.<br/>Please press "Confirm" <u>ONLY</u> once.</p>
					</div>
				</fieldset>

        <fieldset id="buttons" name="buttons">
        <input type="hidden" id="sid"        name="sid"        value="<?php echo $visitor_Args['sid'] ?>">
        <input type="hidden" id="fname"      name="fname"      value="<?php echo $visitor_Args['fname'] ?>">
        <input type="hidden" id="lname"      name="lname"      value="<?php echo $visitor_Args['lname'] ?>">
        <input type="hidden" id="addr"       name="addr"       value="<?php echo $visitor_Args['addr'] ?>">
        <input type="hidden" id="addr2"      name="addr2"      value="<?php echo $visitor_Args['addr2'] ?>">
        <input type="hidden" id="city"       name="city"       value="<?php echo $visitor_Args['city'] ?>">
        <input type="hidden" id="state"      name="state"      value="<?php echo $visitor_Args['state'] ?>">
        <input type="hidden" id="zip"        name="zip"        value="<?php echo $visitor_Args['zip'] ?>">
        <input type="hidden" id="email"      name="email"      value="<?php echo $visitor_Args['email'] ?>">
        <input type="hidden" id="cc_name"    name="cc_name"    value="<?php echo $visitor_Args['cc_name'] ?>">
        <input type="hidden" id="cc_number"  name="cc_number"  value="<?php echo $visitor_Args['cc_number'] ?>">
        <input type="hidden" id="cc_type"    name="cc_type"    value="<?php echo $visitor_Args['cc_type'] ?>">
        <input type="hidden" id="cc_last5"   name="cc_last5"   value="<?php echo $visitor_Args['cc_last5'] ?>">
        <input type="hidden" id="cc_month"   name="cc_month"   value="<?php echo $visitor_Args['cc_month'] ?>">
        <input type="hidden" id="cc_year"    name="cc_year"    value="<?php echo $visitor_Args['cc_year'] ?>">
        <input type="hidden" id="cc_cvv"     name="cc_cvv"     value="<?php echo $visitor_Args['cc_cvv']  ?>">
        <input type="hidden" id="contrib"    name="contrib"    value="<?php echo $visitor_Args['contrib'] ?>">
        <input type="hidden" id="occupation" name="occupation" value="<?php echo $visitor_Args['occupation'] ?>">        
        <input type="hidden" id="employer"   name="employer"   value="<?php echo $visitor_Args['employer'] ?>">          
        <!-- expanded NNTX only fields -->
        <input type="hidden" id="corp_card"    name="corp_card"     value="<?php echo $visitor_Args['corp_card'] ?>">        
        <input type="hidden" id="corp_name"    name="corp_name"     value="<?php echo $visitor_Args['corp_name'] ?>">        
        <input type="hidden" id="corp_address" name="corp_address"  value="<?php echo $visitor_Args['corp_address'] ?>">        
        <input type="hidden" id="corp_city"    name="corp_city"     value="<?php echo $visitor_Args['corp_city'] ?>">        
        <input type="hidden" id="corp_state"   name="corp_state"    value="<?php echo $visitor_Args['corp_state'] ?>">        
        <input type="hidden" id="corp_zip"     name="corp_zip"      value="<?php echo $visitor_Args['corp_zip'] ?>">        
         <!-- buttons -->
		<input id="donation-submit" name="submit" value="Confirm" type="submit" />
		<!-- ver 3 removed <input class="gradient" name="cancel" value= "Cancel" type="reset" /> -->
		
		</fieldset>
        </form>
        <!-- END WORK AREA -->
 
			

		</div>
<!-- end form -->
<?php include('../global/ui-components/footer.php'); ?>

<?php ob_flush(); ?>
<!-- 2014 Project Z -->
