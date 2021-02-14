<h2>Hallo World</h2>

<form method="post">
    <input type="email" name="email" placeholder="Email..."> <br>
    <textarea name="message" placeholder="Message..."></textarea> <br>
    <input type="submit" name="submit">
</form>

<?php

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
}