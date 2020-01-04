<?php
    use PHPMailer\PHPMailer\PHPMailer;

    if(isset($_POST['email']) && isset($_POST['subject'])  && isset($_POST['body1']) && isset($_POST['body2'])){
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $body1 = $_POST['body1'];
        $body2 = $_POST['body2'];

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Setting
        $mail->isSMTP();
        // $mail->HOST = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "gregoryshoniwa@gmail.com";
        $mail->Password = "jesuschrist@";
        $mail->Host = 'tls://smtp.gmail.com:587';
        $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );
        // $mail->Port = 465;
        // $mail->SMTPSecure = "ssl";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email);
        $mail->addAddress("gregoryshoniwa@gmail.com");
        $mail->addReplyTo($email);
        $mail->Subject = $subject;
        $mail->Body = "<h2>Items Description</h2><br><br>" . $body1 . "<br><br><br><h2>Location Description</h2><br><br>" .$body2;

        if($mail->send()){
            $res = "success";
        }else{
            $res = "Something is wrong : <br><br>" . $mail->ErrorInfo;
        }
        exit(json_encode(array("res" => $res)));
    }
?>