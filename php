<!DOCTYPE html>
<html lang="en">

<head>
  <title>Registration Form</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <linK rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="container">
    <div class="header">
      <h2>Create account</h2>
    </div>
    <form class="form" id="form">
      <div class="form-control make_it_half float-left">
        <label>First Name</label>
        <input type="text" placeholder="First Name" id="Firstname"required>
        <i class="fa-check-circle"></i>
        <i class="fa-exclamation-circle"></i>
        <small>Error massage </small>
      </div>
      <div class="form-control make_it_half float-right">
        <label>Last Name</label>
        <input type="text" placeholder="Last Name" id="Lastname" required>
        <i class="fa-check-circle"></i>
        <i class="fa-exclamation-circle"></i>
        <small>Error massage </small>
      </div>
      <div class="form-control">
        <label>Unsername</label>
        <input type="text" placeholder="@XYZ" id="userName" required>
        <i class="fa-check-circle"></i>
        <i class="fa-exclamation-circle"></i>
        <small>Error massage </small>
      </div>
      <div class="form-control">
        <input type="email" placeholder="ex:fdfe@gmail.com" id="Email">
        <i class="fa-check-circle"></i>
        <i class="fa-exclamation-circle"></i>
        <small>Error massage </small>
        <?php
        

        function verifyEmail($toemail, $fromemail, $getdetails = false)
        {
            //** Get the domain of the email recipient
            $email_arr = explode('@', $toemail);
            $domain = array_slice($email_arr, -1);
            $domain = $domain[0];
        
            // Trim [ and ] from beginning and end of domain string, respectively
            $domain = ltrim($domain, '[');
            $domain = rtrim($domain, ']');
        
            if ('IPv6:' == substr($domain, 0, strlen('IPv6:'))) {
                $domain = substr($domain, strlen('IPv6') + 1);
            }
        
            $mxhosts = array();
                // Check if the domain has an IP address assigned to it
            if (filter_var($domain, FILTER_VALIDATE_IP)) {
                $mx_ip = $domain;
            } else {
                // If no IP assigned, get the MX records for the host name
                getmxrr($domain, $mxhosts, $mxweight);
            }
        
            if (!empty($mxhosts)) {
                $mx_ip = $mxhosts[array_search(min($mxweight), $mxhosts)];
            } else {
                // If MX records not found, get the A DNS records for the host
                if (filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                    $record_a = dns_get_record($domain, DNS_A);
                     // else get the AAAA IPv6 address record
                } elseif (filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                    $record_a = dns_get_record($domain, DNS_AAAA);
                }
        
                if (!empty($record_a)) {
                    $mx_ip = $record_a[0]['ip'];
                } else {
                    // Exit the program if no MX records are found for the domain host
                    $result = 'invalid';
                    $details = 'No suitable MX records found.';
        
                    return ((true == $getdetails) ? array($result, $details) : $result);
                }
            }
        
            // Open a socket connection with the hostname, smtp port 25
            $connect = @fsockopen($mx_ip, 25);
        
            if ($connect) {
        
                      // Initiate the Mail Sending SMTP transaction
                if (preg_match('/^220/i', $out = fgets($connect, 1024))) {
        
                              // Send the HELO command to the SMTP server
                    fputs($connect, 'HELO $mx_iprn');
                    $out = fgets($connect, 1024);
                    $details = $out."n";
        
                    // Send an SMTP Mail command from the sender's email address
                    fputs($connect, "MAIL FROM: <$fromemail>rn");
                    $from = fgets($connect, 1024);
                    $details .= $from."n";
        
                                // Send the SCPT command with the recepient's email address
                    fputs($connect, "RCPT TO: <$toemail>rn");
                    $to = fgets($connect, 1024);
                    $details .= $to."n";
        
                    // Close the socket connection with QUIT command to the SMTP server
                    fputs($connect, 'QUIT');
                    fclose($connect);
        
                    // The expected response is 250 if the email is valid
                    if (!preg_match('/^250/i', $from) || !preg_match('/^250/i', $to)) {
                        $result = 'invalid';
                    } else {
                        $result = 'valid';
                    }
                }
            } else {
                $result = 'invalid';
                $details = 'Could not connect to server';
            }
            if ($getdetails) {
                return array($result, $details);
            } else {
                return $result;
            }
        }
        

        ?>
      </div>
      <div class="form-control">
        <label>Birth Date :</label>
        <input type="date" name="birthday"  />
      </div>

      <div class="pw_form">


        <div class="form-control make_it_half float-left  pw">
          <label>Password </label>
          <input type="password" placeholder="Must be at lest 12 Digit" id="password">
          <i class="fa-check-circle"></i>
          <i class="fa-exclamation-circle"></i>
          <small class="float-right">Error massage </small>
        </div>

        <div class="form-control make_it_half  pw">
          <label>confirm Password </label>
          <input type="password" placeholder="Must be at lest 12 Digit" id="password2">
          <i class="fa-check-circle"></i>
          <i class="fa-exclamation-circle"></i>
          <small class="float-right">Error massage </small>
        </div>

        <div class="form-control pw">
          <label> Can't think of a strong password ? </label>
          <a href="file:///C:/Users/kaneki/Desktop/demo/3lvlsPass/HTML/pw_genr.html" style="text-decoration: none;"
            id="pwMaker">generat one</a>
        </div>
      </div>
      



      <button type="submit">Submit</button>
    </form>
  </div>
</body>

<script src="js/scripts.js"></script>
<script>
  const form = document.getElementById('form');
  const firstname = document.getElementById('Firstname');
  const Lastname = document.getElementById('Lastname');
  const userName = document.getElementById('userName');
  const Email = document.getElementById('Email');
  const pw_gen_on = document.getElementById('pw_gen')
  const password = document.getElementById('password')
  const password2 = document.getElementById('password2')


  form.addEventListener('submit', (e) => {
    e.preventDefault();
    checkInputs();

  });


  function checkInputs() {
    // get the values from the inputs
    checkIfEmpty(firstname, 1)
    checkIfEmpty(Lastname, 1)
    checkIfEmpty(userName, 2)
    checkIfEmpty(Email)
    checkIfEmpty(password)
    checkIfEmpty(password2)


  }

</script>

</html>
