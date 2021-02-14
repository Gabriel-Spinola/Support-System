<?php

    /// position -1 = client
    /// position  1 = admin

    use Models\CallModel;

    $callModel = new CallModel(new MySql);

?>

<h2>Token: <?php print $_GET['token'] ?></h2>

<hr>

<h2>Question: <?php print $pageInfo['message'] ?></h2>

<hr>

<h2>In Response to your message:</h2>

<?php

$callModel -> callResponse();
$callModel -> callView();
