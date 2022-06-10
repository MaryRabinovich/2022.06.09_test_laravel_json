<li style="{{$style}}">

    <details {{$level < $depth ? 'open' : ''}}>
    
        <summary>
            {{$key}} ( {{$nodeType}} )
        </summary>
    
        <ul>
            @foreach ($node as $key => $value)

                <x-deploy-json-switcher
                    :key="$key"
                    :node="$value"
                    :level="$level"
                    :depth="$depth">
                </x-deploy-json-switcher>
                
            @endforeach
        </ul>

    </details>

</li>
