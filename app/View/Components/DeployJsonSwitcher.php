<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DeployJsonSwitcher extends Component
{
    /**
     * Key of the current node
     * 
     * @var string 
     */
    private $key;

    /**
     * Current node
     * 
     * @var string|integer|float|boolean|null|array|object
     */
    private $node;
    
    /**
     * Type of the current node
     * 
     * @var string
     */
    private $nodeType;
    
    /**
     * Level of the current node in the initial json
     * 
     * @var integer
     */
    private $level;
    
    /**
     * Level up to which we open the json at start
     * 
     * @var integer
     */
    private $depth;
    
    /**
     * Template to be rendered:
     * one line component when nodeType is alphanumeric, boolean or null,
     * or node component when nodeType is array or object
     * 
     * @var string
     */
    private $template;
    
    /**
     * Left indentation growing from level to level
     * 
     * @var string
     */
    private $style;

    /**
     * Create a new component instance.
     *
     * @param string|int $key
     * @param string|int|float|bool|object|array $value
     * @param int $level
     * @param int $depth
     * 
     * @return void
     */
    public function __construct($key, $node, $level, $depth)
    {
        $this->key   = $key;
        $this->node  = $node;
        $this->level = $level + 1;
        $this->depth = $depth;

        $this->style = "margin-left: {$this->level}rem;";
        
        $this->nodeType = gettype($node);

        $this->clarifyNode();

        $this->selectTemplate();
    }

    /**
     * Clarify what to publish for boolean and null types
     */
    private function clarifyNode()
    {
        if ($this->nodeType == 'boolean') {
            $this->node = $this->node ? 'true' : 'false';

        } elseif ($this->nodeType == 'NULL') {
            $this->node = 'null';
        }
    }

    /**
     * Select between one-line and node templates
     */
    private function selectTemplate()
    {
        $typeOfNode = gettype($this->node);

        if (in_array($typeOfNode, ['string', 'integer', 'double', 'boolean', 'NULL'])) {
            
            $this->template = 'components.deploy-json-line';
        
        } else {
            $this->template = 'components.deploy-json-node';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view($this->template, [

            'key'      => $this->key,
            'node'     => $this->node,
            'nodeType' => $this->nodeType,
            'level'    => $this->level,
            'depth'    => $this->depth,
            'style'    => $this->style
        ]);
    }
}
