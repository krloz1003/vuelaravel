@extends('template.layout')
@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="columns personal-menu text-center vertical-center margin0">
            <div class="column">
                Zona de pruebas
            </div>
        </div>
        <div class="columns margin0 tile">
            <div class="column is-2 line-der">
                <aside class="menu">
                    <p class="menu-label">
                        Menu Principal
                    </p>
                    <ul class="menu-list">
                        <li @click="menu=0" class="hand-option"><a
                                    :class="{'is-active' : menu==0 }">Dashboard</a></li>
                        <li @click="menu=1" class="hand-option"><a :class="{'is-active' : menu==1 }">Departamentos</a>
                        </li>
                        <li @click="menu=2" class="hand-option"><a
                                    :class="{'is-active' : menu==2 }">Cargos</a></li>
                        <li @click="menu=3" class="hand-option"><a
                                    :class="{'is-active' : menu==3 }">Empleados</a></li>
                    </ul>
                </aside>
            </div>
            <div class="column personal-content" v-if="menu==0">
                <div class="columns text-center">
                    <div class="column">
                        <h3>Dashboard</h3>
                    </div>
                </div>
                <div class="columns text-center">
                    <div class="column">
                        <h1>Bienvenido</h1>
                    </div>
                </div>
            </div>
            <div class="column" v-if="menu==1">
                <div class="columns">
                    <div class="column text-center">
                        <h3>Departamentos</h3>
                    </div>
                    <div>
                        <a class="button is-success" @click="openModal('departure', 'create')">Agregar</a>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        Número de departamentos @{{departures.length}}
                        <div v-if="!departures.length">
                            no hay departamentos @{{departures.length}}
                        </div>
                        <table v-else class="table">
                            <thead>
                                <th>#</th>
                                <th>Titulo</th>
                                <th>Eliminar</th>
                            </thead>
                            <tbody>
                                <tr v-for="departure in departures">
                                    <td>@{{ departure.id }}</td>
                                    <td>@{{ departure.title }}</td>
                                    <td @click="openModal('departure','delete',departure)">
                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="column" v-if="menu==2">
                <div class="columns">
                    <div class="column text-center">
                        <h3>Cargos</h3>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                    Tabla Cargos
                    </div>
                </div>
            </div>
            <div class="column" v-if="menu==3">
                <div class="columns">
                    <div class="column text-center">
                        <h3>Empleado</h3>
                    </div>
                    <div class="column">
                    Tabla Empleados
                    </div>
                </div>
            </div>
        </div>
        <div class="columns margin0 text-center vertical-center personal-menu">
            <div class="column">Empleados 0</div>
            <div class="column">Departamentos 0</div>
            <div class="column">Cargo 0</div>
        </div>
    </div>
    <!-- Importando el modal departamento -->
    @include('complementos.modal_departure')
@endsection
@section('script')
<script>
    let elemento = new Vue({
        el: '.app',
        mounted: function () {
            // Las funciones que usemos dentro de mounted 
            // se ejecutaran al inicio de la aplicación
            this.allQuery();
        },
        data: {
            error: 'Probando que este tomando los datos',
            menu: 0,
            modalGeneral: 0,
            titleModal: '',
            messageModal: '',
            modalDeparture: 0,
            titleDeparture: '',
            errorTitleDeparture: 0,
            departures:[]
        },
        watch: {
            // watch simplemente es decirle al sistema que este atento
            // al cambio a una variable y haga algo cuando eso pasa
            modalGeneral: function (value) {
                if(!value) this.allQuery();
            }
        },
        methods: {
            closeModal() {
                this.modalGeneral = 0;
                this.titleModal = '';
                this.messageModal = '';
            },
            createDeparture() {                
                if (this.titleDeparture == '') {
                    this.errorTitleDeparture = 1;
                    return;
                }
                // Asociar this a la variable me, para evitar referenciar
                // al objeto de axios.
                let me = this;
                
                axios.post('{{route('departurecreate')}}', {
                    'title': this.titleDeparture
                })
                .then(function (response) {
                    me.titleDeparture = '';
                    me.errorTitleDeparture = 0;
                    me.modalDeparture = 0;
                    me.closeModal();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            openModal(type, action, data = []) {
                switch (type) {
                    case "departure":
                        {
                            switch (action) {
                                case 'create':
                                    {
                                        this.modalGeneral = 1;
                                        this.titleModal = 'Creación de departamento';
                                        this.messageModal = 'Ingrese el título del departamento';
                                        this.modalDeparture = 1;
                                        this.titleDeparture = '';
                                        this.errorTitleDeparture = 0;
                                        break;
                                    }
                                case 'update':
                                    {
                                        break;
                                    }
                                case 'delete':
                                    {
                                        this.titleModal = 'Eliminación del departamento';
                                        this.messageModal = 'Titulo del departamento';
                                        this.modalDeparture = 3;
                                        this.modalGeneral = 1;
                                        this.titleDeparture = data['title'];
                                        this.idDeparture = data['id'];
                                        break;
                                    }           

                            }
                            break;
                        }
                    case "position":
                        {
                            switch (action) {
                                case 'create':
                                    {

                                        break;
                                    }
                                case 'update':
                                    {
                                        break;
                                    }
                                case 'delete':
                                    {
                                        break;
                                    }

                            }
                            break;
                        }
                    case "employee":
                        {
                            switch (action) {
                                case 'create':
                                    {

                                        break;
                                    }
                                case 'update':
                                    {
                                        break;
                                    }
                                case 'delete':
                                    {
                                        break;
                                    }

                            }
                            break;
                        }
                }
            },
            allQuery() {
                let me = this;
                axios.get('{{ route('allQuery') }}')
                    .then(function (response) {
                        console.log(response);
                        let answer = response.data;
                        me.departures = answer.departures;
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            destroyDeparture() {
                let me = this;
                axios.delete('{{url('/departure/delete')}}'+'/'+this.idDeparture)
                    .then(function (response) {
                        me.idDeparture = 0;
                        me.titleDeparture = '';
                        me.modalDeparture = 0;
                        me.closeModal();
                    })
                    .catch(function (error) {
                        console.log('error: '+error);
                    })
            }
        },
    })
</script>
@endsection