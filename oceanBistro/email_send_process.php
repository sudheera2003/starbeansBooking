<?php
header('Content-Type: application/json');

include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

// Initialize response array
$response = ['success' => false, 'message' => ''];

try {
    // Get POST data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['pnum'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $hotel = $_POST['hotel'] ?? '';
    $message = $_POST['msg'] ?? '';

    // Validate required fields (server-side validation)
    if (empty($name) || empty($email) || empty($phone) || empty($subject) || empty($hotel) || empty($message)) {
        throw new Exception('All fields are required');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email format');
    }

    $body = '
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Customer Inquiry</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Segoe UI;
            background-color: #f8f9fa;
            line-height: 1.6;
        }
        
        .email-container {
            max-width: 700px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .header {
            background-color: #343A40;
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        
        .header p {
            margin: 8px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        
        .content {
            padding: 30px;
            color: #333333;
        }
        
        .inquiry-details {
            background-color: #f8f9ff;
            border-radius: 8px;
            padding: 0;
            margin: 20px 0;
            overflow: hidden;
            border: 1px solid #e9ecef;
        }
        
        .detail-header {
            background-color: #6c757d;
            color: white;
            padding: 15px 20px;
            font-weight: 600;
            font-size: 16px;
        }
        
        .detail-row {
            display: flex;
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
            align-items: flex-start;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-row:nth-child(even) {
            background-color: #ffffff;
        }
        
        .detail-label {
            font-weight: 600;
            color: #495057;
            min-width: 120px;
            margin-right: 15px;
            font-size: 14px;
        }
        
        .detail-value {
            flex: 1;
            color: #333333;
            font-size: 14px;
            word-break: break-word;
        }
        
        .message-content {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 15px;
            font-style: italic;
            line-height: 1.5;
            margin-top: 5px;
        }
        
        .contact-links a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }
        
        .contact-links a:hover {
            text-decoration: underline;
        }
        
        .timestamp {
            background-color: #e9ecef;
            padding: 15px 20px;
            font-size: 12px;
            color: #6c757d;
            text-align: center;
            border-top: 1px solid #dee2e6;
        }
        
        .footer {
            background-color: #343a40;
            color: #adb5bd;
            padding: 20px;
            text-align: center;
            font-size: 12px;
        }
        
        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 0;
            }
            
            .header, .content {
                padding: 20px;
            }
            
            .detail-row {
                flex-direction: column;
                padding: 12px 15px;
            }
            
            .detail-label {
                margin-bottom: 5px;
                margin-right: 0;
                min-width: auto;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="header">
            <h1>New Customer Inquiry</h1>
            <p>Admin Notification</p>
        </div>
        
        <!-- Main Content -->
        <div class="content">
            
            <p>A new customer inquiry has been received through your website contact form. Please review the details below and respond promptly.</p>
            
            <!-- Customer Details -->
            <div class="inquiry-details">
                <div class="detail-header">
                    📋 Customer Information
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Customer Name:</div>
                    <div class="detail-value"><strong>'.$name.'</strong></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Email Address:</div>
                    <div class="detail-value contact-links">
                        <a href="mailto:'.$email.'">'.$email.'</a>
                    </div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Mobile Number:</div>
                    <div class="detail-value contact-links">
                        <a href="tel:'.$phone.'">'.$phone.'</a>
                    </div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Hotel Name:</div>
                    <div class="detail-value"><strong>'.$hotel.'</strong></div>
                </div>
            </div>
            
            <!-- Message Content -->
            <div class="inquiry-details">
                <div class="detail-header">
                    💬 Customer Message
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Subject:</div>
                    <div class="detail-value">'.$subject.'</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Message:</div>
                    <div class="detail-value">
                        <div class="message-content">
                            '.$message.'
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Timestamp -->
            <div class="inquiry-details">
                <div class="timestamp">
                    <strong>Received:</strong> '.date("Y-m-d").' at '.date("h:i").' | <strong>Source:</strong> Website Contact Form
                </div>
            </div>
            
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>Hotel Management System</p>
            <p>This email was automatically generated by your website contact form system.</p>
        </div>
    </div>
</body>
</html>
    ';

    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'sudheeradilum@gmail.com';
    $mail->Password = 'ffauohhfnynozkde';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom($email, $name);
    $mail->addReplyTo($email, $name);
    $mail->addAddress('sudheeradilum@gmail.com');
    $mail->isHTML(true);
    $mail->Subject = "Contact Form: " . $subject;
    $mail->Body = $body;

    if ($mail->send()) {
        $response['success'] = true;
        $response['message'] = 'Your message has been sent successfully!';
    } else {
        throw new Exception('Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
    }

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

// Output the JSON response
echo json_encode($response);
exit;
?>