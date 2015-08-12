<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyad�r.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */


namespace Anonym\Components\HttpClient;

/**
 * Class XmlResponse
 * @package Anonym\Components\HttpClient
 */
class XmlResponse extends Response implements ResponseInterface
{

    /**
     * S�n�f� ba�lat�r ve i�erik ve durum kodunu ayalar
     *
     * @param string $content ��erik
     * @param int $statusCode Durum kodu
     */
    public function __construct($content = '', $statusCode = 200)
    {
        parent::__construct($content, $statusCode);
        $this->setContentType('text/xml');
    }

    /**
     *
     * ��eri�i g�nderiri
     *
     */
    public function send()
    {
        parent::send();
    }
}
