<!--
   los menus que no contengan sub-menu deben tener id.
   ejemplo:
   <li>
      <a href="otro" id="otro">
         <span class="flaticon-speedometer"></span>
         Otro
      </a>
   </li>
-->
<input type="hidden" name="url" id="url" value="http://127.0.0.1:8000/">
<nav id="sidebar">
   <div class="sidebar-header update_sidebar">
      <a href="http://demo.infixedu.com">
         <img src="" alt="logo">
      </a>
      <a id="close_sidebar" class="d-lg-none">
         <i class="ti-close"></i>
      </a>
   </div>
   <ul class="list-unstyled components">
      <li>
         <a href="/home" id="admin-dashboard">
            <span class="flaticon-speedometer"></span>
            Inicio
         </a>
      </li>
      <li>
         <a href="#subMenuProgramaticContent" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <span class="flaticon-inventory"></span>
            Organizar Curso
         </a>
         <ul class="collapse list-unstyled" id="subMenuProgramaticContent">
            <li>
               <a href="/gestionar-rubricas">Gestionar Rúbricas</a>
            </li>
            <li>
               <a href="#subMenuProgramaticContentTimes" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                  Tiempos y Temas
               </a>
               <ul class="collapse list-unstyled" id="subMenuProgramaticContentTimes">
                  <li>
                     <a href="/ciclo-o-periodo"> Ciclo o Periodo</a>
                  </li>
                  <li>
                     <a href="/temas"> Gestionar Temas</a>
                  </li>
               </ul>
            </li>
            <li>
               <a href="/fechas-importantes"> Fechas Importantes</a>
            </li>
         </ul>
      </li>
      <?php if(Auth::user()->id_rol == 1 || Auth::user()->id_rol == 2): ?>
         <li>
            <a href="#subMenuCursos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
               <span class="flaticon-analytics"></span>
               Cursos
            </a>
            <ul class="collapse list-unstyled" id="subMenuCursos">
               <li>
                  <a href="/cursos">Ver</a>
               </li>
               <li>
                  <a href="/crear_cursos">Crear</a>
               </li>
            </ul>
         </li>
      <?php endif; ?>
      <li>
         <a href="#subMenuRepositorio" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <span class="flaticon-analytics"></span>
            Repositorio
         </a>
         <ul class="collapse list-unstyled" id="subMenuRepositorio">
            <li>
               <a href="/tareas">Ver tareas</a>
            </li>
            <?php if(Auth::user()->id_rol == 4): ?>
               <li>
                  <a href="/agregar_tareas">Crear tarea</a>
               </li>
            <?php endif; ?>
            <li>
               <a href="/foros">Ver foros</a>
            </li>
            <?php if(Auth::user()->id_rol == 4): ?>
               <li>
                  <a href="/agregar_foro">Crear foros</a>
               </li>
            <?php endif; ?>
            <li>
               <a href="/examenes">Ver examenes</a>
            </li>
            <?php if(Auth::user()->id_rol == 4): ?>
               <li>
                  <a href="/agregar_examen">Crear examen</a>
               </li>
            <?php endif; ?>
         </ul>
      </li>
      <li>
         <a href="#subMenuNotas" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <span class=""></span>
            Notas y Reportes
         </a>
         <ul class="collapse list-unstyled" id="subMenuNotas">
            <li>
               <a href="/rubricas_mostrar">Rúbricas</a>
            </li>
            <li>
               <a href="/notas">Notas Parciales</a>
            </li>
            <li>
               <a href="#reportes" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">oTRO</a>
               <ul class="collapse list-unstyled" id="reportes">
                  <li>
                     <a href="/reporte_anual">Reporte Anual</a>
                  </li>
                  <li>
                     <a href="/reporte_periodo">Reporte por Periodo</a>
                  </li>
               </ul>
            </li>
         </ul>
      </li>
      <li>
         <a href="#subMenuSalas" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <span class="flaticon-analytics"></span>
            Audiovisual
         </a>
         <ul class="collapse list-unstyled" id="subMenuSalas">
            <li>
               <a href="/listar/sala">Listar</a>
            </li>
            <li>
               <a href="/crear/sala">Crear</a>
            </li>
         </ul>
      </li>
      <?php if(Auth::user()->id_rol == 1 || Auth::user()->id_rol == 2): ?>
         <li>
            <a href="#subMenuUsuarios" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
               <span class="flaticon-analytics"></span>
               Usuarios
            </a>
            <ul class="collapse list-unstyled" id="subMenuUsuarios">
               <li>
                  <a href="/usuarios">Ver</a>
               </li>
               <li>
                  <a href="/crear_usuarios">Crear</a>
               </li>
            </ul>
         </li>
      <?php endif; ?>
   </ul>
</nav><?php /**PATH C:\Users\Desarrollo3\Documents\Goova\repository_salon365\goova\resources\views/includes/sidebar.blade.php ENDPATH**/ ?>