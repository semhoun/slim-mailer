<?php

namespace Semhoun\Interfaces;

use Semhoun\Mailer\Mailer;

/**
 * Interface MailableInterface.
 *
 * @author Nathanaël Semhoun <nathanael@semhoun.net>
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Interfaces
 *
 * @see https://github.com/semhoun/slim-mailer
 */
interface MailableInterface
{
    public function build();

    /**
     * @param Mailer $mailer
     */
    public function sendMessage(Mailer $mailer);
}
