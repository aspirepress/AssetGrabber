<?php

declare(strict_types=1);

namespace AssetGrabber\Utilities;

use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Output\OutputInterface;

trait ErrorWritingTrait
{
    protected const ERROR = 1;
    protected const WARNING = 2;
    protected const NOTICE = 3;
    protected const INFO = 4;
    protected const DEBUG = 5;

    protected const SUCCESS_MSG = 6;

    protected const FAILURE_MSG = 7;

    protected const ALWAYS_WRITE = 8;

    private OutputInterface $io;

    protected function writeMessage(string|Iterable $message, int $level = self::ALWAYS_WRITE): void
    {
        switch ($level) {
            case self::ERROR:
                $this->io->writeln("<fg=black;bg=red>" . OutputManagementUtil::error($message) . "</>");
                break;

            case self::FAILURE_MSG:
                $this->io->writeln("<fg=black;bg=red>" . OutputManagementUtil::failure($message) . "</>",);
                break;

            case self::WARNING:
                $this->io->writeln("<fg=black;bg=yellow>" . OutputManagementUtil::warning($message) . "</>", Output::VERBOSITY_VERBOSE);
                break;

            case self::INFO:
                $this->io->writeln("<fg=green>" . OutputManagementUtil::info($message) . "</>", Output::VERBOSITY_VERBOSE);
                break;

            case self::NOTICE:
                $this->io->writeln("<fg=yellow>" . OutputManagementUtil::notice($message) . "</>", Output::VERBOSITY_VERY_VERBOSE);
                break;

            case self::DEBUG:
                $this->io->writeln("<fg=yellow>" . OutputManagementUtil::debug($message) . "</>", Output::VERBOSITY_DEBUG);
                break;

            case self::SUCCESS_MSG:
                $this->io->writeln("<fg=black;bg=green>" . OutputManagementUtil::success($message) . "</>");
                break;

            case self::ALWAYS_WRITE:
                $this->io->writeln("<fg=green>" . OutputManagementUtil::generic($message) . "</>", Output::VERBOSITY_QUIET);
        }
    }
    protected function error(string|Iterable $message): void
    {
        $this->writeMessage($message, self::ERROR);
    }
    protected function warning(string|Iterable $message): void
    {
        $this->writeMessage($message, self::WARNING);
    }
    protected function notice(string|Iterable $message): void
    {
        $this->writeMessage($message, self::NOTICE);
    }
    protected function debug(string|Iterable $message): void
    {
        $this->writeMessage($message, self::DEBUG);
    }

    protected function info(string|Iterable $message): void
    {
        $this->writeMessage($message, self::INFO);
    }

    protected function success(string|Iterable $message): void
    {
        $this->writeMessage($message, self::SUCCESS_MSG);
    }
    protected function failure(string|Iterable $message): void
    {
        $this->writeMessage($message, self::FAILURE_MSG);
    }

    protected function always(string|Iterable $message): void
    {
        $this->writeMessage($message, self::ALWAYS_WRITE);
    }
}