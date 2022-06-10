<?php

namespace App\View\Components;

use App\Http\Requests\DeployJsonRequest;
use Illuminate\View\Component;

class DeployJsonContainer extends Component
{
    private $color;
    
    private $background;

    private $topNode, $depth;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(DeployJsonRequest $request)
    {
        $this->color = $request->input('color', 'black');

        $this->background = $request->input('background', 'none');

        $this->topNode = json_decode($request->json);
        $this->depth = $request->input('depth', 1);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.deploy-json-container', [
            'color' => $this->color,

            'background' => $this->background,

            'topNode' => $this->topNode,
            'depth' => $this->depth,
            'level' => 0
        ]);
    }
}
