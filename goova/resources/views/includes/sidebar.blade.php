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
            <a href="/" id="admin-dashboard">
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
                   <a href="rubricas"> Rubricas</a>
               </li>
               <li>
                   <a href="ciclo-o-periodo"> Ciclo o Periodo</a>
               </li>
               <li>
                   <a href="fechas-importantes"> Fechas Importantes</a>
               </li>
           </ul>
       </li>

      <!-- Student Panel -->
      <!-- End student panel -->
      <!-- Parents Panel Menu -->
      <!-- End Parents Panel Menu -->
   </ul>
</nav>
