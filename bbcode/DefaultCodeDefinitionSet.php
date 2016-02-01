<?php

namespace JBBCode;

require_once 'CodeDefinition.php';
require_once 'CodeDefinitionBuilder.php';
require_once 'CodeDefinitionSet.php';


/**
 * Provides a default set of common bbcode definitions.
 *
 * @author jbowens
 */
class DefaultCodeDefinitionSet implements CodeDefinitionSet
{

    /* The default code definitions in this set. */
    protected $definitions = array();

    /**
     * Constructs the default code definitions.
     */
    public function __construct()
    {
        /* [b] bold tag */
        $builder = new CodeDefinitionBuilder('b', '<strong>{param}</strong>');
        array_push($this->definitions, $builder->build());

        /* [i] italics tag */
        $builder = new CodeDefinitionBuilder('i', '<em>{param}</em>');
        array_push($this->definitions, $builder->build());

        /* [u] italics tag */
        $builder = new CodeDefinitionBuilder('u', '<u>{param}</u>');
        array_push($this->definitions, $builder->build());

        $builder = new CodeDefinitionBuilder('s', '<s>{param}</s>');
        array_push($this->definitions, $builder->build());

        $builder = new CodeDefinitionBuilder('trigger', '<small>{param}</small>');
        array_push($this->definitions, $builder->build());

        /* [url] link tag */
        $builder = new CodeDefinitionBuilder('url', '<a href="{param}">{param}</a>');
        $builder->setParseContent(false);
        array_push($this->definitions, $builder->build());

        /* [url=http://example.com] link tag */
        $builder = new CodeDefinitionBuilder('url', '<a href="{option}">{param}</a>');
        $builder->setUseOption(true)->setParseContent(true);
        array_push($this->definitions, $builder->build());

        /* [img] image tag */
        $builder = new CodeDefinitionBuilder('img', '<img class="img-responsive" src="{param}" />');
        $builder->setUseOption(false)->setParseContent(false);
        array_push($this->definitions, $builder->build());

        /* [img=alt text] image tag */
        $builder = new CodeDefinitionBuilder('img', '<img "img-responsive" src="{param} alt="{option}" />');
        $builder->setUseOption(true);
        array_push($this->definitions, $builder->build());

        $builder = new CodeDefinitionBuilder('code', '<pre>{param}</pre>');
        $builder->setParseContent(false);
        array_push($this->definitions, $builder->build());

        $builder = new CodeDefinitionBuilder('list', '<ul class="list-group">{param}</ul>');
        array_push($this->definitions, $builder->build());

        $builder = new CodeDefinitionBuilder('list', '<ol class="list-group">{param}</ol>');
        $builder->setUseOption(true);
        array_push($this->definitions, $builder->build());

        $builder = new CodeDefinitionBuilder('*', '<li class="list-group-item">{param}</li>');
        array_push($this->definitions, $builder->build());

        // $builder = new CodeDefinitionBuilder('video', '<div class="embed-responsive  embed-responsive-4by3"><iframe class="embed-responsive-item" src="{param}"></iframe></div>');
        // $builder->setParseContent(false);
        // array_push($this->definitions, $builder->build());

        /* [color] color tag */
        // $builder = new CodeDefinitionBuilder('color', '<span style="color: {option}">{param}</span>');
        // $builder->setUseOption(true)->setOptionValidator(new \JBBCode\validators\CssColorValidator());
        // array_push($this->definitions, $builder->build());
    }

    /**
     * Returns an array of the default code definitions.
     */
    public function getCodeDefinitions()
    {
        return $this->definitions;
    }

}
