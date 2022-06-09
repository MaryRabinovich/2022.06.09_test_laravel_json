<div class="deploy_json">

    <div 
        class="deploy_json__background" 
        style="background: {{$data['background']}};">
    </div>

    <ul class="deploy_json__content" 
        style="color: {{$data['color']}}"
        >

        @foreach ($data['array'] as $key => $value)
            
            @include('components.deploy-json-layer', [
                'key' => $key,
                'value' => $value,
                'level' => 0,
                'depth' => $data['depth'] - 1
            ])

        @endforeach

    </ul>
</div>
