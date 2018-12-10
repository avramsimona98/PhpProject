<?php
/**
 * Created by PhpStorm.
 * User: xdsym
 * Date: 10/12/2018
 * Time: 12:56
 */

namespace App\Guards;


use Framework\Guard;

class Authenticated implements Guard
{
    public function handle()
    {
        session_start();
        if (!isset($_SESSION['username']))
            $this->reject();
    }
    protected function reject()
    {
        header("Location: /auth/login");
    }


}