<?php
 
if(isset($_POST['email'])) {
    
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "huangc8@tcnj.edu";
    $email_subject = "Contact Form Submission";

    function died($error) {
        // your error code can go here
        echo "<h1>Whoops!</h1><h2>There appears to be something wrong with your completed form.</h2>";
        echo "<strong><p>The following items are not specified correctly.</p></strong><br />";
        echo $error."<br /><br />";
        echo "<p>Return to the form and try again.</p><br />";
        echo "<p><a href='index.php'>return to the homepage</a></p>";
        die(); 
    }

    $email_from = $_POST['email']; // required
    $comments = $_POST['comments']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp,$email_from)) {
    $error_message .= '<li><p>The completed e-mail address appears to be incorrect<p></li>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if(strlen($comments) < 2) {
    $error_message .= '<li><p>Message appears to be incorrect</p></li>';
    }

    if(strlen($error_message) > 0) {
    died($error_message);
    }

    $email_message = "Form details are given below.\n\n";

    function clean_string($string) { 
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message .= "Email Address: ".clean_string($email_from)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";

    // create email headers
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);  

?>

<!-- include your own success html here -->
<?php echo file_get_contents('success.html'); ?>

<?php
}
?>
