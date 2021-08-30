<?php
    session_start();
    ob_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include($_SERVER['DOCUMENT_ROOT'].'/assembly/assembly-dashboard/includes/db_connect.php');

    if(isset($_POST['q_id'])) {
        $email = $_POST['email'];
        $q_id = $_POST['q_id'];
        $date = date("d-m-Y");


        //check if the email is empty
        if (empty($email)) {
            header ("Location: ../send-email?error=empty"); 
            exit();
        } else {

            //check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header ("Location: ../send-email?email=invalid");
                exit();
            } else {

                //inserting into database
                $sql = "INSERT INTO sent_email (email, q_id, date)
                        VALUES ('$email', '$q_id', '$date')";
                $result = $conn->query($sql);

                if($result) {
                    //getting data from database
                    $sql = "SELECT * FROM sent_email JOIN questions ON sent_email.q_id = questions.q_id INNER JOIN member ON questions.member_name = member.member_id WHERE sent_email.q_id = '$q_id' AND sent_email.email = '$email'";
                    $result = $conn->query($sql);
                    $row            = mysqli_fetch_assoc($result);
                    $email          = $row['email'];
                    $date           = $row['date'];
                    $subject        = $row['subject'];
                    $question       = $row['question'];
                    $member_name    = $row['firstname']." ".$row['lastname'];
                    $department     = $row['department'];
                    $askedOn        = $row['askedOn'];
                    $due_date       = $row['due_date'];
                    $status         = $row['status'];
                  

                    require ($_SERVER['DOCUMENT_ROOT'].'/assembly/PHPMailer/src/Exception.php');
                    require ($_SERVER['DOCUMENT_ROOT'].'/assembly/PHPMailer/src/PHPMailer.php');
                    require ($_SERVER['DOCUMENT_ROOT'].'/assembly/PHPMailer/src/SMTP.php');

                    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                    try {
                        //Server settings
                        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                        $mail->isSMTP();                                      // Set mailer to use SMTP
                        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                               // Enable SMTP authentication
                        $mail->Username = 'bgogoi.user@gmail.com';                 // SMTP username
                        $mail->Password = 'abcd1997';                           // SMTP password
                        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                    // TCP port to connect to

                        //Recipients
                        $mail->setFrom('bgogoi.user@gmail.com', 'Assembly');
                        $mail->addAddress($email, $department);     // Add a recipient
                        $mail->addReplyTo('bgogoi.user@gmail.com', 'Reply');
                        // $mail->addCC('cc@example.com');
                        // $mail->addBCC('bcc@example.com');

                        //Attachments
                        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                        //Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = $subject;
                        $mail->Body    = 'Question ID: '.$q_id.'<br><br>'.
                                        'Subject: <p>'.$subject.'</p><br>'.
                                        'Asked By: <p>'.$member_name.'</p><br>'.
                                        'Asked On: <p>'.$askedOn.'</p><br>'.
                                        'Reply By: <p>'.$due_date.'</p><br>'.
                                        '<b>Question: </b>'.$question;
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                        $mail->send();
                        header ("Location: ../send-email?email=sent");
                    } catch (Exception $e) {
                        header ("Location: ../send-email?email=not-sent");
                    }
                } else {
                        header ("Location: ../send-email?error=db");
                }                
            }              
        }
    }

?>