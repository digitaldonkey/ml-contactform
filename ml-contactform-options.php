<style type='text/css'>
  .disabled{ color: #999; }
</style>
<script type='text/javascript'>
  jQuery(document).ready(function(){
    jQuery('#mlcf_recaptcha_enabled').bind('change', function(){
      
      if( jQuery(this).attr('checked') ){
        jQuery('#mlcf_recaptcha_public, #mlcf_recaptcha_private').attr('disabled', false).removeClass('disabled');
        jQuery('.mlcf_recaptcha_class_enabled').toggleClass('disabled');  
      }
      else{
        jQuery('#mlcf_recaptcha_public, #mlcf_recaptcha_private').attr('disabled', true).addClass('disabled');
        jQuery('.mlcf_recaptcha_class_enabled').toggleClass('disabled');  
      }
    });
    
    jQuery('#submitform').click(function(){
      /* recaptcha validation */
      if ( jQuery('#mlcf_recaptcha_enabled').attr('checked') ){
          if ( jQuery('#mlcf_recaptcha_public').val().length < 8 || jQuery('#mlcf_recaptcha_private').val().length < 8 ){            
              jQuery('#mlcf_recaptcha_public, #mlcf_recaptcha_private').css('border', '1px solid red');
              alert('Please check you public and private key or Disable recaptcha support. Each should have at least 8 digits');
              return false;
          }     
      }
  });
});
</script>
<?php

/*Lets add some default options if they don't exist*/
add_option('mlcf_delete_options', true, 'mlcf'); // by default the text strings will be deleted on Plugin deactivation.
add_option('mlcf_email', 'you@example.com', 'mlcf');
add_option('mlcf_subject', '[:en]English email from yourdomain.com[:de]Deutsche e-Mail von yourdomain.com', 'mlcf');
add_option('mlcf_email_from', 'contactform@yourdomain.com', 'mlcf');
add_option('mlcf_success_message','[:en]Thank you! <br />email successfully sent[:de]Vielen Dank<br />e-Mail erfolgreich versandt', 'mlcf');
add_option('mlcf_error_message', '[:en]<span class="error">Please fill in the required fields</span>[:de]<span class="error">Bitte füllen Sie alle notwendigen Felder aus</span>', 'mlcf');
add_option('mlcf_error_wrong_mail', '[:en]<span class="error">Please check your email</span>[:de]<span class="error">Bitte überprüfen Sie ihre e-Mail Adresse</span>', 'mlcf');
add_option('mlcf_field_name', '[:en]Name * [:de]Name * ', 'mlcf');
add_option('mlcf_field_email', '[:en]Your e-mail * [:de] e-Mail * ', 'mlcf');
add_option('mlcf_field_subject', '[:en]Subject[:de]Betreff', 'mlcf');
add_option('mlcf_field_www', '[:en]Your website [:de]Ihre Website ', 'mlcf');
add_option('mlcf_field_message', '[:en]Your message:[:de]Nachricht:', 'mlcf');
add_option('mlcf_field_required', '[:en]* Please fill in the required fields[:de]* Bitte füllen Sie alle benötigten Felder aus', 'mlcf');
add_option('mlcf_field_submit', '[:en]Submit[:de]Senden', 'mlcf');

add_option('mlcf_recaptcha_enabled', false, 'mlcf');
add_option('mlcf_recaptcha_private', '6Le-tcQSAAAAAF0zyxYijsjUOL3AnSJaLmN-IEw-', 'mlcf');
add_option('mlcf_recaptcha_public', '6Le-tcQSAAAAADDyIpTh9wP8to_4HHeSMkp6KNTN', 'mlcf');
add_option('mlcf_recaptcha_error_msg', '<span class="error">'."[:en]The reCAPTCHA wasn't entered correctly. Please try again</span>[:de]".'<span class="error">'."Das Captcha stimmt nicht.", 'mlcf');

/*check form submission and update options*/
if ('process' == $_POST['stage'])
{
  update_option('mlcf_email', $_POST['mlcf_email']);
  update_option('mlcf_subject', $_POST['mlcf_subject']);
  update_option('mlcf_email_from', $_POST['mlcf_email_from']);
  update_option('mlcf_success_message', $_POST['mlcf_success_message']);
  update_option('mlcf_error_message', $_POST['mlcf_error_message']);
  update_option('mlcf_error_wrong_mail', $_POST['mlcf_error_wrong_mail']);
  update_option('mlcf_field_name', $_POST['mlcf_field_name']);
  update_option('mlcf_field_email', $_POST['mlcf_field_email']);
  update_option('mlcf_field_subject', $_POST['mlcf_field_subject']);
  update_option('mlcf_field_www', $_POST['mlcf_field_www']);
  update_option('mlcf_field_message', $_POST['mlcf_field_message']);
  update_option('mlcf_field_required', $_POST['mlcf_field_required']);
  update_option('mlcf_field_submit', $_POST['mlcf_field_submit']);
  update_option('mlcf_recaptcha_enabled', $_POST['mlcf_recaptcha_enabled']);
  update_option('mlcf_recaptcha_private', $_POST['mlcf_recaptcha_private']);
  update_option('mlcf_recaptcha_public', $_POST['mlcf_recaptcha_public']);
  update_option('mlcf_recaptcha_error_msg', $_POST['mlcf_recaptcha_error_msg']);
  update_option('mlcf_delete_options', $_POST['mlcf_delete_options']);
}

/*Get options for form fields*/
$mlcf_email = stripslashes(get_option('mlcf_email'));
$mlcf_subject = stripslashes(get_option('mlcf_subject'));
$mlcf_email_from = stripslashes(get_option('mlcf_email_from'));
$mlcf_success_message = stripslashes(get_option('mlcf_success_message'));
$mlcf_error_message = stripslashes(get_option('mlcf_error_message'));
$mlcf_error_wrong_mail = stripslashes(get_option('mlcf_error_wrong_mail'));
$mlcf_field_name = stripslashes(get_option('mlcf_field_name'));
$mlcf_field_email = stripslashes(get_option('mlcf_field_email'));
$mlcf_field_subject = stripslashes(get_option('mlcf_field_subject'));
$mlcf_field_www = stripslashes(get_option('mlcf_field_www'));
$mlcf_field_message = stripslashes(get_option('mlcf_field_message'));
$mlcf_field_required = stripslashes(get_option('mlcf_field_required'));
$mlcf_field_submit = stripslashes(get_option('mlcf_field_submit'));

if ( get_option('mlcf_recaptcha_enabled') ){

  $mlcf_recaptcha_enabled = ' value="true" checked="checked"';
  $mlcf_recaptcha_class_enabled ='mlcf_recaptcha_class_enabled';
  $mlcf_recaptcha_error_msg =get_option('mlcf_recaptcha_error_msg');
}else{
  $mlcf_recaptcha_enabled = 'value="false"';
  $mlcf_recaptcha_input_enabled = ' disabled="disabled" ';
  $mlcf_recaptcha_class_enabled = 'mlcf_recaptcha_class_enabled disabled';
}

$mlcf_recaptcha_private = stripslashes(get_option('mlcf_recaptcha_private'));
$mlcf_recaptcha_public = stripslashes(get_option('mlcf_recaptcha_public'));

$mlcf_delete_options = get_option('mlcf_delete_options') ? ' value="true" checked="checked"' : 'value="false"';
?>

<div class="wrap clear">
  <h2><?php _e('Contact Form Options', 'mlcf') ?></h2>
  <form name="form1" method="post" action="#">
	<input type="hidden" name="stage" value="process" />
	
  <h3><?php _e('Contact email', 'mlcf') ?></h3>
  <fieldset>
    <table class="form-table">
      <tr>
        <th scope="row"><label><?php _e('E-mail Address:', 'mlcf') ?></label></th>
        <td><input name="mlcf_email" type="text" id="mlcf_email" value="<?php echo $mlcf_email; ?>" size="40" />
        <br />
<?php _e('This address is where the email will be sent to.', 'mlcf') ?></td>
      </tr>
      <tr>
        <th scope="row"><?php _e('From e-mail Address:', 'mlcf') ?></th>
        <td><input name="mlcf_email_from" type="text" id="mlcf_email_from" value="<?php echo $mlcf_email_from; ?>" size="40" />
        <br />
<?php _e('This address will be shown in the From Field in the mails you recive via mailform.', 'mlcf') ?></td>
      </tr>
      <tr>
        <th scope="row"><?php _e('Subject Suffix:', 'mlcf') ?></th>
        <td><input name="mlcf_subject" type="text" id="mlcf_subject" value="<?php echo $mlcf_subject; ?>" size="50" />
        <br />
<?php _e('This will be prepended to subject of the mailform subject.', 'mlcf') ?></td>
      </tr>
     </table>
</fieldset>

  <h3><?php _e('Messages', 'mlcf') ?></h3>
	<fieldset class="options">

    <table class="form-table">
		  
		  <tr>
        <th scope="row"><?php _e('Success Message:', 'mlcf') ?></th>
        <td>
            <textarea name="mlcf_success_message" id="mlcf_success_message" style="width: 80%;" rows="2" cols="50"><?php echo $mlcf_success_message; ?></textarea>
            <br />
            <?php _e('When the form is sucessfully submitted, this is the message the user will see.', 'mlcf') ?>
        </td>
		  </tr>
		  <tr>
        <th scope="row"><?php _e('Error Message:', 'mlcf') ?></th>
			  <td>
			    <textarea name="mlcf_error_message" id="mlcf_error_message" style="width: 80%;" rows="2" cols="50"><?php echo $mlcf_error_message; ?></textarea>
      			<br />
          	<?php _e('If the user skips a required field, this is the message he will see.', 'mlcf') ?> <br />
          	<?php _e('You can apply CSS to this text by wrapping it in <code>&lt;p style="[your CSS here]"&gt; &lt;/p&gt;</code>.', 'mlcf') ?>
          	<br />
          	<?php _e('ie. <code>&lt;p style="color:red;"&gt;Please fill in the required fields.&lt;/p&gt;</code>.', 'mlcf') ?>
        </td>
		  </tr>
      <tr>
			<th scope="row"><?php _e('Wrong email Adress Message:', 'mlcf') ?></th>
			<td>
			  <textarea name="mlcf_error_wrong_mail" id="mlcf_error_wrong_mail" style="width: 80%;" rows="2" cols="50"><?php echo $mlcf_error_wrong_mail; ?></textarea>
  			<br />
	      <?php _e('If the user enters a invalid email adress.', 'mlcf') ?>
	      <br />
  	    </td>
		  </tr>
	  </table>
	</fieldset>


  <h3><?php _e('Formfield-Legends', 'mlcf') ?></h3>
	<fieldset class="options">
    <table class="form-table">
		  <tr>
			<th scope="row"><?php _e('Name:', 'mlcf') ?></th>
			<td><textarea name="mlcf_field_name" id="mlcf_field_name" style="width: 80%;" rows="2" cols="50"><?php echo $mlcf_field_name; ?></textarea>
			</td>
		  </tr>
		  <tr>
			<th scope="row"><?php _e('Email:', 'mlcf') ?></th>
			<td><textarea name="mlcf_field_email" id="mlcf_field_email" style="width: 80%;" rows="2" cols="50"><?php echo $mlcf_field_email; ?></textarea>
			</td>
		  </tr>
      <tr>
			<th scope="row"><?php _e('Subject:', 'mlcf') ?></th>
			<td><textarea name="mlcf_field_subject" id="mlcf_field_subject" style="width: 80%;" rows="2" cols="50"><?php echo $mlcf_field_subject; ?></textarea>
			</td>
		  </tr>		  <tr>
			<th scope="row"><?php _e('www:', 'mlcf') ?></th>
			<td><textarea name="mlcf_field_www" id="mlcf_field_www" style="width: 80%;" rows="2" cols="50"><?php echo $mlcf_field_www; ?></textarea>
			</td>
		  </tr>
		  <tr>
			<th scope="row"><?php _e('Message:', 'mlcf') ?></th>
			<td><textarea name="mlcf_field_message" id="mlcf_field_message" style="width: 80%;" rows="2" cols="50"><?php echo $mlcf_field_message; ?></textarea>
			</td>
		  </tr>
		  <tr>
			<th scope="row"><?php _e('Required:', 'mlcf') ?></th>
			<td><textarea name="mlcf_field_required" id="mlcf_field_required" style="width: 80%;" rows="2" cols="50"><?php echo $mlcf_field_required; ?></textarea>
			</td>
		  </tr>
      <tr>
			<th scope="row"><?php _e('Submit:', 'mlcf') ?></th>
			<td><textarea name="mlcf_field_submit" id="mlcf_field_submit" style="width: 80%;" rows="1" cols="20"><?php echo $mlcf_field_submit; ?></textarea>
			</td>
		  </tr>
		</table>
	</fieldset>
	
<fieldset class="options">
  <h3><?php _e('Recaptute Support', 'mlcf') ?></h3>
    <input name="mlcf_recaptcha_enabled" type="checkbox" id="mlcf_recaptcha_enabled" <?php echo $mlcf_recaptcha_enabled; ?>  />
    <label for="mlcf_recaptcha_enabled"><?php _e('Enable recaptcha Support', 'mlcf') ?></label>
    <p>You have to sign up a free Key at <a href="http://www.google.com/recaptcha" title="" target="_blank">recaptcha</a>.</p>
    <div id="recaptcha">
      <p class="<?php echo $mlcf_recaptcha_class_enabled ?>" ><?php _e('recaptcha Public Key', 'mlcf') ?><br />
      <input name="mlcf_recaptcha_public" type="text" id="mlcf_recaptcha_public" <?php echo $mlcf_recaptcha_input_enabled ?> value="<?php echo $mlcf_recaptcha_public; ?>" size="40" />
      </p>
      <p class="<?php echo $mlcf_recaptcha_class_enabled ?>"  ><?php _e('recaptcha Private Key', 'mlcf') ?><br />
      <input name="mlcf_recaptcha_private" type="text" id="mlcf_recaptcha_private" <?php echo $mlcf_recaptcha_input_enabled ?>  value="<?php echo $mlcf_recaptcha_private; ?>" size="40" />
      </p>
      <p class="<?php echo $mlcf_recaptcha_class_enabled ?>"  ><?php _e('Recaptcha Error Message', 'mlcf') ?><br />
      <input name="mlcf_recaptcha_error_msg" type="text" id="mlcf_recaptcha_error_msg" <?php echo $mlcf_recaptcha_input_enabled ?>  value="<?php echo $mlcf_recaptcha_error_msg; ?>" size="40" />
      </p>
    </div>
</fieldset>

<fieldset class="options">
  <h3><?php _e('Keep Options ?', 'mlcf') ?></h3>
    <input name="mlcf_delete_options" type="checkbox" id="mlcf_delete_options" <?php echo $mlcf_delete_options; ?>  />
    <label for="mlcf_delete_options"><?php _e('Delete all Options on Plugin Deactivation', 'mlcf') ?></label>
</fieldset>

<fieldset class="options">
  <p class="submit">
    <input id="submitform" type="submit" name="Submit" value="<?php _e('Update Options', 'mlcf') ?> &raquo;" />
  </p>
</fieldset>

<br />
<fieldset class="options">
  <h3><?php _e('Usage', 'mlcf') ?></h3>
  <p>Add the following in any post or page using Editors HTML-View:</p>
    <pre style="font-weight: bold; background: #efefef; border: 1px dashed #444; padding: 1em 1em 1em 2em; width: 40%;">&lt;!--contact form--&gt;</pre>
</fieldset>

 	<fieldset class="options">
    <h3><?php _e('Styling', 'mlcf') ?></h3>
    <p>You may include may some styles like the following in the CSS of your theme, but it should work with standard Stylesheets too.</p>
      <pre style="background: #efefef; border: 1px dashed #444; padding: 1em 1em 1em 2em; width: 40%;">
.contactform{ 
  height: 34em;
  width: 400px;
  /* border: 3px dotted green; */
  margin: 2em;
}
.contactform input, .contactform textarea{ 
  width: 300px;
  margin-bottom: 0.5em;
  border: 2px solid #3e3f3f;
}

div.contactleft{ 
  /* border: 1px dotted blue; */
  width: 8em;
  float: left;
  text-align: right;
}
div.contactright{ 
  /* border: 1px dotted yellow; */
}
.contacrequired{
  text-align: left;
  margin-left: 10em;
}
.contactsubmit{
width: 5em !important;
float: left;
margin-left: 8em;
margin-top: 1em;
}
.mailsend{
color: green;
}
.error{
color: red;
}</pre>
<br />
</fieldset>

  </form>
</div>
