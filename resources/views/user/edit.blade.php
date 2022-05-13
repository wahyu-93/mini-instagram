@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Profile {{ $user->username }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <x-form.input name="username" :object='$user'/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="fullname" class="col-md-4 col-form-label text-md-end">Fullname</label>

                            <div class="col-md-6">
                                <x-form.input name="fullname" type="fullname" :object='$user'/> 
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="bio" class="col-md-4 col-form-label text-md-end">Bio</label>

                            <div class="col-md-6">
                                <x-form.input name="bio" type="bio" :object='$user'/> 
                            </div>
                        </div>

                        <div class="row mb-3">
                            <x-uploadimage name="avatar"></x-uploadimage>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Profile
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
