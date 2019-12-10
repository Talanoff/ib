@extends('layouts.admin')

@section('content')

    <form action="{{ route('admin.users.update', $user) }}" method="post">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $user->name }}"
                   required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') ?? $user->email }}"
                   readonly disabled>
        </div>

        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" class="form-control"
                   value="{{ old('password') }}" required>
        </div>

        <div class="form-group">
            <label for="telegram_user_id">Telegram ID</label>
            <input type="text" name="telegram_user_id" id="telegram_user_id" class="form-control"
                   value="{{ old('telegram_user_id') ?? $user->telegram_user_id }}">
        </div>

        <div class="mt-4">
            <button class="btn btn-primary">Сохранить</button>
        </div>
    </form>

@endsection