<?php
/**
 * Author: Paul Seleznev
 * Date: 4/08/2013
 */
namespace Art\BreadcrumbsBundle\Builder;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class MainBuilder
{
    /**
     * @var \Twig_Environment
     */
    private $environment;

    /**
     * @var string
     */
    private $separator;

    /**
     * @var string
     */
    private $template;

    /**
     * @var BuilderInterface
     */
    private $builder;

    /**
     * Default constructor.
     *
     * @param \Twig_Environment               $environment             Twig environment object
     * @param BuilderInterface                $builder                 Actual builder
     * @param string                          $template                Template
     * @param string                          $separator               A separator between breadcrumbs elements
     */
    public function __construct(\Twig_Environment $environment, BuilderInterface $builder, $template, $separator)
    {
        $this->environment = $environment;
        $this->separator = $separator;
        $this->template = trim($template);
        $this->builder = $builder;
    }

    /**
     * build method
     * @return mixed
     */
    public function build()
    {
        $breadcrumbs = $this->builder->build();
        $template = $this->environment->loadTemplate($this->template);

        return $template->renderBlock('breadcrumbs', array('items' => $breadcrumbs, 'separator' => $this->separator));
    }
}