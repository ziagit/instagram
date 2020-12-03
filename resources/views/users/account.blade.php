@extends('layouts.app')

@section('content')
<div class="container row">
    <div class="col-md-4"></div>
    <div class="col-md-6">
        <div class="card has-background-dark ml-25" style="margin-left: 10px;">
            <div class="card-body is-transparent">
            <h1 class="is-size-2 is-size-4-touch ">{{ __('My Account') }}</h1>
                    @if($errors->any())
            <div class="notification is-warning">
                <button class="delete"></button>
                <p>{{ $errors->first() }}</p>
            </div>
            @endif
                <form method="POST" action="{{ route('account.update') }}" enctype="multipart/form-data">

                    <!-- CSRF Token -->
                    @csrf

                    <!-- Method -->
                    @method('PATCH')

                    <div class="profile-settings">

                        <!-- Image Input -->
                        <div class="image-upload profile-image"
                        @if($user->social_path != "")
                        {{ "data-image=\"".$user->social_path."\"" }} 
                        @else
                        {{ "data-image=\"".asset("images/avatar/".$user->image)."\"" }}
                        @endif
                        >
                            <div class="file is-boxed">
                                <label class="file-label">
                                    <input class="file-input" type="file" name="image">
                                    <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fas fa-upload"></i>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="profile-inputs">
                            <!-- Display Name Input -->
                            <div class="field">
                                <label class="label ">{{ __('Display name') }}</label>
                                <div class="control">
                                    <input class="input" type="text" name="display_name" value="{{ isset($user->display_name) ? $user->display_name : '' }}"
                                        autofocus>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label ">{{ __('Biography') }}</label>
                                <div class="control">
                                    <textarea class="textarea has-fixed-size" name="biography" maxlength="128">{{ isset($user->biography) ? $user->biography : '' }}</textarea>
                                </div>
                            </div>

                            <!-- Email Input -->
                            <div class="field">
                                <label class="label ">{{ __('E-Mail Address') }}</label>
                                <div class="control">
                                    <input class="input" type="email" name="email" placeholder="john.doe@example.com" value="{{ $user->email }}"
                                        required>
                                </div>
                            </div>

                            <!-- Password Input -->
                            <div class="field">
                                <label class="label ">{{ __('Password') }}</label>
                                <div class="control">
                                    <input class="input" type="password" name="password" required>
                                </div>
                            </div>

                            <!-- New Password Input -->
                            <a class="has-text-primary mb" onclick="this.classList.add('is-hidden'); document.querySelector('#new-pass').classList.remove('is-hidden')">
                                {{ __('Change password?') }}
                            </a>
                            <div id="new-pass" class="field is-hidden">
                                <label class="label ">{{ __('New Password') }}</label>
                                <div class="control">
                                    <input class="input" type="password" name="new_password">
                                </div>
                            </div>

                            <!-- Submit button -->
                            <div class="field">
                                <div class="control">
                                    <button type="submit" class="button is-primary  is-large">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>


@endsection
