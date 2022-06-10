<div 
    class="deploy_json" 
    style="color: {{$color}};">
    
    <x-deploy-json-background 
        :background="$background">
    </x-deploy-json-background>


    <ul>
        @foreach ($topNode as $key => $value)
            <x-deploy-json-switcher
                :key="$key"
                :node="$value"
                :level="0"
                :depth="$depth">
            </x-deploy-json-switcher>
        @endforeach
    </ul>

</div>
