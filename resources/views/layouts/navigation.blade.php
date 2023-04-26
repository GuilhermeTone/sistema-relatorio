<?php use Illuminate\Support\Facades\Auth; ?>
<style>
    .centralizar{
        text-align: center !important;
    }
    .esquerda{
        text-align: left !important;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8 flex justify-center">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    {{-- <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link> --}}
                    @if(Auth::user()->Cargo == 'admin')

                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out font-medium rounded-lg text-sm px-1 pt-1 pb-1.5 text-center inline-flex items-center" type="button">Menu<svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <x-nav-link :href="route('register')" class="px-3 py-3" :active="request()->routeIs('register')">
                                {{ __('Cadastrar Usuario') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('excluirUsuario')" class="px-3 py-3" :active="request()->routeIs('excluirUsuario')">
                                {{ __('Excluir Usuario') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('cadastrarProduto')" class="px-3 py-3" :active="request()->routeIs('cadastrarProduto')">
                                {{ __('Cadastrar Produtos') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('lojas')" class="px-3 py-3" :active="request()->routeIs('lojas')">
                                {{ __('Lojas') }}
                            </x-nav-link>
                        </li>
                         <li>
                            <x-nav-link :href="route('precos')" class="px-3 py-3" :active="request()->routeIs('precos')">
                                {{ __('Cadastro de Precos') }}
                            </x-nav-link>
                        </li>
                        </ul>
                    </div>
                  
                    
                    <x-nav-link :href="route('cadastrarPedido')" class="px-3 py-3" :active="request()->routeIs('cadastrarPedido')">
                        {{ __('Cadastrar Pedidos') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('editarProduto')" class="px-3 py-3" :active="request()->routeIs('editarProduto')">
                        {{ __('Editar Produtos') }}
                    </x-nav-link>
                  
                    <x-nav-link :href="route('ListagemPedidos')" class="px-3 py-3" :active="request()->routeIs('ListagemPedidos')">
                        {{ __('Listagem de Pedidos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('pedidosPosCompra')" class="px-3 py-3" :active="request()->routeIs('pedidosPosCompra')">
                        {{ __('Pedidos Pós Compra') }}
                    </x-nav-link>
                     
                     <x-nav-link :href="route('editarPrecos')" class="px-3 py-3" :active="request()->routeIs('editarPrecos')">
                        {{ __('Editar Preços') }}
                    </x-nav-link>
                    <x-nav-link :href="route('pedidosConfirmados')" class="px-3 py-3" :active="request()->routeIs('pedidosConfirmados')">
                        {{ __('Pedidos Confirmados') }}
                    </x-nav-link>
                    @endif
                    @if(Auth::user()->Cargo == 'gerente')
                        <x-nav-link :href="route('cadastrarPedido')" :active="request()->routeIs('cadastrarPedido')">
                            {{ __('Cadastrar Pedidos') }}
                        </x-nav-link>
                    @endif
                    @if(Auth::user()->Cargo == 'comprador')
                        <x-nav-link :href="route('ListagemPedidos')" :active="request()->routeIs('ListagemPedidos')">
                            {{ __('Listagem de Pedidos') }}
                        </x-nav-link>
                    @endif
                    @if(Auth::user()->Cargo == 'secretaria')
                         <x-nav-link :href="route('pedidosPosCompra')" :active="request()->routeIs('pedidosPosCompra')">
                        {{ __('Pedidos Pós Compra') }}
                        </x-nav-link>
                        <x-nav-link :href="route('precos')" :active="request()->routeIs('precos')">
                            {{ __('Cadastro de Precos') }}
                        </x-nav-link>
                        <x-nav-link :href="route('editarPrecos')" :active="request()->routeIs('editarPrecos')">
                            {{ __('Editar Preços') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pedidosConfirmados')" :active="request()->routeIs('pedidosConfirmados')">
                            {{ __('Pedidos Confirmados') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link> --}}

            @if(Auth::user()->Cargo == 'admin')
                    <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        {{ __('Cadastrar Usuario') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('excluirUsuario')" :active="request()->routeIs('Excluir')">
                        {{ __('Excluir Usuario') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('cadastrarPedido')" :active="request()->routeIs('cadastrarPedido')">
                        {{ __('Cadastrar Pedidos') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('cadastrarProduto')" :active="request()->routeIs('cadastrarProduto')">
                        {{ __('Cadastrar Produtos') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('editarProduto')" :active="request()->routeIs('editarProduto')">
                        {{ __('Editar Produtos') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('lojas')" :active="request()->routeIs('lojas')">
                        {{ __('Lojas') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('ListagemPedidos')" :active="request()->routeIs('ListagemPedidos')">
                        {{ __('Listagem de Pedidos') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('pedidosPosCompra')" :active="request()->routeIs('pedidosPosCompra')">
                        {{ __('Pedidos Pós Compra') }}
                    </x-responsive-nav-link>
                     <x-responsive-nav-link :href="route('precos')" :active="request()->routeIs('precos')">
                        {{ __('Cadastro de Precos') }}
                    </x-responsive-nav-link>
                     <x-responsive-nav-link :href="route('editarPrecos')" :active="request()->routeIs('editarPrecos')">
                        {{ __('Editar Preços') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('pedidosConfirmados')" :active="request()->routeIs('pedidosConfirmados')">
                        {{ __('Pedidos Confirmados') }}
                    </x-responsive-nav-link>
                    @endif
                    @if(Auth::user()->Cargo == 'gerente')
                        <x-responsive-nav-link :href="route('cadastrarPedido')" :active="request()->routeIs('cadastrarPedido')">
                            {{ __('Cadastrar Pedidos') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('pedidosConfirmados')" :active="request()->routeIs('pedidosConfirmados')">
                            {{ __('Pedidos Confirmados') }}
                        </x-responsive-nav-link>
                    @endif
                    @if(Auth::user()->Cargo == 'comprador')
                        <x-responsive-nav-link :href="route('ListagemPedidos')" :active="request()->routeIs('ListagemPedidos')">
                            {{ __('Listagem de Pedidos') }}
                        </x-responsive-nav-link>
                    @endif
                    @if(Auth::user()->Cargo == 'secretaria')
                         <x-responsive-nav-link :href="route('pedidosPosCompra')" :active="request()->routeIs('pedidosPosCompra')">
                        {{ __('Pedidos Pós Compra') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('precos')" :active="request()->routeIs('precos')">
                            {{ __('Cadastro de Precos') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('editarPrecos')" :active="request()->routeIs('editarPrecos')">
                            {{ __('Editar Preços') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('pedidosConfirmados')" :active="request()->routeIs('pedidosConfirmados')">
                            {{ __('Pedidos Confirmados') }}
                        </x-responsive-nav-link>
                    @endif

            {{-- <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        {{ __('Cadastrar Usuario') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('excluirUsuario')" :active="request()->routeIs('Excluir')">
                        {{ __('Excluir Usuario') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('cadastrarPedido')" :active="request()->routeIs('cadastrarPedido')">
                        {{ __('Cadastrar Pedidos') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('cadastrarProduto')" :active="request()->routeIs('cadastrarProduto')">
                        {{ __('Cadastrar Produtos') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('editarProduto')" :active="request()->routeIs('editarProduto')">
                        {{ __('Editar Produtos') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('lojas')" :active="request()->routeIs('lojas')">
                        {{ __('Lojas') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('ListagemPedidos')" :active="request()->routeIs('ListagemPedidos')">
                        {{ __('Listagem Pedidos') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('pedidosConfirmados')" :active="request()->routeIs('pedidosConfirmados')">
                        {{ __('Pedidos Confirmados') }}
                    </x-responsive-nav-link> --}}
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
<script
  src="https://code.jquery.com/jquery-3.6.4.slim.min.js"
  integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<!-- Biblioteca Buttons do DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>

<!-- Biblioteca JSZip (necessária para a exportação de dados para Excel) -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
<script>var TOKEN_CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');</script>
<script> var APP_URL = '{{url('')}}';</script>