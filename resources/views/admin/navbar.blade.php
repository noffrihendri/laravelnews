<?php //dd($lstModule); ?>
@extends('admin.themeadmin')
@section('navbar')

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ ( Auth::User()->image !== "") ? url(Auth::User()->image) : url ('/image/noimage.jpg') }}"
                class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ Auth::User()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php 
                    
                   // dd($isactive);
                    
                    foreach ($lstModule as $parent) { 
                       $selectedparent=''; 
                       $menuopen='';
                        foreach ($parent['Child'] as $Child) {
                            if($isactive == $Child['PermaLink']){
                                $selectedparent='active';
                                $menuopen='menu-open';
                            }
                        }
                        
                        ?>

            <li class="nav-item has-treeview {{$menuopen}}">
                <a href="#" class="nav-link {{$selectedparent}}">
                    <i class="nav-icon "></i>
                    <p>
                        <?= $parent['ModuleName'] ?>
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <?php 
                    $selected='';
                    foreach ($parent['Child'] as $Child) { 
                        
                        $selected = ($isactive == $Child['PermaLink']) ? 'active' :'';
                        
                        ?>

                    <li class="nav-item">
                        <a href="<?= url ("/" . $Child['PermaLink']); ?>" class="nav-link {{$selected}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?= $Child['ModuleName'] ?></p>
                        </a>
                    </li>

                    <?php } ?>
                </ul>
            </li>

            <?php } ?>



        </ul>
    </nav>



    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


            <li class="nav-item">


                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i>
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>


        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
@endsection