<?php

    use Helpers\Response;
    use Models\HomeModel;

    $homeModel = new HomeModel(
        new MySql,
        $this -> email = new \Email(
            host: ADM_EMAIL_HOST,
            username: ADM_EMAIL,
            password: ADM_EMAIL_PASSWORD,
            name: ADM_EMAIL_NAME
        )
    );

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

    Response :: detailResponse(
        response: $homeModel -> sendForm(
            $email, $message, $token
        ) 
        and 
        $homeModel -> sendEmail(
            $email, $token
        ),
        sucMsg: 'Your message has been sent successfully.',
        errMsg: 'Something went wrong.',
    );
}