<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="icon" href="/images/form.png" type="image/x-icon" />
    <title>Contact Form</title>
  </head>
  <body>
    <section id="contact">
      <h1>Contact me</h1>
      <div class="container-contact">
        <form action="" method="post">
          <input
            name="name"
            type="text"
            class="field"
            placeholder="Name"
            autocomplete="off"
            required
          />
          <input
            name="email"
            type="email"
            class="field"
            placeholder="E-mail"
            autocomplete="off"
            required
          />
          <input
            name="tel"
            type="tel"
            class="field"
            placeholder="Phone"
            autocomplete="off"
          />
          <textarea
            name="message"
            class="field area"
            id="message"
            required
          ></textarea>
          <p>
            <input
              class="terms"
              type="checkbox"
              name="terms"
              id="terms"
              required
            />
            I agree to the terms and conditions
          </p>
          <div
            class="g-recaptcha"
            data-sitekey="6LfwQFAgAAAAANgX-G1Q_4tXNS2HeA2oDc40Ta7q"
          ></div>
          <input
            name="submit"
            class="btn-submit"
            type="submit"
            value="Submit"
          />

          <div class="status">
            <?php
              if (isset($_POST['submit'])) {
                $userName = $_POST['name'];
                $userTel = $_POST['tel'];
                $userEmail = $_POST['email'];
                $userMessage = $_POST['message'];

                $emailForm = 'noreply@plowur.com';
                $emailSubject = 'New Form Submission';
                $emailBody = "Name: $userName.\n" .
                "Phone: $userTel.\n" .
                "Email: $userEmail.\n" .
                "Message: $userMessage.\n";

                $toEmail = "contact@julien-bourbao.com";
                $headers = "Form: $emailForm \r\n";
                $headers = "Reply-To: $userEmail \r\n";

                $secretKey = "6LfwQFAgAAAAAEz7kSYaM3p1WQxn5RuLhhINCef1";
                $responseKey = $_POST['g-recaptcha-response'];
                $userIP = $_SERVER['REMOTE_ADDR'];
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";

                $response = file_get_contents($url);
                $response = json_decode($response);

                if ($response->success) { mail($toEmail, $emailSubject,
            $emailBody, $headers); echo "Message sent Successfully."; } else {
            echo "<span>Invalid Captcha, please try again</span>."; } } ?>
          </div>
        </form>
      </div>
    </section>
  </body>
</html>
