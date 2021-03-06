@extends('layouts.admin')

@section('content')

    <form action="{{ route('admin.briefs.update', $brief) }}" method="post">
        @csrf
        @method('patch')

        @foreach($brief->body as $group => $column)
            <h3>{{ \App\Models\Brief::$GROUPS[$group] }}</h3>

            <ul class="list-unstyled">
                @foreach($column as $key => $item)
                    <li class="mb-2">
                        <fieldset>
                            <legend class="mb-0 text-muted small">
                                {{ trans("page.brief.{$group}.{$key}") }}
                            </legend>

                            <textarea
                                name="{{ $group.'['.$key.']' }}"
                                rows="{{ strlen($item) > 100 ? '4' : (strlen($item) > 200 ? '6' : '') }}"
                                class="form-control"
                            >{{ $item }}</textarea>
                        </fieldset>
                    </li>
                @endforeach
            </ul>

            @if (!$loop->last)
                <hr>
            @endif
        @endforeach

        <div class="row align-items-end mt-4">
            <div class="col-auto">
                <button class="btn btn-primary">Обновить</button>
            </div>

            <div class="col-auto">
                <select name="status" id="status" class="form-control w-auto">
                    @foreach(\App\Models\Brief::$STATUSES as $key => $status)
                        <option value="{{ $key }}" {{ $brief->status === $key ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

@endsection
