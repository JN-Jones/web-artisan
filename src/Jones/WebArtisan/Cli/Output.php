<?php

namespace Jones\WebArtisan\Cli;

use Symfony\Component\Console\Output\Output as out;

class Output extends out {

        public function __construct($verbosity = self::VERBOSITY_NORMAL) {
                parent::__construct($verbosity, TRUE, new OutputFormatter(TRUE));
        }

        protected function doWrite($message, $newline) {
                $message = str_replace(PHP_EOL, '<br />', $message);
                $message = str_replace("\n", '<br />', $message);
                $message = str_replace("\r\n", '<br />', $message);
                $message = str_replace("\r", '<br />', $message);
                echo $message.($newline ? '<br />' : '');
        }

}