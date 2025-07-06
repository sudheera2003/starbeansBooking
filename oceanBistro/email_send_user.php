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
    <title>Reservation Request Received</title>
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
            background: #163266;
            color: white;
            padding: 40px 20px;
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
        
        .thank-you-section {
            background: linear-gradient(135deg, #d6e4ff, #d8e5ff);
            padding: 30px 20px;
            text-align: center;
            border-bottom: 3px solid #163266;
        }
        
        .thank-you-section h2 {
            color: #163266;
            font-size: 24px;
            margin: 0 0 15px 0;
        }
        
        .thank-you-section p {
            font-size: 16px;
            color: #555;
            margin: 0;
        }
        
        .content {
            padding: 30px 20px;
        }
        
        .greeting {
            font-size: 18px;
            color: #163266;
            margin-bottom: 20px;
        }
        
        .reservation-summary {
            background-color: #f8f9fa;
            border-left: 4px solid #163266;
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 8px 8px 0;
        }
        
        .summary-title {
            color: #163266;
            font-size: 18px;
            font-weight: bold;
            margin: 0 0 20px 0;
        }
        
        .detail-row {
            display: flex;
            margin: 10px 0;
            padding: 8px 0;
        }
        
        .detail-label {
            font-weight: bold;
            color: #163266;
            width: 120px;
            flex-shrink: 0;
        }
        
        .detail-value {
            color: #333;
            flex: 1;
        }
        
        .status-section {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }
        
        .status-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }
        
        .status-title {
            color: #856404;
            font-size: 18px;
            font-weight: bold;
            margin: 0 0 10px 0;
        }
        
        .status-description {
            color: #856404;
            margin: 0;
            font-size: 14px;
        }
        
        .next-steps {
            background-color: #d8e6ff;
            border: 1px solid #83afff;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        
        .next-steps h3 {
            color: #163266;
            margin: 0 0 15px 0;
            font-size: 16px;
        }
        
        .next-steps ul {
            margin: 0;
            padding-left: 20px;
            color: #163266;
        }
        
        .next-steps li {
            margin: 8px 0;
        }
        
        .contact-info {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }
        
        .contact-info h3 {
            color: #163266;
            margin: 0 0 15px 0;
        }
        
        .contact-info p {
            margin: 5px 0;
            color: #163266;
        }
        
        .contact-info a {
            color: #163266;
            text-decoration: none;
            font-weight: bold;
        }
        
        .footer {
            background-color: #163266;
            color: white;
            padding: 25px 20px;
            text-align: center;
            font-size: 14px;
        }
        
        .footer p {
            margin: 5px 0;
        }
        
        .footer a {
            color: #d1e1ff;
            text-decoration: none;
        }
        
        .social-links {
            margin-top: 15px;
        }
        
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #fafcff;
            text-decoration: none;
            font-size: 18px;
        }
        
        @media (max-width: 600px) {
            .detail-row {
                flex-direction: column;
            }
            
            .detail-label {
                width: 100%;
                margin-bottom: 5px;
            }
            
            .header h1 {
                font-size: 24px;
            }
            
            .thank-you-section h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>Thank You!</h1>
            <p>Ocean Bistro by Starbeans</p>
        </div>
        
        <!-- Thank You Section -->
        <div class="thank-you-section">
            <h2>We have Received Your Reservation Request</h2>
            <p>Thank you for choosing Ocean Bistro by Starbeans. We are excited to serve you!</p>
        </div>
        
        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Dear '.$name.',
            </div>
            
            <p>Thank you for choosing <strong>Ocean Bistro by Starbeans</strong> for your dining experience! We have successfully received your reservation request and truly appreciate your request.</p>
            
            <!-- Reservation Summary -->
            <div class="reservation-summary">
                <div class="summary-title">Your Reservation Request Summary</div>
                
                <div class="detail-row">
                    <div class="detail-label">Name:</div>
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
            
            <!-- Status Section -->
            <div class="status-section">
                <div class="status-icon">⏳</div>
                <div class="status-title">Request Under Review</div>
                <div class="status-description">
                    Our staff is currently checking availability for your requested date and time.
                </div>
            </div>
            
            <!-- Next Steps -->
            <div class="next-steps">
                <h3>🔍 What Happens Next?</h3>
                <ul>
                    <li><strong>Availability Check:</strong> Our team will verify table availability for your requested date and time</li>
                    <li><strong>Quick Response:</strong> A member of our staff will contact you as soon as possible to confirm your reservation</li>
                    <li><strong>Confirmation:</strong> You will receive a confirmation call once your reservation is approved</li>
                    <li><strong>Any Questions:</strong> We will address any special requests or dietary requirements</li>
                </ul>
            </div>
            
            <p>We understand that your time is valuable, and we are committed to responding to your reservation request <strong>as quickly as possible</strong>. Our team typically processes reservation requests within a few hours during business hours.</p>
            
            <!-- Additional Info if provided -->
            <div style="background-color: #D8E6FF; padding: 15px; border-radius: 5px; margin: 20px 0;">
                <strong>Your Special Requests:</strong><br>
                <em>'.$additionalInfo.'</em>
            </div>
            
            <!-- Contact Information -->
            <div class="contact-info">
                <h3>📞 Need to Reach Us?</h3>
                <p>If you have any questions or need to make changes to your request:</p>
                <p><strong>Phone:</strong> <a href="tel:+94 912 235 500">+94 912 235 500</a></p>
                <p><strong>Email:</strong> <a href="mailto:mailto:info@starbeansceylon.com">mailto:info@starbeansceylon.com</a></p>
                <p><strong>Address:</strong> No.4,First Floor Dutch Hospital Shopping Fort,Galle</p>
            </div>
            
            <p>We look forward to welcoming you to Starbeans and providing you with an exceptional dining experience featuring the authentic tastes of the Sri Lanka.</p>
            
            <p>Warm regards,<br>
            <strong>Ocean Bistro by Starbeans Team</strong></p>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p><strong>Ocean Bistro by Starbeans</strong></p>
            <p>📍 No.4,First Floor Dutch Hospital Shopping Fort,Galle</p>
            <p>📞 +94 912 235 500 | 📧 <a href="mailto:info@starbeansceylon.com">info@starbeansceylon.com</a></p>
            <p>🌐 <a href="https://starbeans.ceylonlensmedia.com/ocean-bistro/" style="font-size: 15px;">Visit our website</a></p>
            
            <div class="social-links" style="font-size: 15px;">
                <a href="{{FACEBOOK_URL}}" title="Facebook">Facebook</a>
                <span>|</span>
                <a href="{{INSTAGRAM_URL}}" title="Instagram">Instagram</a>
            </div>
            
            <p style="margin-top: 15px; font-size: 12px; opacity: 0.8;">
                Bringing people together through great food, great coffee, and good vibes since 2010.
            </p>
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
    $mail->CharSet = 'UTF-8';
    $mail->setFrom($email, $name);
    $mail->addReplyTo($email, $name);
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = "Your Reservation Request at Ocean Bistro";
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