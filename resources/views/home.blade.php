@extends('layouts.app')


@section('title', 'Keirón | Principal')
@section('content')

<div class="container" style="height: 100vh;">
    <div class="row h-100 flex-column justify-content-center">
        <div class="col-auto py-4 py-md-5 mx-auto">
            <a href="{{route('welcome')}}">
                <img src="/assets/img/Imagotipo-fucsia.png">
            </a>
        </div>
        <div class="col py-4 py-md-5 text-light">
            <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true">Mis tickets</a>
                </li>
                @if (Auth::user()->role->id == 1)
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                        aria-controls="pills-profile" aria-selected="false">Gestión de tickets</a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="javascript:void(0)" onclick="document.getElementById('logout').submit()" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        Salir
                    </a>
                    <form id="logout" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha Adquisición</th>
                                <th scope="col">Utilizado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody style="font-family: OpenSans !important;">
                            @foreach (Auth::user()->tickets as $ticket)
                            <tr>
                                <th scope="row">{{$ticket->name}}</th>
                                <td>{{$ticket->updated_at}}</td>
                                <td>{{$ticket->used}}</td>
                                <td>
                                    @if ($ticket->used)
                                    <button disabled class="btn btn-sm btn-success">
                                        <i class="fas fa-check"></i>
                                        Ya se ha reclamado
                                    </button>
                                    @else   
                                    <button class="btn btn-sm btn-info" style="font-family: Roboto-Bold;">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Utilizar
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if (Auth::user()->role->id == 1)
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Usuario Asignado</th>
                                <th scope="col">Utilizado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (App\Ticket::all() as $ticket)
                            <tr>
                                <th scope="row">{{$ticket->name}}</th>
                                <td>{{$ticket->user->name}}</td>
                                <td>{{$ticket->used}}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" style="font-family: Roboto;">
                                        <button type="button" class="btn btn-info border-0">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                        <button type="button" class="btn btn-danger border-0">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tbody>
                            <tr>
                                <th scope="row" colspan="4">
                                    <button class="btn btn-outline-super w-100" type="button" data-toggle="modal"
                                        data-target="#create" style="font-size: 1.5rem; font-family: Roboto-Bold;">
                                        <i class="fas fa-plus"></i>
                                        Crear Nuevo Ticket
                                    </button>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTitle">Nuevo Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('tickets.store')}}" method="POST">
                <div class="modal-body">
                    @method('post')
                    @csrf
                    <div class="form-row">
                        <div class="col">
                            <label for="Tname">Nombre Ticket</label>
                            <input type="text" class="form-control" placeholder="Nombre Ticket" id="Tname" name="Tname"
                                required>
                        </div>
                        <div class="col">
                            <label for="Tuser">Nombre Ticket</label>
                            <select name="Tuser" id="Tuser" class="form-control" required>
                                <option value="" selected disabled>Selecciona una opción</option>
                                @foreach (\App\User::all() as $user)
                                <option value="{{$user->id}}">{{$user->name}} - {{$user->email}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" style="font-size: 1.25rem; font-family: Roboto;"
                        class="btn btn-outline-secondary border-0" data-dismiss="modal">
                        <i class="fas fa-times"></i>
                        Cerrar
                    </button>
                    <button type="submit" style="font-size: 1.25rem; font-family: Roboto-Bold;" class="btn btn-super">
                        <i class="fas fa-save"></i>
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard {{Auth::user()->role->id}}</div>

<div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
    You are logged in!
</div>
</div>
</div>
</div>
</div> --}}
@endsection