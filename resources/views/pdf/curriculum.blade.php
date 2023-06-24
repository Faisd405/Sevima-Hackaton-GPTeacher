<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        {{ $curriculum['name'] }}
    </title>

    <style>
        .text-center {
            text-align: center;
        }

        .text-justify {
            text-align: justify;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <section>
        <h1 class="text-center">
            {{ $curriculum['prompt'] }}
        </h1>
        <hr>
        <h4 class="text-center"></h4>
        {{ $curriculum['description'] }}
        </h4>
    </section>
    <div class="page-break"></div>
    <section>
        <h4 class="text-center">TABLE OF CONTENTS</h4>
        <ol>
            @foreach ($curriculum['curriculumDetails'] as $curriculumDetails)
                <li style="margin-bottom: 8px">
                    {{ $curriculumDetails['title'] }}
                </li>
            @endforeach
        </ol>
    </section>
    <div class="page-break"></div>
    @foreach ($curriculum['curriculumDetails'] as $curriculumDetails)
        <section>
            <h2 class="text-center">
                {{ $loop->iteration . '. ' . $curriculumDetails['title'] }}
            </h2>
            <div class="text-justify">
                {!! $curriculumDetails['content'] !!}
            </div>
        </section>

        @if ($loop->last)
        @break
    @endif
    <div class="page-break"></div>
@endforeach
</body>

</html>
