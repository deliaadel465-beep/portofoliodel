<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  $host = "localhost";
  $user = "root";
  $pass = "";
  $db   = "db_kontak"; // Pastikan nama database sudah benar
  $kon  = mysqli_connect($host, $user, $pass, $db);

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'contact@example.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */
  if ($kon) {
      // Mengamankan input agar tidak eror jika ada tanda kutip (')
      $nama   = mysqli_real_escape_string($kon, $_POST['name']);
      $email  = mysqli_real_escape_string($kon, $_POST['email']);
      $subjek = mysqli_real_escape_string($kon, $_POST['subject']);
      $pesan  = mysqli_real_escape_string($kon, $_POST['message']);

      $sql = "INSERT INTO pesan (nama, email, subjek, pesan) VALUES ('$nama', '$email', '$subjek', '$pesan')";
      mysqli_query($kon, $sql);
  }
  
  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();
?>
