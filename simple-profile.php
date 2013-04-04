<?php
/*
Plugin Name: Simple User Profile
Plugin URI: 
Description: Select which inputs to remove from the user profile.  You can remove all options except Username, email, and password in User>Simplify Profile by checking the options you don't want displayed. 
Author: Innovative Solutions
Version: 1.9
Author URI: http://www.whereyoursolutionis.com
*/





add_action('admin_menu','Simplr_usr_profiler_menu');




function  Simplr_usr_profiler_menu(){



add_users_page ('Simplify the User Profile Page','Simplify Profile','manage_options','adj-usr-profilr-usr','Simplr_usr_profiler' );
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
	 
	 
     update_option('simple_profile_default_uncheck_bar', $_POST['def_bar'] );
     update_option('simple_profile_show_front', $_POST['page_id'] );
     
     update_option('simple_profile_on_edit',$_POST['onAdmin']);
     
     }


$rem = get_option('usrprof_toRemove');
$toHide= get_option('usrprof_toHigh');
$disBar = get_option('simple_profile_default_uncheck_bar');

?>

<div class="wrap">




<div style=" float:left;width:400px;" >

<h2>Disable Profile Options</h2>


<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="POST"  enctype="multipart/form-data" >
<table class="form-table">

<thead><tr><th><h4><b>Select Profile fields to disable</b> <span><em style="font-size:9px;font-weight:regular;"> (Leave title fields blank to not show them)</em></span></h4></th></tr></thead> 

<tr> <td> Change Personal  Label to: <input name="personal" value="<?php echo get_option('usrprof_personal');?>" /></td></tr>
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
<tr> <td> Change Contact Info Label to: <input name="contact" value="<?php echo get_option('usrprof_contact');?>" /></td></tr>
<tr><td> <input type="checkbox"  name ="to_remove[]" value="url"  <?php if( is_array($rem) && in_array('url',$rem)){echo ' checked="checked" '; }?> /> Website</td></tr>


<?php
foreach (_wp_get_user_contactmethods() as $name => $desc) {

?>



<tr><td> <input type="checkbox"  name ="to_remove[]" value="<?php echo $name; ?>"  <?php if( is_array($rem) && in_array($name,$rem)){echo ' checked="checked" '; }?> /><?php echo apply_filters('user_'.$name.'_label', $desc); ?> </td></tr>

<?php
}
?>
<tr><td>&nbsp;</td></tr>
<tr> <td> Change About Yourself Label to: <input name="about" value="<?php echo get_option('usrprof_about');?>" /></td></tr>
<tr><td> <input type="checkbox"  name ="to_remove[]" value="description"  <?php if( is_array($rem) && in_array('description',$rem)){echo ' checked="checked" '; }?> /> Biographical Info </td></tr>

 



</table>

<br />


<h2>Other Options</h2>
<?php
$IsA = get_option('simple_profile_on_edit');
?>
<br />
Apply to Front Page:<br />
<?php wp_dropdown_pages( array('name' => 'page_id','selected'=> get_option('simple_profile_show_front'),'show_option_none'=>'-- No Page --' ) );  ?>

<br /> 
<br />
<input type="checkbox" name="def_bar" value="yes" <?php if($disBar=='yes'){echo ' checked="checked" ';}?>> Disable admin bar in users profile on registration 

<br />
<br />
<input type="checkbox" value="yes" <?php if ($IsA=='yes'){echo ' checked ';} ?> name="onAdmin" />Show on Admin Edit Page<br />

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

		UserProfileSetPageDisplay();

		}

		
		$ifOadmin = get_option('simple_profile_on_edit');
		
		if (( $pagenow == 'user-edit.php' && $ifOadmin=='yes') ){

		UserProfileSetPageDisplay();

		}

		
		
		

}
add_action('admin_head','Simplify_the_user_profile');




function Simplify_the_user_profile_frontend(){
global $post;

$t = get_option('simple_profile_show_front');

	if($t==$post->ID){
	UserProfileSetPageDisplay();
	}

}
add_action('wp_head','Simplify_the_user_profile_frontend');



add_action('user_register','simple_profile_default_uncheck_bar');
function simple_profile_default_uncheck_bar($user_ID) {
		if(get_option('simple_profile_default_uncheck_bar')=='yes'){
			update_user_meta( $user_ID, 'show_admin_bar_front', 'false' );
		}
	}






function UserProfileSetPageDisplay(){

 



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





