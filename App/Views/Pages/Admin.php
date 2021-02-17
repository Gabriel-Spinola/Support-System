<?php

    /// position -1 = client
    /// position  1 = admin

    use Models\AdminModel;

    $adminModel = new AdminModel(
        new MySql,
        $this -> email = new \Email(
            host: ADM_EMAIL_HOST,
            username: ADM_EMAIL,
            password: ADM_EMAIL_PASSWORD,
            name: ADM_EMAIL_NAME
        )
    );

?>

<h3>New Questions:</h3>

<?php $adminModel -> getCalls() ?>
<?php $adminModel -> sendAnswer() ?>

<hr>

<h3>Last Interactions:</h3>

<?php $adminModel -> lastInteractionsResponse() ?>
<?php $adminModel -> sendLastInteractionResponse() ?>