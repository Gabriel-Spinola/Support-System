<?php

    /// position -1 = client
    /// position  1 = admin

    use Models\AdminModel;

    $adminModel = new AdminModel(
        new MySql,
        $this -> email = new \Email(
            host: 'smtp.gmail.com',
            username: 'sampleemail7000@gmail.com',
            password: 'Sample.123',
            name: 'Gabriel'
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