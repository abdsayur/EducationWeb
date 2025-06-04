@props([
'url',
'color' => 'primary',
'align' => 'center',
])
<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td align="center">
                        <a href="{{ $url }}" class="button button-primary"
                            style="color:#ffffff; background-color: #2eca7f;display: block;text-align: center; padding: 18px 44px; font-size: 16px; border-radius: 40px;border: none;font-weight: 500;margin-bottom: 20px;">
                            {{ $slot }}
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
