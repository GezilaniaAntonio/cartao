<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dash') }}">
                <i class="bi bi-columns-gap"></i>
                <span>Dashboard</span>
            </a>
        </li>

<!-- Gestão de Cartões -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#posicao-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-briefcase"></i>
                <span>Gestão de Cartões</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="posicao-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i>
                        <span>Listar</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i>
                        <span>Criar</span>
                    </a>
                </li>

            </ul>
        </li>

       {{--  <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#team-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i>
                <span>Gestão do Team</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="team-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i>
                        <span>Listar</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i>
                        <span>Criar</span>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#eventos-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-calendar-event"></i>
                <span>Gestão de Eventos</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="eventos-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i>
                        <span>Listar Eventos</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i>
                        <span>Criar Evento</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i>
                        <span>Inscrições</span>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#projetos-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-kanban"></i>
                <span>Gestão de Projetos</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="projetos-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i>
                        <span>Listar Projetos</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i>
                        <span>Criar Projeto</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i>
                        <span>Projetos Arquivados</span>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#voluntarios-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i>
                <span>Voluntários</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="voluntarios-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/admin/voluntarios">
                        <i class="bi bi-circle"></i>
                        <span>Listar Voluntários</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/voluntarios/aprovacoes">
                        <i class="bi bi-circle"></i>
                        <span>Aprovar Voluntários</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/voluntarios/atividades">
                        <i class="bi bi-circle"></i>
                        <span>Atividades</span>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#doacoes-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-cash-stack"></i>
                <span>Doações</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="doacoes-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/admin/doacoes">
                        <i class="bi bi-circle"></i>
                        <span>Listar Doações</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/doacoes/create">
                        <i class="bi bi-circle"></i>
                        <span>Registrar Doação</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/doacoes/relatorios">
                        <i class="bi bi-circle"></i>
                        <span>Relatórios Financeiros</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#relatorios-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bar-chart"></i>
                <span>Relatórios</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="relatorios-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/admin/relatorios/participacao">
                        <i class="bi bi-circle"></i>
                        <span>Participação</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/relatorios/arrecadacao">
                        <i class="bi bi-circle"></i>
                        <span>Arrecadação</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/relatorios/projetos">
                        <i class="bi bi-circle"></i>
                        <span>Projetos Ativos</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#usuarios-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person-gear"></i>
                <span>Usuários</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="usuarios-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/admin/usuarios">
                        <i class="bi bi-circle"></i>
                        <span>Gerenciar Usuários</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/usuarios/permissoes">
                        <i class="bi bi-circle"></i>
                        <span>Níveis de Acesso</span>
                    </a>
                </li>
            </ul>
        </li> --}}

    </ul>

</aside>
<!-- End Sidebar -->
