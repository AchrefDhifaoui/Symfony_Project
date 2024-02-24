<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class helpers
{
    private $langue;
    public function __construct(private LoggerInterface $logger)
    {

    }

    public function sayCc():string
    {
        $this->logger->info('je dit cc');
        return 'cc';
    }



}