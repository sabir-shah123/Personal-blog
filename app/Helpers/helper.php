<?php
use App\Setting;

function setting($key, $default = null)
{
    $id = auth()->check() ? auth()->id() : 1;
    return Setting::where('user_id', $id)->first()->value ?? $default;
}

function socialShare($social, $url, $title)
{
    if ($social == 'facebook') {
        $url = 'https://www.facebook.com/sharer/sharer.php?u=' . $url;
    } elseif ($social == 'twitter') {
        $url = 'https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title;
    } elseif ($social == 'linkedin') {
        $url = 'https://www.linkedin.com/sharing/share-offsite?url=' . $url;
    } elseif ($social == 'whatsapp') {
        $url = 'https://wa.me/?text=' . $title . ' ' . $url;
    } elseif ($social == 'pinterest') {
        $url = 'https://pinterest.com/pin/create/button/?url=' . $url;
    } elseif ($social == 'reddit') {
        $url = 'https://www.reddit.com/submit?url=' . $url . '&title=' . $title;
    } elseif ($social == 'telegram') {
        $url = 'https://telegram.me/share/url?url=' . $url . '&text=' . $title;
    }

    abort(redirect()->away($url));

}
