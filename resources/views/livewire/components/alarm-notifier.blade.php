<div>
    @if ($alarmSound)
        <audio autoplay>
            <source src="{{ $alarmSound }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    @endif
</div>

