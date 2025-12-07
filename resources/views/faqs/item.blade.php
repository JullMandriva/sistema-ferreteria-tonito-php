<div class="accordion-item">
    <h2 class="accordion-header" id="heading{{ $faq->id }}">
        <button class="accordion-button collapsed" type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#collapse{{ $faq->id }}" 
                aria-expanded="false" 
                aria-controls="collapse{{ $faq->id }}">
            {{ $faq->pregunta }}
        </button>
    </h2>
    <div id="collapse{{ $faq->id }}" 
         class="accordion-collapse collapse" 
         aria-labelledby="heading{{ $faq->id }}" 
         data-bs-parent="#{{ $parent }}">
        <div class="accordion-body text-secondary small">
            {{ $faq->respuesta }}
        </div>
    </div>
</div>