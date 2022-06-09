<?php

namespace App\View\Components;

use App\Http\Requests\DeployJsonRequest;
use Illuminate\View\Component;

class DeployJson extends Component
{
    private $data;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(DeployJsonRequest $request)
    {
        $this->data['array'] = json_decode($request->json);

        $this->data['depth'] = $request->input('depth', 1);

        $this->data['color'] = $request->input('color', 'black');

        $this->data['background'] = 'none';

        if ($request->input('background', null)) {

            if (strpos($request->background, ')')) {
                $this->data['background'] = 'rgb' . $request->background;
            
            } else {
                
                if (strpos($request->background, '://')) {
                    $this->data['background'] = "url('$request->background')";
            
                } elseif ($request->background != null) {
                    $this->data['background'] = "url('/img/$request->background')";
                }

                $this->data['background'] .= " no-repeat center center / cover";
            }
        } 
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.deploy-json', [
            'data' => $this->data
        ]);
    }
}
