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
    $partySize = $_POST['partySize'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $timeSlot = $_POST['timeSlot'] ?? '';
    $additionalInfo = $_POST['additionalInfo'] ?? '';
    $selectedDate = $_POST['selectedDate'] ?? '';

    if ($additionalInfo === '') {
        $additionalInfo = 'No additional information provided.';
    }

    $body = '
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin email</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            line-height: 1.6;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        .header {
            background: #105532;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        
        .header p {
            margin: 10px 0 0 0;
            font-size: 16px;
            opacity: 0.9;
        }
        
        .content {
            padding: 30px 20px;
        }
        
        .reservation-details {
            background-color: #f8f9fa;
            border-left: 4px solid #2d5a3d;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        
        .detail-row {
            display: flex;
            margin: 12px 0;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: bold;
            color: #2d5a3d;
            width: 140px;
            flex-shrink: 0;
        }
        
        .detail-value {
            color: #333;
            flex: 1;
        }
        
        .actions {
            margin: 30px 0;
            text-align: center;
        }
        
        .footer {
            background-color: #105532;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }
        
        .footer a {
            color: #a8d4b8;
            text-decoration: none;
        }
        
        .additional-info {
            background-color: #e8f5e8;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        
        .additional-info h3 {
            margin: 0 0 10px 0;
            color: #2d5a3d;
            font-size: 16px;
        }
        
        .additional-info p {
            margin: 0;
            color: #555;
        }
        
        @media (max-width: 600px) {
            .detail-row {
                flex-direction: column;
            }
            
            .detail-label {
                width: 100%;
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>New Reservation Request</h1>
            <p>For The Barn Restaurant</p>
        </div>
        
        <!-- Content -->
        <div class="content">
            <p>A new reservation request has been submitted. Please review the details below:</p>
            
            <div class="reservation-details">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <h2 style="margin: 0; color: #2d5a3d;">Reservation Details</h2>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Customer Name:</div>
                    <div class="detail-value">'.$name.'</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Email:</div>
                    <div class="detail-value">'.$email.'</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Contact:</div>
                    <div class="detail-value">'.$contact.'</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Party Size:</div>
                    <div class="detail-value">'.$partySize.' guests</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Date:</div>
                    <div class="detail-value">'.$selectedDate.'</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Time:</div>
                    <div class="detail-value">'.$timeSlot.'</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Submitted:</div>
                    <div class="detail-value">'.date("Y-m-d").' at '. date("h:i:sa").'</div>
                </div>
            </div>
            
            <!-- Additional Information -->
            <div class="additional-info">
                <h3>Additional Information</h3>
                <p>'.$additionalInfo.'</p>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p><strong>The Barn Restaurant</strong></p>
            <p>This is a system generated email</p>
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
    $mail->Subject = "Reservation Request";
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