<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer-master/src/Exception.php';
require 'vendor/PHPMailer-master/src/PHPMailer.php';
require 'vendor/PHPMailer-master/src/SMTP.php';

require 'includes/init.php';


$email = '';
$subject = '';
$message = '';
$sent = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $errors = [];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors[] = 'Please enter a valid email';
    }

    if ($subject == '') {
        $errors[] = 'Please enter a subject';
    }

    if ($message == '') {
        $errors[] = 'Please enter a message';
    }

    if (empty($errors)) {

        $mail = new PHPMailer(true);

        try{
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('csweb@almajed4oud.com');
            $mail->addAddress('al3nezi.ghadier@gmail.com');
            $mail->addReplyTo($email);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();      

            $sent = true;
            
        } catch(Exception $e){
            $errors[] =  $mail->ErrorInfo;
        }
    }
}
?>

<?php require 'includes/header.php'; ?>

<h2>Contact</h2>

<?php if($sent): ?>
    <p>Message sent</p>
<?php else: ?>

    <?php if (! empty($errors)) : ?>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" id="formContact">
    <div>
        <label for="email"> Your Email</label>
        <input name="email" type="email" id="email" placeholder="your email" value="<?= htmlspecialchars($email);?>">

    </div>
    <div>
        <label for="subject">Subject</label>
        <input name="subject" id="subject" type="text" placeholder="Subject" value="<?= htmlspecialchars($subject);?>">

    </div>
    <div>
        <label for="message">Message</label>
        <textarea name="message" id="message" type="text" placeholder="Message" value="<?= htmlspecialchars($message);?>"></textarea>

    </div>

    <button>Send</button>
</form>
<?php endif; ?>
<?php require 'includes/footer.php'; ?>