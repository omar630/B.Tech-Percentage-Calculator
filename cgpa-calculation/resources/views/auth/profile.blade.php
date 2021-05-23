@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.save-profile') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name ?? old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ?? old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">
                            <small id="branchhelp" class="form-text text-muted">Enter below details correctly, your data(marks) will be saved according to this.</small>
                        </div>
                    </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Branch') }}</label>

                            <div class="col-md-6 ">
                                <select name="branch_id" class="browser-default custom-select mb-4" autofocus="">
                                  @php if(in_array($user->branch_id, $branches->pluck('id')->toArray())) $userBranch=$user->branch_id; else $userBranch = $branches[0]->id; @endphp
                                    @foreach($branches as $branch)
                                    <option value="{{$branch->id}}" @if($branch->id==$userBranch) selected="true" @endif>{{$branch->branch}}</option>
                                    @endforeach
                                </select>

                                @error('branch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Regulation') }}</label>

                            <div class="col-md-6 ">
                                <select name="regulation_id" class="browser-default custom-select mb-4" autofocus="">
                                  @php if(in_array($user->regulation_id, $regulations->pluck('id')->toArray())) $userRegulation=$user->regulation_id; else $userRegulation = $regulations[0]->id; @endphp
                                    @foreach($regulations as $regulation)
                                    <option value="{{$regulation->id}}" @if($regulation->id==$userRegulation) selected="true" @endif>{{$regulation->regulation}}</option>
                                    @endforeach
                                </select>

                                @error('regulation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
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
