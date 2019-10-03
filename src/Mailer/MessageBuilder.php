<?php

namespace Semhoun\Mailer;

use Semhoun\Interfaces\MessageBuilderInterface;
use DateTimeInterface;
use Swift_Attachment;
use Swift_Message;
use Swift_Mime_ContentEncoder_PlainContentEncoder;

/**
 * Class MessageBuilder.
 *
 * @author Nathanaël Semhoun <nathanael@semhoun.net>
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Mailer
 *
 * @see https://github.com/semhoun/slim-mailer
 */
class MessageBuilder implements MessageBuilderInterface
{
    /** @var Swift_Message */
    private $_swiftMessage;

    /**
     * @param Swift_Message $swiftMessage
     */
    public function __construct(Swift_Message $swiftMessage)
    {
        $this->_swiftMessage = $swiftMessage;
        $this->_swiftMessage->setEncoder(new Swift_Mime_ContentEncoder_PlainContentEncoder('8bit'));
    }

	/**
     * @param string $path
     *
     * @return $this
     */
    public function attachDynamic(string $data, string $filename, string $mime)
    {
        $this->_swiftMessage->attach((new Swift_Attachment())
			->setFilename($filename)
			->setContentType($mime)
			->setBody($data));

        return $this;
    }

    /**
     * @param string $path
     *
     * @return $this
     */
    public function attachFile(string $path)
    {
        $this->_swiftMessage->attach(Swift_Attachment::fromPath($path));

        return $this;
    }

    /**
     * @param string $path
     *
     * @return $this
     */
    public function detachFile(string $path)
    {
        $this->_swiftMessage->detach(Swift_Attachment::fromPath($path));

        return $this;
    }

    /**
     * @return Swift_Message
     */
    public function getSwiftMessage()
    {
        return $this->_swiftMessage;
    }

    /**
     * @param string $address
     * @param string $name    optional
     *
     * @return $this
     */
    public function setBcc(string $address, string $name = '')
    {
        $this->_swiftMessage->setBcc($address, $name);

        return $this;
    }

    /**
     * @param mixed $body
     *
     * @return $this
     */
    public function setBody($body)
    {
        $this->_swiftMessage->setBody($body, 'text/html');

        return $this;
    }

    /**
     * @param string $address
     * @param string $name    optional
     *
     * @return $this
     */
    public function setCc(string $address, string $name = '')
    {
        $this->_swiftMessage->setCc($address, $name);

        return $this;
    }

    /**
     * @param string $address
     * @param string $name optional
     *
     * @return $this
     */
    public function setReplyTo(string $address, string $name = '')
    {
        $this->_swiftMessage->setReplyTo($address, $name);

        return $this;
    }

    /**
     * @param DateTimeInterface $dateTime
     *
     * @return $this
     */
    public function setDate(DateTimeInterface $dateTime)
    {
        $this->_swiftMessage->setDate($dateTime);

        return $this;
    }

    /**
     * @param string $address
     * @param string $name    optional
     *
     * @return $this
     */
    public function setFrom(string $address, string $name = '')
    {
        $this->_swiftMessage->setFrom($address, $name);

        return $this;
    }

    /**
     * @param int $priority
     *
     * @return $this
     */
    public function setPriority(int $priority)
    {
        $this->_swiftMessage->setPriority($priority);

        return $this;
    }

    /**
     * @param string $subject
     *
     * @return $this
     */
    public function setSubject(string $subject)
    {
        $this->_swiftMessage->setSubject($subject);

        return $this;
    }

    /**
     * @param type $address
     * @param type $name    optional
     *
     * @return $this
     */
    public function setTo(string $address, string $name = '')
    {
        $this->_swiftMessage->setTo($address, $name);

        return $this;
    }
}
