<?php
/**
 * Created by PhpStorm.
 * User: xdsym
 * Date: 26/11/2018
 * Time: 13:13
 */
namespace App\Controllers;
use Framework;
    class PageController extends Framework\Controller
    {
        public function aboutUsAction()
        {
            echo "Static route - page controller";
        }

        public function showAction()
        {
            echo "Dynamic route - page controller";
        }

}