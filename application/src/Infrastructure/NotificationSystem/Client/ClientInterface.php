<?php
/**
 * Created by PhpStorm.
 * User: waled
 * Date: 22/12/2017
 * Time: 15:09
 */

namespace App\Infrastructure\NotificationSystem\Client;

interface ClientInterface
{
    public function publish(string $message) : void;
}