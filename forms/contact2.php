<?php

if (isset($_POST['submit'])) {
    $text = $_POST['name'];
    $subject = $_POST['subject'];
    $mailFrom = $_POST['email'];
    $message = $_POST['message'];

    $mailTo = "aleksei.najmitdinov@epfedu.fr";
    $headers = "From: " . $mailFrom;
    $txt = "You have received an e-mail from ". $name.".\n\n".$message;

    mail($mailTo, $subject, $txt, $headers);
    header("Location: index.php?mailsend");

    // Send the email and check for success
    if (mail($mailTo, $subject, $txt, $headers)) {
        header("Location: index.php?mailsend=success");
    } else {
        header("Location: index.php?mailsend=error");
    }
}