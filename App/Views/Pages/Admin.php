<?php

    use Models\AdminModel;

    $adminModel = new AdminModel(new MySql);

?>

<h3>New Questions:</h3>

<?php $adminModel -> getCalls() ?>

<hr>

<h3>Last Interactions:</h3>