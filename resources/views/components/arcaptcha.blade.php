@php
    $arcaptcha = $field->getArCaptchaInstance();
    $widgetId = 'arcaptcha-widget-' . $getId();
    $siteKey = $field->getSiteKey();
    $options = $field->getOptions();
@endphp

{!! $arcaptcha->getScript() !!}

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-data="{ 
            arcaptchaResponse: null,
            arcaptchaInstance: null,
            init() {
                this.$nextTick(() => {
                    if (typeof ArCaptcha !== 'undefined') {
                        this.initArCaptcha();
                    } else {
                        const checkArCaptcha = setInterval(() => {
                            if (typeof ArCaptcha !== 'undefined') {
                                clearInterval(checkArCaptcha);
                                this.initArCaptcha();
                            }
                        }, 100);
                        
                        setTimeout(() => clearInterval(checkArCaptcha), 5000);
                    }
                });
            },
            initArCaptcha() {
                if (typeof ArCaptcha !== 'undefined') {
                    const siteKey = @js($siteKey);
                    const options = @js($options);
                    
                    this.arcaptchaInstance = ArCaptcha.render(@js($widgetId), {
                        'sitekey': siteKey,
                        'callback': (response) => {
                            this.arcaptchaResponse = response;
                            @this.set('{{ $getStatePath() }}', response);
                        },
                        'expired-callback': () => {
                            this.arcaptchaResponse = null;
                            @this.set('{{ $getStatePath() }}', null);
                        },
                        ...options
                    });
                }
            },
            reset() {
                if (this.arcaptchaInstance && typeof ArCaptcha !== 'undefined') {
                    ArCaptcha.reset(this.arcaptchaInstance);
                    this.arcaptchaResponse = null;
                    @this.set('{{ $getStatePath() }}', null);
                }
            }
        }"
        x-on:arcaptcha-reset.window="reset()"
    >
        <div id="{{ $widgetId }}"></div>
        
        @error($getStatePath())
            <p class="text-sm text-danger-600 dark:text-danger-400 mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>
</x-dynamic-component>

