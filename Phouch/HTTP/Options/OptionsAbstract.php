<?php
/**
 * Phouch\HTTP\Options\OptionsAbstract
 * @author Dustin Moorman <dustin.moorman@gmail.com>
 * @description HTTP options, should encompass:
 * - transport method (http / https)
 * - host (example.com)
 * - port (5894)
 * and be extended to fully implement any type of
 * HTTP request.
 */

namespace Phouch\HTTP\Options;

use Phouch\Exception\HTTP\Port as PortException;

abstract class OptionsAbstract
{

    private $_host = '127.0.0.1';
    private $_port = 5984;
    private $_transport = 'http';
    private $_uri = '/';
    private $_certPath;
    private $_username;
    private $_password;
    protected $_method;

    /**
    * @param can be an array, or nothing.
    *
    * If array, will look for keys transport, host, and port,
    * and will set accordingly.
    *
    * If nothing, will assume values as default, or that the
    * user will set options with a setter.
    */
    public function __construct($options = null)
    {
        if(is_array($options))
            $this->setFromArray($options);

        return $this;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setFromArray(array $options)
    {
        if(array_key_exists('port', $options))
            $this->setPort($options['port']);
        if(array_key_exists('transport', $options))
            $this->setTransport($options['transport']);
        if(array_key_exists('host', $options))
            $this->setHost($options['host']);
        if(array_key_exists('uri', $options))
            $this->setUri($options['uri']);
        if(array_key_exists('username', $options))
            $this->setUsername($options['username']);
        if(array_key_exists('password', $options))
            $this->setPassword($options['password']);
        if(array_key_exists('cert_path', $options))
            $this->setCertPath($options['cert_path']);
        return $this;
    }

    /**
     * @param \Phouch\Config $config
     * @return $this
     */
    public function setFromPhouchConfig(\Phouch\Config $config)
    {
        $this->setHost($config->getHost())
            ->setPort($config->getPort())
            ->setTransport($config->getTransport())
            ->setUsername($config->getUsername())
            ->setPassword($config->getPassword())
            ->setCertPath($config->getCertificateFilePath());
        
        return $this;
    }

    /**
     * @param string $host
     * @return $this
     */
    public function setHost($host)
    {
        $this->_host = $host;
        return $this;
    }

    /**
     * @param string $uri
     * @return $this
     */
    public function setURI($uri)
    {
        $this->_uri = $uri;
        return $this;
    }

    /**
     * @param null|string|int $port
     * @return $this
     * @throws
     */
    public function setPort($port)
    {
        if(!$port === null)
        {
            $port = (string) $port;

            try {
                if(!ctype_digit($port)) throw new PortException($port);
            } catch (PortException $invalidPortException){
                echo $invalidPortException->getMessage();
            }
        }

        $this->_port = $port;

        return $this;
    }

    /**
     * @param string $transport 'http' or 'https'
     * @return $this
     */
    public function setTransport($transport)
    {
        $this->_transport = $transport !== 'https'
            ? 'http' : $transport;
        return $this;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->_username = $username;
        return $this;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password) 
    {
        $this->_password = $password;
        return $this;
    }

    /**
     * @param null|string $cert_path
     * @return $this
     */
    public function setCertPath($cert_path) 
    {
        $this->_certPath = $cert_path;
        return $this;
    }

    public function getHost()
    {
        return $this->_host;
    }

    public function getPort()
    {
        return $this->_port;
    }

    public function getUri()
    {
        return $this->_uri;
    }

    public function getTransport()
    {
        return $this->_transport;
    }

    public function getMethod()
    {
        return $this->_method;
    }

    public function getUsername()
    {
        return $this->_username;
    }

    public function getPassword()
    {
        return $this->_password;
    }
    
    public function getCertPath()
    {
        return $this->_certPath;
    }

    public function getPayload()
    {
        throw new \Exception("No Payload in ".$this->_method." request");
    }

}
