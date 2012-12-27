<?php
/*
Plugin Name: Simple User Profile
Plugin URI: 
Description: Select which inputs to remove from the user profile.  You can remove all options except Username, email, and password in Settings>User Profile by checking the options you don't want displayed. 
Author: Innovative Solutions
Version: 1.2
Author URI: http://www.whereyoursolutionis.com
*/





add_action('admin_menu','Simplr_usr_profiler_menu');




function  Simplr_usr_profiler_menu(){



add_options_page ('Simplify the User Profile Page','User Profile','manage_options','adj-usr-profilr','Simplr_usr_profiler' );
 


}


register_activation_hook( __FILE__, 'userPrfoInitOpts' );

function userPrfoInitOpts(){


add_option('usrprof_personal','Personal Options');
add_option('usrprof_name','Name');
add_option('usrprof_contact','Contact Info ');
add_option('usrprof_about',' About Yourself ');


}



function  Simplr_usr_profiler(){



     if(isset($_POST['setopts'])){
      
      
     //rich_editing, comment_shorcut, admin_bar_front, admin_bar_admin, admin_color
     
     
     
     update_option('usrprof_personal',$_POST['personal']);
     update_option('usrprof_name',$_POST['name']);
     update_option('usrprof_contact',$_POST['contact']);
     update_option('usrprof_about',$_POST['about']);
          
     
     
     update_option('usrprof_toRemove', $_POST['to_remove'] );
     update_option('usrprof_toHigh', $_POST['to_hide'] );
     
   
     
     }


$rem = get_option('usrprof_toRemove');
$toHide= get_option('usrprof_toHigh');


?>

<div class="wrap">




<div style=" float:left;width:400px;" >

<h2>Disable Profile Options</h2>


<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="POST"  enctype="multipart/form-data" >
<table class="form-table">

<thead><tr><th><h4><b>Select Profile fields to disable</b> <span><em style="font-size:9px;font-weight:regular;"> (Leave title fields blank to not show them)</em></span></h4></th></tr></thead> 

<tr> <td> Change Personal  Label to: <input name="personal" value="<?php echo get_option('usrprof_personal');?>" />
<tr><td> <input type="checkbox"  name ="to_remove[]" value="rich_editing"  <?php if(is_array($rem) && in_array('rich_editing',$rem)){echo ' checked="checked" '; }?> />Visual Editor </td></tr>
<tr><td> <input type="checkbox"  name ="to_remove[]" value="admin_color"  <?php if( is_array($rem) && in_array('admin_color',$rem)){echo ' checked="checked" ';} ?> /> Admin Color Scheme</td></tr>
<tr><td> <input type="checkbox"  name= "to_remove[]" value="comment_shortcuts"  <?php if( is_array($rem) && in_array('comment_shortcuts',$rem)){echo ' checked="checked" ';} ?> /> Keyboard Shortcuts</td></tr>
<tr><td> <input type="checkbox"  name ="to_remove[]" value="admin_bar_front"  <?php if( is_array($rem) && in_array('admin_bar_front',$rem)){echo ' checked="checked" '; }?> /> Toolbar</td></tr>
<tr><td>&nbsp;</td></tr>
<tr> <td> Change Name Label to: <input name="name" value="<?php echo get_option('usrprof_name');?>" />
<tr><td> <input type="checkbox"  name ="to_remove[]" value="first_name"  <?php if( is_array($rem) && in_array('first_name',$rem)){echo ' checked="checked" '; }?> /> First Name</td></tr>
<tr><td> <input type="checkbox"  name ="to_remove[]" value="last_name"  <?php if( is_array($rem) && in_array('last_name',$rem)){echo ' checked="checked" '; }?> /> Last Name</td></tr>
<tr><td> <input type="checkbox"  name ="to_hide[]" value="nickname"  <?php if( is_array($toHide) && in_array('nickname',$toHide)){echo ' checked="checked" '; }?> /> Nickname</td></tr>
<tr><td> <input type="checkbox"  name ="to_hide[]" value="display_name"  <?php if( is_array($toHide) && in_array('display_name',$toHide)){echo ' checked="checked" '; }?> /> Display Name</td></tr>


<tr><td>&nbsp;</td></tr>
<tr> <td> Change Contact Info Label to: <input name="contact" value="<?php echo get_option('usrprof_contact');?>" />
<tr><td> <input type="checkbox"  name ="to_remove[]" value="url"  <?php if( is_array($rem) && in_array('url',$rem)){echo ' checked="checked" '; }?> /> website</td></tr>
<tr><td> <input type="checkbox"  name ="to_remove[]" value="aim"  <?php if( is_array($rem) && in_array('aim',$rem)){echo ' checked="checked" '; }?> /> Aim</td></tr>
<tr><td> <input type="checkbox"  name ="to_remove[]" value="jabber"  <?php if( is_array($rem) && in_array('jabber',$rem)){echo ' checked="checked" '; }?> /> Jabber, Google Talk</td></tr>
<tr><td> <input type="checkbox"  name ="to_remove[]" value="yim"  <?php if( is_array($rem) && in_array('yim',$rem)){echo ' checked="checked" '; }?> /> Yahoo IM</td></tr>
<tr><td> <input type="checkbox"  name ="to_remove[]" value="google_profile"  <?php if( is_array($rem) && in_array('google_profile',$rem)){echo ' checked="checked" '; }?> /> Google Profile</td></tr>

<tr><td>&nbsp;</td></tr>
<tr> <td> Change About Yourself Label to: <input name="about" value="<?php echo get_option('usrprof_about');?>" />
<tr><td> <input type="checkbox"  name ="to_remove[]" value="description"  <?php if( is_array($rem) && in_array('description',$rem)){echo ' checked="checked" '; }?> /> Biographical Info </td></tr>

 



</table>

<br />

<input type="submit" value="Save Options" name="setopts" />

</form>


</div>

<div style="float:left;width:250px;margin-left:45px;margin-top:50px;" >
		<table class="widefat">
					<thead><tr><th>Need some code......</th></tr></thead>
					<tr><td style="padding:10px 5px 10px 5px;">
					<p>
					Scriptonite is available for hire.  If you need custom theme functions or plugins why not <a href="http://www.whereyoursolutionis.com/contact-scriptonite/">get a quote</a>?
					
				    </p>
					
					
					</td></tr>
					</table>
					

		<table class="widefat" style="margin-top:20px;">
					<thead><tr><th>Need Help?</th></tr></thead>
					<tr><td style="padding:10px 5px 10px 5px;">
					<p>
					You can find more information on the <a href="http://www.whereyoursolutionis.com/simpler-user-profile/">Simple Profile</a> page.
					
				    </p>
					
					
					</td></tr>
					</table>



</div>


<?php

}


function Simplify_the_user_profile(){


global $pagenow;
		if (( $pagenow == 'profile.php' ) ){ 



$rem = get_option('usrprof_toRemove');
$hd = get_option('usrprof_toHigh');

$persn = get_option('usrprof_personal');
$namer = get_option('usrprof_name');
$contacts = get_option('usrprof_contact');
$aboutr = get_option('usrprof_about');




?>


		<script type="text/javascript">
		jQuery(document).ready(function(jQuery) { 
		
		<?php
		
		if(is_array($rem)){
     		foreach($rem as $t){
     		
     		 echo "jQuery('label[for=\"".$t."\"]').closest('tr').remove();";
     		
     		}
		}

          if(is_array($hd)){		
     		 foreach($hd as $n){
     		
     		 echo "jQuery('label[for=\"".$n."\"]').closest('tr').hide();";
     		
     		}

     }		
		
		?>
		
		var replaced = jQuery("body").html().replace('About Yourself','<?php echo $aboutr; ?>' ).replace('Contact Info','<?php echo $contacts; ?>' ).replace('<h3>Name</h3>','<h3><?php echo $namer; ?></h3>' ).replace('Personal Options','<?php echo $persn; ?>' ) ;

		jQuery("body").html(replaced);
		 
		
		
		 });</script>



<?php

if(is_array($rem) && in_array('admin_color',$rem)){
global $_wp_admin_css_colors;

   $_wp_admin_css_colors = 0;



}





}


}
add_action('admin_head','Simplify_the_user_profile');