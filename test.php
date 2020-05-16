<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Project List</title>
<script type="text/javascript" src="bower_components/jquery/jquery.min.js"></script>
<style type="text/css">
	.containter { background: #FFFFFF; }
	.containter .headder { background: #F1F1F1; width: 90%; margin: 5px auto; padding: 5px; text-align: center; }
	.containter .headder h2 { font-size: 22px; color: #8C0002; text-shadow: 0px 0px 5px #FF0004; font-family:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif }
</style>
<script>
	$(document).ready(function() {
		var max_fields			= 10;	// maximum input boxes allowed
		var wrapper				= $(".input_fields_wrap"); // Files wrapper
		var add_button			= $(".add_field_button");	// Add button ID
		
		var x = 1;	// initial text box count
		$(add_button).click(function(e){ // on add input button click
			e.preventDefault();
			if(x < max_fields){ // max input box allowed
				x++;	// text box increment
				$(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field"> Remove</a></div>'); // add input box
			}
		});
		
		$(wrapper).on("click",".remove_field", function(e){ // user click on remove text
			e.preventDefault(); $(this).parent('div').remove(); x--;
		})
    });
</script>
</head>

<body>
	<div class="containter">
    <?php echo $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true)); 
    echo '<br />';
    $password = 'password';
    echo $password = hash('sha512', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86' . $random_salt);
    ?>
    	<!--<div class="headder">
    	<h2> Details of Project <span>( Project Name )</span> which is of <span>( Organization )</span> </h2>
    	</div>
        
        <h2> Budget of projects </h2>
        
        <table style="width: 100%; border: 1px solid #B3B3B3;">
        	<tr style="border: 1px solid #009BFF; background-color: #009BFF; height: 30px; color: #FFFFFF;">
            	<th> Project id </th>
                <th> Project Title </th>
                <th> Description </th>
                <th> Start Date </th>
                <th> End Date </th>
                <th> Budget </th>
            </tr>
            
            <tr>
            	<td> 1 </td>
                <td> Test Project </td>
                <td style="width:500px;"> This is some test description. This is some test description. This is some test description. This is some test description. This is some test description. This is some test description. This is some test description. This is some test description. This is some test description. </td>
                <td> 2015/02/01 </td>
                <td> 2015/04/01 </td>
                <td> $203112 </td>
            </tr>
        </table>
        
        <div class="content">
        	<table class="table" cellpadding="2" cellspacing="2">
            <tr>
            	<td colspan="2"> #ID - Project Title </td>
                <td colspan="2"> Start Date - End Date </td>
            </tr>
            <tr>
            	<td style="background-color: #00FFFB;"> Client Name </td> <td>&nbsp;  </td>
                <td> Client Phone </td> <td>&nbsp;  </td>
            </tr>
            <tr>
            	<td> Cost in USD </td> <td>&nbsp;  </td>
                <td> Department </td> <td>&nbsp;  </td>
            </tr>
            <tr>
            	<td> Completed </td> <td>&nbsp;  </td>
                <td> Taxation </td> <td>&nbsp;  </td>
            </tr>
            <tr>
            	<td> Sub-Contructor </td> <td>&nbsp;  </td>
                <td> Unit </td> <td>&nbsp;  </td>
            </tr>
            <tr>
            	<td> ASSC Employee </td> <td>&nbsp;  </td>
                <td> Invoice AFs </td> <td>&nbsp;  </td>
            </tr>
            <tr>
            	<td> Invoice USD </td> <td>&nbsp;  </td>
                <td> Rate </td> <td>&nbsp;  </td>
            </tr>
            <tr>
            	<td> Recived Date </td> <td>&nbsp;  </td>
                <td> Total Amount Spent </td> <td>&nbsp;  </td>
            </tr>
            <tr>
            	<td> Total Amount Shared </td> <td>&nbsp;  </td>
                <td> Net Profit USD </td> <td>&nbsp;  </td>
            </tr>
            <tr>
            	<td> Net Profit AFs </td> <td>&nbsp;  </td>
            </tr>
            <tr>
            	<td colspan="4"> <p> Description of Activities </p> 
                <p> This is some text . This is some text . This is some text . This is some text . This is some text . This is some text . This is some text . This is some text . This is some text . This is some text . </p> </td>
            </tr>
            </table>
        </div>
-->    
	<div style="border: 1px solid #1F1F1F; padding:5px; background-color:#606060; color:#ffffff;">
    	<table border="1" width="100%" cellpadding="0" cellspacing="0">
        	<caption> Vendors </caption>        	
            <tr style="background-color:#5f6eeb;">
                <th> Vendor ID </th>
                <th> Name </th>
                <th> Address </th>
                <th> Profile </th>
            </tr>
            <tr>
            	
            	<td> 1 </td>
                <td> Naim Faizy </td>
                <td> Kabul - Afghanistan </td>
                <td> kas;dkj a;sldkfkj as;ldkjfa;slkd f;aslkdjf;alskdjf;alskd jf;alksdjf ;alskdjfasdfa;slkdjf asjlakdsjf as;dkjfa sdl;kfjasd;lf ajsd;lkfjas;d f </td>
            </tr>
        </table> <br />
        <table width="50%" border="1" cellpadding="0" cellspacing="0">
        	<caption> Products </caption>
            <tr style="background-color:#5f6eeb;">
            	<th> ID </th>
                <th> Name </th>
                <th> POC </th>
                <th> Email </th>
                <th> Phone </th>
                <th> Skype </th>
            </tr>
            <tr>
            	<td> 1 </td>
                <td> Oracle </td>
                <td> Naim </td>
                <td> mnaimfaizy@yahoo.com </td>
                <td> 0783928129 </td>
                <td> mnaimfaizy </td>
            </tr>
        </table>
        
        <table width="50%" border="1" cellpadding="0" cellspacing="0">
        	<caption> Contact Person </caption>
            <tr style="background-color:#5f6eeb;">
            	<th> ID </th>
                <th> Name </th>
                <th> Phone </th>
                <th> Email </th>
                <th> Skype </th>
                <th> Viber </th>
            </tr>
            <tr>
            	<td> 1 </td>
                <td> Naim </td>
                <td> 0789291291 </td>
                <td> mnaimfaizy@yahoo.com </td>
                <td> 0783928129 </td>
                <td> mnaimfaizy </td>
            </tr>
        </table>
    </div>
	<div class="input_fields_wrap">
    	<button class="add_field_button"> Add More Fields</button>
        <div> <input type="text" name="mytext[]"></div>
    </div>
</div>
</body>
</html>