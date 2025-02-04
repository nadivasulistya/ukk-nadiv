@extends('layouts.appUser')

@section('content')
<style>
    .profile-container {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .profile-section {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(37, 117, 252, 0.1);
        margin-bottom: 25px;
        overflow: hidden;
        border: 1px solid #e8f0fe;
    }

    .section-header {
        background: #e8f0fe;
        padding: 15px 20px;
        margin: 0;
        font-size: 18px;
        color: #1a73e8;
        border-bottom: 2px solid #c2d7ff;
        font-weight: 600;
    }

    .avatar-upload {
        display: flex;
        align-items: center;
        gap: 30px;
        padding: 20px;
        background: #f8fbff;
    }

    .current-avatar-container img {
        border-radius: 50%;
        box-shadow: 0 4px 15px rgba(37, 117, 252, 0.2);
        border: 3px solid #e8f0fe;
        transition: transform 0.3s ease;
    }

    .current-avatar-container img:hover {
        transform: scale(1.05);
    }

    .upload-controls {
        flex: 1;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(37, 117, 252, 0.1);
    }

    .btn-custom {
        background: linear-gradient(135deg, #2575fc, #1a73e8);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 500;
        box-shadow: 0 2px 10px rgba(37, 117, 252, 0.2);
    }

    .btn-custom:hover {
        background: linear-gradient(135deg, #1a73e8, #1557b0);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(37, 117, 252, 0.3);
        color: white;
    }

    .form-control {
        border: 2px solid #e8f0fe;
        border-radius: 8px;
        padding: 8px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #2575fc;
        box-shadow: 0 0 0 0.2rem rgba(37, 117, 252, 0.25);
    }

    .alert-success {
        background-color: #e8f5e9;
        border-color: #c8e6c9;
        color: #2e7d32;
        border-radius: 8px;
    }

    .p-4 {
        background: #f8fbff;
    }
</style>

<div class="profile-container">
    <!-- Profile Information Section -->
    <div class="profile-section">
        <h3 class="section-header">{{ __('Profile Information') }}</h3>
        <div class="p-4">
            @include('profileUser.partials.update-profile-information-form')
        </div>
    </div>

    <!-- Avatar Upload Section -->
    <div class="profile-section">
        <h3 class="section-header">{{ __('Profile Picture') }}</h3>
        <div class="p-4">
            <form method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="avatar-upload">
                    <div class="current-avatar-container">
                        @if(Auth::user()->avatar)
                            <img class="current-avatar" src="/avatars/{{ Auth::user()->avatar }}" alt="Current Avatar" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                            <img class="current-avatar" src="{{ asset('/img/default_profile.png') }}" alt="Default Avatar" style="width: 100px; height: 100px; object-fit: cover;">
                        @endif
                    </div>
                    
                    <div class="upload-controls">
                        <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" required>
                        @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button type="submit" class="btn btn-custom mt-3">
                            {{ __('Update Profile Picture') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Password Update Section -->
    <div class="profile-section">
        <h3 class="section-header">{{ __('Update Password') }}</h3>
        <div class="p-4">
            @include('profileUser.partials.update-password-form')
        </div>
    </div>

    <!-- Delete Account Section -->
    <div class="profile-section">
        <h3 class="section-header">{{ __('Delete Account') }}</h3>
        <div class="p-4">
            @include('profileUser.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection