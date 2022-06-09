@if (in_array(gettype($value), ['string', 'integer', 'double', 'boolean', 'NULL']))
    
    @include('components.deploy-json-ending', [
        'key' => $key,
        'value' => $value,
        'level' => $level
    ])

@else
    <li>
        <details 
            style="margin-left: {{$level * 3}}rem"
            {{$level < $depth ? 'open' : ''}}
            >

            <summary>
                {{$key}} ({{gettype($value)}})
            </summary>
            
            <ul>
                @foreach ($value as $subKey => $subValue)
                    
                    @include('components.deploy-json-layer', [
                        'key' => $subKey,
                        'value' => $subValue,
                        'level' => $level + 1,
                        'depth' => $depth
                    ])
                @endforeach
            </ul>
            
        </details>
    </li>
@endif
