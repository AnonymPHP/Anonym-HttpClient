<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\HttpClient;

    /**
     * Class Response
     * @package Anonym\Components\HttpClient
     */
    class Response
    {
        /**
         * dosya tipi
         *
         * @var string
         */
        private $contentType = 'text/html';

        /**
         * Http protocol versiyonu
         *
         * @var string
         */
        private $protocolVersion;

        /**
         * Kullanılacar karekter seti
         *
         * @var string
         */
        private $charset = 'utf-8';

        /**
         * Durumlara göre mesajları tutar
         *
         * @var array
         */
        private $statusTexts = [
            100 => 'Continue',
            101 => 'Switching Protocols',
            102 => 'Processing',            // RFC2518
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            207 => 'Multi-Status',          // RFC4918
            208 => 'Already Reported',      // RFC5842
            226 => 'IM Used',               // RFC3229
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => 'Reserved',
            307 => 'Temporary Redirect',
            308 => 'Permanent Redirect',    // RFC7238
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            418 => 'I\'m a teapot',                                               // RFC2324
            422 => 'Unprocessable Entity',                                        // RFC4918
            423 => 'Locked',                                                      // RFC4918
            424 => 'Failed Dependency',                                           // RFC4918
            425 => 'Reserved for WebDAV advanced collections expired proposal',   // RFC2817
            426 => 'Upgrade Required',                                            // RFC2817
            428 => 'Precondition Required',                                       // RFC6585
            429 => 'Too Many Requests',                                           // RFC6585
            431 => 'Request Header Fields Too Large',                             // RFC6585
            500 => 'Internal Server Errors',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            506 => 'Variant Also Negotiates (Experimental)',                      // RFC2295
            507 => 'Insufficient Storage',                                        // RFC4918
            508 => 'Loop Detected',                                               // RFC5842
            510 => 'Not Extended',                                                // RFC2774
            511 => 'Network Authentication Required',                             // RFC6585
        ];
        /**
         * İçeriği tutar
         *
         * @var null|string
         */
        private $content = null;
        /**
         * Durum Kodunu tutar
         *
         * @var int
         */
        private $statusCode = 200;


        /**
         * Başlık bilgilerini tutar
         *
         * @var array
         */
        private $headers;

        /**
         * Cookie başlıklarını tutar
         *
         * @var
         */
        private $cookieHeaders;

        /**
         * Sınıfı başlatır
         *
         * @param string $content içerik kısmı
         * @param string $statusCode gönderilecek durum kodu
         */
        public function __construct($content = '', $statusCode = ''){
            $this->setContent($content);
            $this->setStatusCode($statusCode);
        }

        /**
         * @return string
         */
        public function getContentType()
        {
            return $this->contentType;
        }

        /**
         * @param string $contentType
         * @return Response
         */
        public function setContentType($contentType)
        {
            $this->contentType = $contentType;

            return $this;
        }

        /**
         * @return string
         */
        public function getProtocolVersion()
        {
            return $this->protocolVersion;
        }

        /**
         * @param string $protocolVersion
         * @return Response
         */
        public function setProtocolVersion($protocolVersion)
        {
            $this->protocolVersion = $protocolVersion;

            return $this;
        }

        /**
         * @return string
         */
        public function getCharset()
        {
            return $this->charset;
        }

        /**
         * @param string $charset
         * @return Response
         */
        public function setCharset($charset)
        {
            $this->charset = $charset;

            return $this;
        }

        /**
         * @return array
         */
        public function getStatusTexts()
        {
            return $this->statusTexts;
        }

        /**
         * @param array $statusTexts
         * @return Response
         */
        public function setStatusTexts($statusTexts)
        {
            $this->statusTexts = $statusTexts;

            return $this;
        }

        /**
         * @return null|string
         */
        public function getContent()
        {
            return $this->content;
        }

        /**
         * @param null|string $content
         * @return Response
         */
        public function setContent($content)
        {
            $this->content = $content;

            return $this;
        }

        /**
         * @return int
         */
        public function getStatusCode()
        {
            return $this->statusCode;
        }

        /**
         * @param int $statusCode
         * @return Response
         */
        public function setStatusCode($statusCode)
        {
            $this->statusCode = $statusCode;

            return $this;
        }

        /**
         * @return array
         */
        public function getHeaders()
        {
            return $this->headers;
        }

        /**
         * @param array $headers
         * @return Response
         */
        public function setHeaders($headers)
        {
            $this->headers = $headers;

            return $this;
        }

        /**
         * Header kodu ekler mesaja
         *
         * @param $name
         * @param null $value
         * @return $this
         */
        public function header($name, $value = null){

            if($value === null){
                $this->headers[] = $name;
            }else{
                $this->headers[] = $this->headerString($name, $value);
            }

            return $this;
        }

        /**
         * Header metnini oluşturur
         *
         * @param $name
         * @param string $value
         * @return string
         */
        private function headerString($name, $value = ''){
            return sprintf("%s: %s", settype($key, "string"), settype($key, "string"));
        }


    }