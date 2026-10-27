@extends('layouts.app')

@section('content')

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="container">
    <div class="imgLogo"><img src="{{ asset("images/logo_secretaria.png") }}" height="300" alt="Logo estado AC"></div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Insira os dados para acessar o sistema</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('matricula') ? ' has-error' : '' }}">
                            <label for="matricula" class="col-md-4 control-label">Matrícula</label>

                            <div class="col-md-6">
                                <input id="matricula" type="text" class="form-control" name="matricula" value="{{ old('matricula') }}" required autofocus>

                                @if ($errors->has('matricula'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('matricula') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <div class="g-recaptcha" data-sitekey="6LdogMEZAAAAAIEgvZPvvpGIaspdvB2FlMpDO02K"></div>
                                </div>
                                <div id="flashRetorno" class="col-md-8 col-md-offset-4">
                                </div>
                                <div class="col-md-8 col-md-offset-4">
                                    <br>
                                    <button type="submit" class="btn btn-primary">
                                        Entrar
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <a href="/password/reset">Esqueceu a senha?</a>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
<link href="{{ asset('css/login/login.css') }}" rel="stylesheet">
@endpush
@push('script')
<script src="{{ asset('js/auth/login.js') }}"></script>
@endpush