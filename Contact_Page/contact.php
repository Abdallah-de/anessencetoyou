<?php
session_start();
include '../db_config.php';

$name = "";
$email = "";
$message = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim(htmlspecialchars($_POST["name"]));
    $email = trim(htmlspecialchars($_POST["email"]));
    $message = trim(htmlspecialchars($_POST["message"]));
    
    if (empty($name) || empty($email) || empty($message)) {
        $errorMessage = "All the fields are required";
    } else {
        //adding the users to the database
        $sql = "INSERT INTO users_feedback (name, email, message) VALUES ('$name','$email','$message')";
        $result = $connect->query($sql);

        if (!$result) {
            $errorMessage = "Invalid Query: " . $connect->error;
        } else {
            $name = "";
            $email = "";
            $message = "";
            $successMessage = "You sent your message Successfully";
            // Optionally, redirect to contact.php or display success message here
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="../assets/photos/favicon.jpg">
    <title>CONTACT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../footer.css">    
    <link rel="stylesheet" href="contact.css">
</head>
    <body>
        <div class="banner">
        <div class="navbar">
                <img src="../assets/photos/logo.png" class="logo" alt="logo">
                <ul>
                    <li><a href="../Home_Page/homepage.html">HOME</a></li>
                    <li><a href="../About_Page/about.html">ABOUT</a></li>
                    <li><a href="../Gallery_Page/gallery.html">GALLERY</a>
                    <div class="SubMenu"> 
                        <ul>
                            <li><a href="../Film_Page/film.html">FILM</a></li>
                            <li><a href="../StoryBoard_Page/storyboard.html">STORYBOARD</a></li>
                            <li><a href="../Survey_Page/survey.html">SURVEY</a></li>
                        </ul>
                    </div>
                    </li>
                    <li><a href="contact.php">CONTACT</a></li>
                    </li>
                </ul>    
        </div>
        
        <section class="contact">
        <div class="content">
            <h2>GET IN TOUCH WITH US</h2>
            <p>FOR ANY QUESTIONS, SEND YOUR MESSAGE THROUGH THE EMAIL STATED.</p>
        </div>
            <div class="container">
                <div class="contactInfo">
                    <div class="box">
                        <div class="icon"><i class="fa fa-user" aria-hidden="true"></i></div> 
                        <div class="text">
                            <h3>Free Thinkers</h3>
                        </div>
                    </div>
                        <div class="box">
                        <div class="icon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></div>
                        <div class="text">
                            <h3>BS Information Technology major in Multimedia Arts and Animation</h3>
                        </div>
                    </div>
                        <div class="box"> 
                        <div class="icon"><i class="fa fa-envelope"></i></div>
                        <div class="text">
                            <h3>anessencetoyou@gmail.com</h3>
                        </div>
                    </div>
                </div>
                <div class="contactForm">
                    <form method="POST" > <!--https://formsubmit.co/abdallahmohammed01140@gmail.com-->
                    
                    <h2>Send Message</h2>
                    <div class="inputBox">
                    <input type="text" name="name" required="required" value="<?php echo $name; ?>">

                        <span>Full Name</span>
                    </div>
                        <div class="inputBox">
                        <input type="email" name="email" required="required" value="<?php echo $email; ?>">

                        <span>Email</span>
                    </div>
                        <div class="inputBox">                         
                        <textarea required="required"  name="message"><?php echo $message; ?></textarea>

                        <span>Type Your Message...</span>
                    </div>
                    <div class="inputBox">
                        <input type="submit" name="" value="Send">
                    </div>
                </form>
            </div>
        </div>
        </section>    

        <footer>
           <div class="footer">
               <h3> BE MOTIVATED TO LEARN </h3>
               <p> WHERE YOU CAN BE HELP AND SAVE LIVES IN THE FUTURE </p>
                <ul class="sns">
                    <li><a href="https://www.facebook.com/alliahcamille.mendoza"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="https://twitter.com/_llhcm"><i class="fa-brands fa-twitter"></i></a></li>
                    <li><a href="https://www.instagram.com/mdz.ali_/"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="https://www.tiktok.com/@_camilxx?lang=en"><i class="fa-brands fa-tiktok"></i></a></li>
                </ul>
       </footer>
       

  

       </script>
    </body>
    </html>