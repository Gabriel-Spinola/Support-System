<?php

namespace Views;

class MainView {
    public function __construct(
        private string $fileName,
    ) { }

    public function render(array $pageInfo = []): void {
        include 'Pages/' . $this -> fileName . '.php';
    }
}