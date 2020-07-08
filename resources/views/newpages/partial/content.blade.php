<?php
$path = trim_lang(request()->getPathInfo());

if($path == '') {
    $path = $path.'/';
}

$content = App\ContentBlock::where('url', $path)->first();

?>
@if($content)
<div class="main-details__text">
    <div class="part_content">
        @if(app()->getLocale() !== 'de')
            {!! $content['content_'.app()->getLocale()] !!}
        @else
            {!! $content->content !!}
        @endif

    </div>

    <div class="main-details__text-button">
        <a>{{ __('main_page.read_more_btn') }}</a>
    </div>
</div>

@endif