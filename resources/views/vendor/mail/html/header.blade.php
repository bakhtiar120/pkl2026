<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://www.indonesiapower.co.id/SiteAssets/logo.png" class="logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
