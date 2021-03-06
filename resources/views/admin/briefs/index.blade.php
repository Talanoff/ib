@extends('layouts.admin')

@section('content')

    <table class="table table-striped">
        <thead>
        <tr class="small">
            <th width="200">Дата заполнения</th>
            <th>Имя</th>
            <th width="140">Статус</th>
            <th width="80"></th>
        </tr>
        </thead>

        <tbody>
        @forelse($briefs as $brief)
            <tr>
                <td>{{ $brief->created_at->format('d.m.Y \в H:i') }}</td>
                <td>
                    <a href="{{ route('admin.briefs.edit', $brief) }}" class="underline">
                        {{ ucfirst($brief->body['contact']['f1']) }}
                    </a>
                </td>
                <td>
                    <span
                        class="py-1 px-2 small rounded bg-{{ $brief->status == 'progress' ? 'warning' : ($brief->status == 'finished' ? 'success' : 'danger') }}">
                            {{ \App\Models\Brief::$STATUSES[$brief->status] }}
                    </span>
                </td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.briefs.edit', $brief) }}" class="btn btn-warning btn-sm">
                            <svg width="14" height="14" fill="currentColor">
                                <use xlink:href="#edit"></use>
                            </svg>
                        </a>
                        <a href="{{ route('admin.briefs.destroy', $brief) }}"
                           class="btn btn-danger btn-sm"
                           onclick="deleteItem()"
                        >
                            <svg width="14" height="14" fill="currentColor">
                                <use xlink:href="#delete"></use>
                            </svg>
                        </a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Брифов пока нет...</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $briefs->links() }}

    @includeIf('partials.admin.common.deletion')

@endsection
