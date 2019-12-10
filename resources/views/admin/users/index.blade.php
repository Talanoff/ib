@extends('layouts.admin')

@section('content')

    <table class="table table-striped">
        <thead>
        <tr class="small">
            <th>Имя</th>
            <th>Email</th>
            <th>Роль</th>
            <th>Telegram</th>
            <th width="80"></th>
        </tr>
        </thead>

        <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ __('roles.'.$user->role) }}</td>
                <td>
                    <div class="dot dot--{{ $user->telegram_user_id ? 'success' : 'warning' }}"></div>
                </td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">
                            <svg width="14" height="14" fill="currentColor">
                                <use xlink:href="#edit"></use>
                            </svg>
                        </a>
                        <a href="{{ route('admin.users.destroy', $user) }}" class="btn btn-danger btn-sm">
                            <svg width="14" height="14" fill="currentColor">
                                <use xlink:href="#delete"></use>
                            </svg>
                        </a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">...</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $users->links() }}

@endsection
