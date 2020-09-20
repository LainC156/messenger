@extends('layouts.app')

@section('content')
<b-container>
    <b-row>
        <b-col cols="8">
            <b-card class="my-3" title="Registro">
                @if($errors->any())
                    <b-alert show variant="danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>                            
                            @endforeach
                        </ul>
                    </b-alert>
                @else
                    <b-alert show>
                        Por favor ingresa tus datos:
                    </b-alert>
                @endif

                <b-form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <b-form-group
                    label="Nombre"
                    label-for="name"
                    description="Ingresa tu nombre"
                    autofocus
                    >   
                        <b-form-input id="name"
                            name="name"
                            type="text"
                            required
                            autofocus
                            placeholder="Ingresa tu nombre completo"
                        ></b-form-input>
                    </b-form-group>

                    <b-form-group
                        id="input-group-1"
                        label="Correo electrónico"
                        label-for="email"
                        description="Ingresa tu correo electrónico"
                    >   <b-form-input
                            id="email"
                            name="email"
                            type="email"
                            required
                            placeholder="email@example.com"
                        ></b-form-input>
                    </b-form-group>

                    <b-form-group
                        id="input-group-1"
                        label="Contraseña"
                        label-for="password"
                        description="Ingresa tu contraseña"
                    >
                        <b-form-input
                            id="password"
                            name="password"
                            type="password"
                            required
                            placeholder="Ingresa tu contraseña"
                        ></b-form-input>
                    </b-form-group>
                    
                    <b-form-group
                        id="input-group-1"
                        label="Confirmar contraseña"
                        label-for="password_confirmation"
                        description="Reingresa tu contraseña"
                    >
                        <b-form-input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            placeholder="Reingresa tu contraseña"
                        ></b-form-input>
                    </b-form-group>

                    <b-button type="submit" variant="primary">Crear cuenta</b-button>
                    <b-button href="{{ route('login') }}" variant="link">¿ya tienes una cuenta?</b-button>

                </b-form>

            </b-card>
        </b-col>
    </b-row>
</b-container>

@endsection
