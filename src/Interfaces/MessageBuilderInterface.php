<?php

namespace Semhoun\Interfaces;

use DateTimeInterface;

/**
 * Interface MessageBuilderInterface.
 *
 * @author Nathanaël Semhoun <nathanael@semhoun.net>
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Interfaces
 *
 * @see https://github.com/semhoun/slim-mailer
 */
interface MessageBuilderInterface
{
    /**
     * @param string $path
     *
     * @return $this
     */
    public function attachFile(string $path);

    /**
     * @param string $path
     *
     * @return $this
     */
    public function detachFile(string $path);

    /**
     * @param string $address
     * @param string $name    optional
     *
     * @return $this
     */
    public function setBcc(string $address, string $name = '');

    /**
     * @param mixed $body
     *
     * @return $this
     */
    public function setBody($body);

    /**
     * @param string $address
     * @param string $name    optional
     *
     * @return $this
     */
    public function setCc(string $address, string $name = '');

    /**
     * @param DateTimeInterface $dateTime
     *
     * @return $this
     */
    public function setDate(DateTimeInterface $dateTime);

    /**
     * @param string $address
     * @param string $name    optional
     *
     * @return $this
     */
    public function setFrom(string $address, string $name = '');

    /**
     * @param int $priority
     *
     * @return $this
     */
    public function setPriority(int $priority);

    /**
     * @param string $subject
     *
     * @return $this
     */
    public function setSubject(string $subject);

    /**
     * @param type $address
     * @param type $name    optional
     *
     * @return $this
     */
    public function setTo(string $address, string $name = '');
}
