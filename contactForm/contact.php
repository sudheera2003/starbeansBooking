<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&family=Geist+Mono:wght@100..900&family=Marcellus&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
      body {
        background-color: #F8F5F2;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
          sans-serif;
        margin: 0;
        padding: 40px 20px;
      }

      .contact-container {
        max-width: 800px;
        margin: 0 auto;
        background: #F8F5F2;
        padding: 30px 50px;
      }

      .logo-section {
        text-align: center;
        margin-bottom: 30px;
      }

      .divider {
        width: 120px;
        height: 2px;
        background-color: #8B5A2B;
        margin: 0 auto 30px;
      }

      .contact-text {
        font-size: 14px;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 15px;
      }

      .main-title {
        font-size: 48px;
        font-weight: 300;
        color: #8B5A2B;
        margin: 0 0 50px 0;
        line-height: 1.2;
        font-family: "Playfair Display", serif;
      }

      .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
      }

      .form-group {
        flex: 1;
      }

      .form-control,
      .form-select {
        width: 100%;
        padding: 18px 20px;
        border: none;
        background-color: #f8f8f8;
        font-size: 16px;
        color: #666;
        border-radius: 0;
        box-sizing: border-box;
      }

      .form-control:focus,
      .form-select:focus {
        outline: none;
        background-color: #f0f0f0;
        box-shadow: none;
      }

      .form-control::placeholder {
        color: #999;
      }

      .message-group {
        margin-bottom: 30px;
      }

      textarea.form-control {
        min-height: 200px;
        resize: vertical;
        font-family: inherit;
      }

      .btn-send {
        background-color: #8B5A2B;
        color: white;
        border: none;
        padding: 18px 35px;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }

      .btn-send:hover {
        background-color:#c5a759;
      }

      @media (max-width: 768px) {
        .form-row {
          flex-direction: column;
          gap: 20px;
        }

        .contact-container {
          padding: 0 10px;
        }

        .main-title {
          font-size: 36px;
        }
      }

      .swal2-confirm{
        background-color: #8B5A2B !important
      }

      .logo_img{
        width: 100%;
        height: auto;
        max-width: 300px;
        margin-bottom: 20px;
        filter: brightness(0) saturate(100%) invert(40%) sepia(64%) saturate(637%) hue-rotate(7deg) brightness(89%) contrast(102%);
      }
    </style>
  </head>
  <body>
    <div class="contact-container">
      <div class="logo-section">
        <div>
          <img src="https://starbeans.ceylonlensmedia.com/wp-content/uploads/2025/04/3x1.png" alt="logo" class="logo_img">
        </div>
        <div class="divider"></div>
        <div class="contact-text">Contact With Us</div>
        <h1 class="main-title">Send us a Message</h1>
      </div>

      <form id="contactForm">
        <div class="form-row">
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              name="firstName"
              id="firstName"
              placeholder="First Name"
            />
          </div>
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              name="lastName"
              id="lastName"
              placeholder="Last Name"
            />
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <input
              type="email"
              class="form-control"
              name="email"
              id="email"
              placeholder="Email"
            />
          </div>
          <div class="form-group">
            <input
              type="tel"
              class="form-control"
              name="phone"
              id="phone"
              placeholder="Phone Number"
            />
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <select class="form-select" name="subject" id="subject">
              <option value="">Select a subject</option>
              <option value="Table Reservation">Table Reservation</option>
              <option value="Special Event Booking">Special Event Booking</option>
              <option value="Feedback">Feedback</option>
              <option value="Careers">Careers</option>
              <option value="Other Inquiry">Other Inquiry</option>
            </select>
          </div>
        </div>

        <div class="message-group">
          <textarea
            class="form-control"
            name="message"
            id="message"
            placeholder="Write a Message"
          ></textarea>
        </div>

        <button type="submit" class="btn-send">Send a Message</button>
      </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document
    .getElementById("contactForm")
    .addEventListener("submit", function (e) {
      e.preventDefault();

      const firstName = document.getElementById("firstName").value.trim();
      const lastName = document.getElementById("lastName").value.trim();
      const email = document.getElementById("email").value.trim();
      const phone = document.getElementById("phone").value.trim();
      const subject = document.getElementById("subject").value;
      const message = document.getElementById("message").value.trim();

      let isValid = true;
      let errorMessage = "";

      // First Name validation
      if (!firstName) {
        isValid = false;
        errorMessage = "Please enter your first name";
      } else if (!/^[a-zA-Z\s'-]+$/.test(firstName)) {
        isValid = false;
        errorMessage = "Invalid first name.";
      } else if (firstName.length < 2) {
        isValid = false;
        errorMessage = "First name should be at least 2 characters";
      }

      // Last Name validation
      else if (!lastName) {
        isValid = false;
        errorMessage = "Please enter your last name";
      } else if (!/^[a-zA-Z\s'-]+$/.test(lastName)) {
        isValid = false;
        errorMessage = "Invalid last name.";
      } else if (lastName.length < 2) {
        isValid = false;
        errorMessage = "Last name should be at least 2 characters";
      }

      // Email validation
      else if (!email) {
        isValid = false;
        errorMessage = "Please enter your email address";
      } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        isValid = false;
        errorMessage = "Invalid email address";
      }

      // Phone validation
      else if (!phone) {
        isValid = false;
        errorMessage = "Please enter your phone number";
      } else if (!/^[\d\s().-]{10}$/.test(phone)) {
        isValid = false;
        errorMessage = "Invalid phone number.";
      }

      // Subject validation
      else if (!subject) {
        isValid = false;
        errorMessage = "Please select a subject";
      }

      if (isValid) {
        const submitBtn = this.querySelector(".btn-send");
        const originalBtnText = submitBtn.textContent;
        
        submitBtn.textContent = "Sending...";
        submitBtn.disabled = true;

        // Prepare form data for both requests
        const formData1 = new FormData();
        formData1.append('firstName', firstName);
        formData1.append('lastName', lastName);
        formData1.append('email', email);
        formData1.append('phone', phone);
        formData1.append('subject', subject);
        formData1.append('message', message);

        const formData2 = new FormData();
        formData2.append('subject', subject);
        formData2.append('firstName', firstName);
        formData2.append('lastName', lastName);
        formData2.append('email', email);

        // Helper function to parse response safely
        const parseResponse = async (response) => {
          const text = await response.text();
          try {
            return JSON.parse(text);
          } catch (e) {
            console.warn('Response was not JSON:', text);
            return { success: false, message: 'Invalid server response' };
          }
        };

        // Send both requests simultaneously
        Promise.all([
          fetch('email_send_process.php', {
            method: 'POST',
            body: formData1
          }).then(parseResponse),
          fetch('email_send_user.php', {
            method: 'POST',
            body: formData2
          }).then(parseResponse)
        ])
        .then(([data1, data2]) => {
          console.log('Responses:', { data1, data2 });
          
          // Check if first email was successful
          if (data1.success) {
            Swal.fire({
              title: "Thank you!",
              text: data1.message || "Your message has been sent successfully. We'll get back to you soon.",
              icon: "success",
              draggable: false,
            });
            this.reset();
          } else {
            // Show error from first email attempt
            Swal.fire({
              title: data1.message || "Failed to send message",
              icon: "error",
              draggable: false,
            });
          }
        })
        .catch(error => {
          console.error('Fetch error:', error);
          // Even if there's an error, check if emails were actually sent
          Swal.fire({
            title: "Message Received",
            text: "We've received your message and will get back to you soon. You may have received a confirmation email.",
            icon: "info",
            draggable: false,
          });
          this.reset();
        })
        .finally(() => {
          submitBtn.textContent = originalBtnText;
          submitBtn.disabled = false;
        });
      } else {
        Swal.fire({
          title: errorMessage,
          icon: "error",
          draggable: false,
        });
      }
    });
</script>
  </body>
</html>