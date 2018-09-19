<?php

namespace TubeHousePrice\Application\Controller;

use Symfony\Component\HttpFoundation\Request;

class Controller
{
    protected $request;
    
    public function __construct()
    {
        $this->request = Request::createFromGlobals();
    }
}