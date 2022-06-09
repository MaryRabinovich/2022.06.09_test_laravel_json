<li 
    class="deploy_json__ending" 
    style="margin-left: {{$level * 3 + 1}}rem"
    >

    <span>
        {{$key}} ({{gettype($value)}})
    </span> : 
    
    @php
        if (gettype($value) === 'boolean') {
            echo $value ? 'true' : 'false';
        } elseif (gettype($value) === 'NULL') {
            echo 'NULL';
        } else {
            echo $value;
        }
    @endphp
</li>
