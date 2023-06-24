@props(['list' => []])

<div class="hidden text-sm breadcrumbs text-slate-800 dark:text-slate-200 sm:inline-block">
    <ul>
        @if (!empty($list))
            @foreach ($list as $item)
                @if (is_array($item))
                    <li>
                        @if (!empty($item['link']))
                            <a href="{{ $item['link'] }}">{{ $item['name'] ?? '' }}</a>
                        @else
                            {{ $item['name'] ?? '' }}
                        @endif
                    </li>
                @else
                    <li>
                        {{ $item }}
                    </li>
                @endif
            @endforeach
        @endif
    </ul>
</div>
