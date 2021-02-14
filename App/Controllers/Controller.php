<?php

namespace Controllers;

abstract class Controller {
    /** Reference to a view class*/
    protected object $view;

    /** Reference to a model class */
    protected object $model;

    public abstract function execute(): void;
}