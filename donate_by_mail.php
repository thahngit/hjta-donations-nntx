<?php  


$_root = $_SERVER['DOCUMENT_ROOT'];

  // REAL vs FAKE setup
  $whereami = trim(getcwd()) ;
  if ( strtoupper(substr($whereami,-5)) == '_FAKE'  ) :
//     require_once($_root."/DataReply/HJTA_SUBDOM/common/Z_NNTXglobals_FAKE.php");
//     require_once($_root."/DataReply/HJTA_SUBDOM/common/connect_FAKE.php");
     require_once($_root."/common/Z_NNTXglobals_FAKE.php");
     require_once($_root."/common/connect_FAKE.php");
  else :
//      require_once($_root."/DataReply/HJTA_SUBDOM/common/NNTXglobals.php");
//      require_once($_root."/DataReply/HJTA_SUBDOM/common/connect.php");
      require_once($_root."/common/NNTXglobals.php");
      require_once($_root."/common/connect.php");
  endif ;

?>


<html>
<head>
	<title>No New Taxes Mail-in Donation Form | Howard Jarvis Taxpayers Association</title>
</head>
<body topmargin="20" leftmargin="20" marginheight="20" marginwidth="20" style="font-family:Courier New;">
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NQP3DX"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NQP3DX');</script>
<!-- End Google Tag Manager -->

	<table cellspacing="0" cellpadding="0" width="469" border="0">
		<tbody>
			<tr>
				<td width="100%" style="font-family: 'Courier New', Courier, sans-serif; font-size: 14px;">
					<h1 style="font-family: Arial, Helvetica, sans-serif; color: #000066; font-size:24px; line-height: 18px;">No New Taxes Mail-in Donation Form</h1>
					<p style="font-family:Arial,Helvetica;">Thank you for your interest in contributing to the No New Taxes Committee, a project of the Howard Jarvis Taxpayers Association.  Your contribution will help to defeat proposed tax increases for all Californians.</p>
					<p style="font-family:Arial,Helvetica;"><br>
					<strong>Donor Information:</strong></p>
					<p>Name:__________________________________________</p>
					<p>Address:_______________________________________ <br />
					<span style="font-size: 86%"><strong>(P.O. box addresses are not permitted.)</strong></span></p>
					<p>City:_________________ State:____ Zip:_________</p>
					<p>Phone:_______________________________(optional)</p>
					<p>E-Mail:______________________________(optional)</p>
					<p>Occupation:____________________________________</p>
					<p>Name of Employer:______________________________<br />
					<span style="font-size: 80%">(If self-employed, please print name of business in <em>Name of Employer</em> space above. If retired, please print "none." Thank you.)</span></p>
					<p style="font-size: 16px; font-weight: bold;">Please make your checks payable to "No New Taxes."</p>
					<p><strong>Amount Enclosed:</strong>
					<br><br>
					Donation Amount:
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					$_________</p>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<strong>CHECK TOTAL </strong>&nbsp; $_________</p>
					<p style="font-size: 16px; font-weight: bold;">Please make your checks payable to "No New Taxes."</p>
					<p>Thanks again for your support. Every dollar and every vote counts in the fight to protect taxpayers.</p>
					<p>Paid for by the No New Taxes Committee, a project of the Howard Jarvis Taxpayers Association. (ID #922117)</p>
					<p style="font-family:Arial,Helvetica;"><strong>Please Mail To:</strong></p>
					<p>No New Taxes Committee<br>
					Howard Jarvis Taxpayers Association<br>
					621 South Westmoreland Avenue, Suite 200<br>
					Los Angeles, CA 90005</p>
					<p style="font-family:Arial,Helvetica;"><br>* Contributions are not tax deductible for federal income tax purposes.</p>
				</td>
			</tr>
		</tbody>
	</table>

</body>
</html>
