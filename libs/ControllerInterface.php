<?php

interface ControllerInterface{
    public function __construct($lib);
    public function index();
    public function __destruct();
}