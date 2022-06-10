<?php

namespace App\View\Components;

use App\Http\Requests\DeployJsonRequest;
use Illuminate\View\Component;

class DeployJsonBackground extends Component
{
    private $background;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $background)
    {
        $this->background = 'none';
    
        if (strpos($background, ')')) {
            $this->background = 'rgb' . $background;
        
        } else {
            
            if (strpos($background, '://')) {
                $this->background = "url('$background')";
        
            } elseif ($background != 'none') {
                $this->background = "url('/img/$background')";
            }

            $this->background .= " no-repeat center center / cover";
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.deploy-json-background', [
            'background' => $this->background
        ]);
    }
}
