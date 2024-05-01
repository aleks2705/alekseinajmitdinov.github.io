<?php
// Set the recipient email address where you want to receive the form submissions
$toEmail = 'aleksei.najmitdinov@epfedu.fr';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data from the POST request
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // Basic data validation
    $errors = [];
    if (empty($name)) {
        $errors[] = 'Name is required.';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid email is required.';
    }
    if (empty($subject)) {
        $errors[] = 'Subject is required.';
    }
    if (empty($message)) {
        $errors[] = 'Message is required.';
    }

    // If there are no validation errors, proceed with sending the email
    if (empty($errors)) {
        // Create the email headers
        $headers = [
            'From' => $email,
            'Reply-To' => $email,
            'Content-Type' => 'text/plain; charset=utf-8',
        ];

        // Send the email using the mail() function
        $success = mail($toEmail, $subject, $message, $headers);

        // Check if the email was sent successfully
        if ($success) {
            // Display a success message
            echo '<div class="sent-message">Your message has been sent. Thank you!</div>';
        } else {
            // Display an error message
            echo '<div class="error-message">Failed to send your message. Please try again later.</div>';
        }
    } else {
        // Display validation error messages
        echo '<div class="error-message">';
        foreach ($errors as $error) {
            echo '<p>' . htmlspecialchars($error) . '</p>';
        }
        echo '</div>';
    }
} else {
    // If the form is not submitted using the POST method, display an error message
    echo '<div class="error-message">Invalid request.</div>';
}
?>
