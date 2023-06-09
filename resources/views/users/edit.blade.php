@extends('master')
@section('content')
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">User Update</h3>
            </div>
            @if (session('error'))
                <div class="alert alert-danger text-center">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif
            <form action="{{ route('user.update') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="exampleInputFile">Avatar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="avatar" class="custom-file-input">
                                    <label class="custom-file-label" for="exampleInputFile">Choose avatar</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <img src="{{ asset( $user->avatar ? 'storage/images/'.Auth::user()->avatar : 'dist/img/user2-160x160.jpg') }}"
                                 alt="{{ $user->name }}">
                        </div>
                        @error('avatar')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirm">Password Confirm</label>
                        <input type="password" class="form-control" name="password_confirmation">
                        @error('password_confirm')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" cols="200"
                                  rows="10">{{$user->description}}</textarea>
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
