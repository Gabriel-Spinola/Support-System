<?php

    /// position -1 = client
    /// position  1 = admin

    use Models\CallModel;

    $callModel = new CallModel(new MySql);

?>

<h3>Your Token: <?php print $_GET['token'] ?></h3>

<hr>

<h3>Your Question: <?php print $pageInfo['message'] ?></h3>

<hr>

<h3>In Response to your message:</h3>

<?php

$callModel -> callResponse();
$callModel -> callView();
