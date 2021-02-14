<?php

namespace Helpers;

use InvalidArgumentException;

class Response {
    public static function simpleResponse($response, $message): void { ?>

        <?php if ($response == 'success'): ?>
            
            <div class="alert-box">

                <div class="success">
                    <i class="fa fa-check" aria-hidden="true"></i> 
                    <?php print $message ?>
                </div>

            </div><!--alert-box-->

        <?php elseif ($response == 'error'): ?>

            <div class="alert-box">

                <div class="error">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    <?php print $message ?>
                </div>

            </div><!--alert-box-->

        <?php else: 
            
            throw new InvalidArgumentException('Incorrect Response');
            
        ?>
        
        <?php endif ?>

    <?php }

    public static function detailResponse(bool $response, string $sucMsg, string $errMsg) {
        if ($response) {
            self :: simpleResponse(
                response: 'success',
                message: $sucMsg
            );
        }
        else {
            die ($errMsg);
        }
    }
}