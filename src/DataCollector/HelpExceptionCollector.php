<?php


namespace App\DataCollector;


use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class HelpExceptionCollector extends DataCollector
{
    public const GOOGLE = "https://google.com/";
    public const STACKOVERFLOW = "https://stackoverflow.com/";
    public const SYMFONY = "https://symfony.com/";
    public const SLACK = "https://symfony-devs.slack.com/messages/C3EQ7S3MJ";

    public const GOOGLEQUERY = self::GOOGLE."/search?q=";
    public const STACKOVERFLOWQUERY = self::STACKOVERFLOW."/search?q=";

    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        if (null !== $exception) {
            $this->data['exception_message'] = FlattenException::create($exception)->getMessage();
        }
    }

    public function getName()
    {
        return 'help.exception_collector';
    }

    public function reset()
    {
        $this->data = [];
    }

    public function hasException()
    {
        return isset($this->data['exception_message']);
    }

    public function googleSearchQuery()
    {
        return self::GOOGLEQUERY . $this->data['exception_message'];
    }

    public function stackOverflowQuery()
    {
        return self::STACKOVERFLOWQUERY . $this->data['exception_message'];

    }
}
