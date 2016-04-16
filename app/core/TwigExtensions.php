<?php

class TwigExtension extends \Twig_Extension
{
    /**
     * @var \Slim\Interfaces\RouterInterface
     */
    private $router;

    /**
     * @var string|\Slim\Http\Uri
     */
    private $uri;

    public function __construct($router, $uri)
    {
        $this->router = $router;
        $this->uri = $uri;
    }

    public function getName()
    {
        return 'riogo';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('asset', array($this, 'asset')),
        ];
    }

    public function asset($uri)
    {
        if(file_exists(PUBDIR . '/assets/rev-manifest.json') && (!defined('DEVENV') || ! DEVENV)) {
            $rev = json_decode(file_get_contents(PUBDIR . '/assets/rev-manifest.json'), true);
        }
        
        if (is_string($this->uri)) {
            $base = $this->uri;
        } elseif (method_exists($this->uri, 'getBaseUrl')) {
            $base = $this->uri->getBaseUrl();
        }

        return $base . '/assets/' . (isset($rev[$uri]) ? $rev[$uri] : $uri);
    }
}
