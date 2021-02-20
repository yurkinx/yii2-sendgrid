<?php
/**
 * @author Bryan Jayson Tan <bryantan16@gmail.com>
 * @link http://bryantan.info
 * @date 3/24/14
 * @time 6:48 PM
 */

namespace yurkinx\sendgrid;

use yii\helpers\Json;
use yii\mail\BaseMessage;

class Message extends BaseMessage
{
    private $_sendGridMessage;

    public function getSendGridMessage()
    {
        if (!is_object($this->_sendGridMessage)) {
            $this->_sendGridMessage = new \SendGrid\Mail\Mail();
        }
        return $this->_sendGridMessage;
    }

    /**
     * @inheritdoc
     */
    public function getCharset()
    {
        // not available on sendgrid
    }

    /**
     * @inheritdoc
     */
    public function setCharset($charset)
    {
        // not available on sendgrid
    }

    /**
     * @inheritdoc
     */
    public function getFrom()
    {
        return $this->getSendGridMessage()->getFrom();
    }
    /**
     * @inheritdoc
     */
    public function getFromName()
    {
        return $this->getSendGridMessage()->getFromName();
    }

    /**
     * @inheritdoc
     */
    public function setFrom($from)
    {
        if (is_array($from)) {
            $this->getSendGridMessage()->setFrom(key($from), current($from));
        } else {
            $this->getSendGridMessage()->setFrom($from);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getReplyTo()
    {
        return $this->getSendGridMessage()->getReplyTo();
    }

    /**
     * @inheritdoc
     */
    public function setReplyTo($replyTo)
    {
        $this->getSendGridMessage()->setReplyTo($replyTo);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTo()
    {
        return $this->getSendGridMessage()->getPersonalization()->getTos()[0];
    }

    /**
     * @inheritdoc
     */
    public function setTo($to)
    {
        if (is_array($to)) {
            $this->getSendGridMessage()->addTos($to);
        } else {
            $this->getSendGridMessage()->addTo($to);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCc()
    {
        return $this->getSendGridMessage()->getCcs();
    }

    /**
     * @inheritdoc
     */
    public function setCc($cc)
    {
        $this->getSendGridMessage()->addCc($cc);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getBcc()
    {
        return $this->getSendGridMessage()->getBccs();
    }

    /**
     * @inheritdoc
     */
    public function setBcc($bcc)
    {
        $this->getSendGridMessage()->addBcc($bcc);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSubject()
    {
        return $this->getSendGridMessage()->getSubject();
    }

    /**
     * @inheritdoc
     */
    public function setSubject($subject)
    {
        $this->getSendGridMessage()->setSubject($subject);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setTextBody($text)
    {
        $this->getSendGridMessage()->addContent("text/plain",$text);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setHtmlBody($html)
    {
        $this->getSendGridMessage()->addContent("text/html", $html);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function attach($fileName, array $options = [])
    {
        $this->getSendGridMessage()->addAttachment($fileName);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function attachContent($content, array $options = [])
    {
        // no available method for sendgrid
    }

    /**
     * @inheritdoc
     */
    public function embed($fileName, array $options = [])
    {
        // no available method for sendgrid
    }

    /**
     * @inheritdoc
     */
    public function embedContent($content, array $options = [])
    {
        // no available method for sendgrid
    }
  
    
    public function setCategory($category)
    {
        $this->getSendGridMessage()->addCategory($category);
        return $this;
    }
     /**
     * @return array categories
     */
    public function getCategories(){
        
        return $this->getSendGridMessage()->getSmtpapi()->category;
    }
    
    public function setSendAt($timestamp)
    {
        $this->getSendGridMessage()->setSendAt($timestamp);
        return $this;
    }
    /**
     * @inheritdoc
     */
    public function toString()
    {
        $string = '';
//         foreach ($this->getSendGridMessage()->toWebFormat() as $key => $value) {
//             $string .= sprintf("%s:%s\n", $key, is_array($value)?Json::encode($value):$value);
//         }
        return $string;
    }
} 
