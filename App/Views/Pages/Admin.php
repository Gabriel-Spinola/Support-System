<?php

    /// position -1 = client
    /// position  1 = admin

    use Models\AdminModel;

    $adminModel = new AdminModel(new MySql);

?>

<h3>New Questions:</h3>

<?php $adminModel -> getCalls() ?>
<?php $adminModel -> sendAnswer() ?>

<hr>

<h3>Last Interactions:</h3>