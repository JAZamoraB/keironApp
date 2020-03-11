@extends('layouts.app')


@section('title', 'Keirón | Principal')
@section('content')

<div class="container" style="min-height: 100vh;">
    <div class="row h-100 flex-column justify-content-center">
        <div class="col-auto py-4 py-md-5 mx-auto">
            <a href="{{route('welcome')}}">
                <img src="/assets/img/Imagotipo-fucsia.png">
            </a>
        </div>
        <div class="col text-white" style="font-family: OpenSans;">
            <i class="fas fa-info-circle"></i> Sesión iniciada como <span style="font-family: OpenSans-Bold;">{{Auth::user()->role->name}}</span>
        </div>
        <div class="col py-4 py-md-5 text-light">
            <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
                @if (Auth::user()->role->id != 1)
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true">Mis tickets</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
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
                @if (Auth::user()->role->id != 1)
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
                            @foreach (Auth::user()->tickets()->orderBy("name")->get() as $ticket)
                            <tr>
                                <th scope="row">{{$ticket->name}}</th>
                                <td>{{$ticket->created_at}}</td>
                                <td>@if ($ticket->used) Utilizado el {{$ticket->updated_at}} @else No @endif</td>
                                <td>
                                    @if ($ticket->used)
                                    <button disabled class="btn btn-sm btn-success">
                                        <i class="fas fa-check"></i>
                                        Ya se ha reclamado
                                    </button>
                                    @else   
                                    <button onclick="redeemTicket({{$ticket->id}})" class="btn btn-sm btn-info" style="font-family: Roboto-Bold;">
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

                @else
                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
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
                            @foreach (App\Ticket::orderby("name")->get() as $ticket)
                            <tr data-ticket="{{$ticket->id}}">
                                <th data-name>{{$ticket->name}}</th>
                                <td data-user>{{$ticket->user->name}}</td>
                                <td>@if ($ticket->used) Utilizado el {{$ticket->updated_at}} @else No @endif</td>
                                <td>
                                    <div class="btn-group btn-group-sm" style="font-family: Roboto;">
                                        @if (!$ticket->used)
                                            <button data-modalButton type="button" class="btn btn-info border-0" data-toggle="modal"
                                            data-target="#edit" data-value="{{json_encode($ticket)}}">
                                                <i class="fas fa-edit"></i> Editar
                                            </button>
                                        @endif
                                        <form action="{{route('tickets.destroy', $ticket->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger border-0">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                        </form>
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
@if (Auth::user()->role->id == 1)

<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTitle">Nuevo Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('tickets.store')}}" onsubmit="validateForm()" method="POST">
                <div class="modal-body">
                    @method('post')
                    @csrf
                    <div class="form-row ">
                        <div class="col">
                            <label for="Tname">Nombre Ticket</label>
                            <input type="text" class="form-control" placeholder="Nombre Ticket" id="Tname" name="Tname"
                                required>
                        </div>
                        <div class="col">
                            <label for="Tuser">Usuario</label>
                            <select name="Tuser" id="Tuser" class="form-control" required>
                                <option value="" selected disabled>Selecciona una opción</option>
                                @foreach (\App\User::where("role_id" , "<>", 1)->get() as $user)
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
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTitle">Editar Ticket <span class="font-family: Roboto-Bold;">Cupón 1</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    @method('patch')
                    @csrf
                    <div class="form-row">
                        <div class="col">
                            <label for="ETname">Nombre Ticket</label>
                            <input type="text" class="form-control" placeholder="Nombre Ticket" id="ETname" name="ETname"
                                required>
                        </div>
                        <div class="col">
                            <label for="ETuser">Usuario</label>
                            <select name="ETuser" id="ETuser" class="form-control" required>
                                <option value="" selected disabled>Selecciona una opción</option>
                                @foreach (\App\User::where("role_id", "<>", 1)->get() as $user)
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
@endif
@endsection

@section('js')
@if (Auth::user()->role->id == 1)
    <script>
        window.addEventListener("DOMContentLoaded", () => {
            $('#edit').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 
                var ticket = button.data('value'); 
                var modal = $(this)
                modal.find('.modal-title').text(`Editar Ticket #${ticket.id} ${ticket.name}`)
                modal.find(`#ETname`).val(ticket.name)
                modal.find(`#ETuser option[value=${ticket.user_id}]`).attr('selected', true)
                var form = modal.find('form')
                form.unbind();
                form.on({
                    submit: (event) => {
                        event.preventDefault();
                        var data = {
                            _method: 'patch',
                            id: ticket.id,
                            user: form.find("#ETuser").val(),
                            name: form.find("#ETname").val()
                        }
                        axios({
                            url: '/a/e/tickets',
                            method: 'patch',
                            data: data
                        }).then(res => {
                            if(res.data){
                                var ticket = res.data;
                                toastr.success("Registro Modificado Exitosamente.", "Cambios guardados");
                                var tr = $(`[data-ticket=${ticket.id}]`)
                                tr.find('[data-name]').html(ticket.name)
                                tr.find('[data-user]').html(ticket.user.name)
                                modal.modal("hide");
                                setTimeout(() => {
                                    window.location.reload()
                                }, 2000)
                            }else{
                                toastr.error("El nombre Ingresado ya está en uso.", "Error al guardar");
                            }
                        }).catch(err => {
                            toastr.error("Hubo un error al enviar, reintentar.", "Error al guardar");
                        })
                    }
                });
                // modal.find('.modal-body input').val(ticket)
            })
        })
        function validateForm(){
            event.preventDefault();
            var inputs = {
                name: event.target.querySelector("#Tname").value,
                user: event.target.querySelector("#Tuser").value,
            }
            console.log({form: event.target})
            axios({
                url: '/ticketValidation',
                method: "post",
                data: inputs,
            }).then(res => {
                console.log(res)
                if (!res.data) {
                    toastr.error(`El nombre del ticket (${inputs.name}) ya está en uso, por favor corregir campo.`, 'Nombre no disponible')
                } else {
                    axios({
                        url: "/a/tickets",
                        method: "post",
                        data: {
                            _method: "post",
                            name: inputs.name,
                            user: inputs.user
                        }
                    }).then(res => {
                        if( res.data ){
                            toastr.success(`Ticket '${inputs.name}' agregado y asignado correctamente.`, 'Agregado Correctamente.')
                            $("#create").modal("hide")
                            
                            setTimeout(() => {
                                    window.location.reload()
                                }, 2000)
                        }else{
                            toastr.error(`El nombre del ticket '${inputs.name}' ya está en uso, por favor corregir campo.`, 'Nombre no disponible')
                        }
                    }).catch(err => {
                        toastr.error(`Hubo un error al enviar el formulario, intentar nuevamente.`, 'Error al enviar')
                    })
                }
            }).catch(err => {
                toastr.error(`Hubo un error al enviar el formulario, intentar nuevamente.`, 'Error al enviar')
            })
        }
    </script>
@else
<script>
    function redeemTicket(ticketID){
        axios({
            url: `/a/a/redeemTicket/${ticketID}`,
            method: 'get'
        }).then( res => {
            if (res.data == 403){
                return toastr.info("No tienes permiso para canjear este Ticket.", "Ticket Incorrecto");
            }
            toastr.success("Ticket Canjeado correctamente.", "Activación Exitosa");
            setTimeout(() => {
                window.location.reload()
            }, 1000);
        }).catch( err => {
            toastr.error("Hubo un error al canjear, intentar nuevamente.", "Error al Activar");
        })
    }
</script>
@endif
@endsection