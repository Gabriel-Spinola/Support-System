<?php

    use Helpers\Response;
    use Models\HomeModel;

    $homeModel = new HomeModel(new MySql);

?>

<h2>Hallo World</h2>

<form method="post">
    <input type="email" name="email" placeholder="Email..."> <br>
    <textarea name="message" placeholder="Message..."></textarea> <br>
    <input type="submit" name="submit">
</form>

<?php

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $message = $_POST['message'];
    $token = md5(uniqid());

echo "<div style=\"display:none;\">";
    Response :: detailResponse(
        response: $homeModel -> sendForm($email, $message, $token),
        sucMsg: 'Your message has been sent successfully.',
        errMsg: 'Something went wrong.',
    );
echo "</div>";
}