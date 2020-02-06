<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="nav-icon icon-home"></i>Home
                </a>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-people"></i> Pengelolaan Sivitas</a>
                <ul class="nav-dropdown-items">

                    {{-- Menu Dosen--}}
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <i class="nav-icon"></i>Dosen
                        </a>
                    </li>

                    {{-- Menu Mahasiswa--}}
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <i class="nav-icon"></i> Mahasiswa
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-people"></i> Pengelolaan Kelas</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kelaslecturer.index') }}">
                            <i class="nav-icon"></i> Kelas Matkul
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kelas.index') }}">
                            <i class="nav-icon"></i> List Kelas
                        </a>
                    </li>
                </ul>
            </li>


        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>

</div>
