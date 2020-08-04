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

      <li>
         <a href="#subMenuRepositorio" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <span class="flaticon-analytics"></span>
            Repositorio
         </a>
         <ul class="collapse list-unstyled" id="subMenuRepositorio">
            <li>
               <a href="agregar_tareas">Crear Repositorio</a>
            </li>
            {{-- <li>
               <a href="#otro" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">oTRO</a>
               <ul class="collapse list-unstyled" id="otro">
                  <li>
                     <a href="visitor">fgfhs</a>
                  </li>
               </ul>
            </li> --}}
         </ul>
      </li>
      <li>
         <a href="#subMenuConfiguracion" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <span class="flaticon-analytics"></span>
            Configuraciòn
         </a>
         <ul class="collapse list-unstyled" id="subMenuConfiguracion">
            <li>
               <a href="#usuarios" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Usuarios</a>
               <ul class="collapse list-unstyled" id="usuarios">
                  <li>
                     <a href="usuarios">Ver</a>
                  </li>
                  <li>
                     <a href="crear_usuarios">Crear</a>
                  </li>
               </ul>
            </li>
         </ul>
      </li>
      {{-- <li>
         <a href="admin-dashboard" id="admin-dashboard" class="active">
            <span class="flaticon-speedometer"></span>
            Dashboard
         </a>
      </li>
      <li>
         <a href="#subMenuAdmin" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <span class="flaticon-analytics"></span>
            Admin Section
         </a>
         <ul class="collapse list-unstyled" id="subMenuAdmin">
            <li>
               <a href="admission-query">Admission Query</a>
            </li>
            <li>
               <a href="visitor">Visitor Book </a>
            </li>
            <li>
               <a href="complaint">Complaint</a>
            </li>
            <li>
               <a href="postal-receive">Postal Receive</a>
            </li>
            <li>
               <a href="postal-dispatch">Postal Dispatch</a>
            </li>
            <li>
               <a href="phone-call">Phone Call Log</a>
            </li>
            <li>
               <a href="setup-admin">Admin Setup</a>
            </li>
            <li>
               <a href="student-certificate">Student Certificate</a>
            </li>
            <li>
               <a href="generate-certificate">Generate Certificate</a>
            </li>
            <li>
               <a href="student-id-card">Student ID Card</a>
            </li>
            <li>
               <a href="generate-id-card">Generate ID Card</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="#subMenuStudent" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
         <span class="flaticon-reading"></span>
         Student Info                    </a>
         <ul class="collapse list-unstyled" id="subMenuStudent">
            <li>
               <a href="student-category"> Student Category</a>
            </li>
            <li>
               <a href="student-list"> Student List</a>
            </li>
            <li>
               <a href="student-attendance"> Student Attendance</a>
            </li>
            <li>
               <a href="student-attendance-report"> Student Attendance Report</a>
            </li>
            <li>
               <a href="subject-wise-attendance"> Subject Wise Attendance </a>
            </li>
            <li>
               <a href="subject-attendance-report"> Subject Attendance Report </a>
            </li>
            <li>
               <a href="student-admission">Student Admission</a>
            </li>
            <li>
               <a href="student-group">Student Group</a>
            </li>
            <li>
               <a href="student-promote">Student Promote</a>
            </li>
            <li>
               <a href="disabled-student">Disabled Students</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="#subMenuAcademic" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
         <span class="flaticon-graduated-student"></span>
         Academics                    </a>
         <ul class="collapse list-unstyled" id="subMenuAcademic">
            <li>
               <a href="optional-subject"> Optional Subject </a>
            </li>
            <li>
               <a href="section"> Section</a>
            </li>
            <li>
               <a href="class"> Class</a>
            </li>
            <li>
               <a href="subject"> Subjects</a>
            </li>
            <li>
               <a href="class-room"> Class Room</a>
            </li>
            <li>
               <a href="class-time"> Cl/Ex Time Setup</a>
            </li>
            <li>
               <a href="assign-class-teacher"> Assign Class Teacher</a>
            </li>
            <li>
               <a href="assign-subject"> Assign Subject</a>
            </li>
            <li>
               <a href="class-routine-new"> Class Routine</a>
            </li>
            <!-- only for teacher -->
         </ul>
      </li>
      <li>
         <a href="#subMenuTeacher" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
         <span class="flaticon-professor"></span>
         Study Material                    </a>
         <ul class="collapse list-unstyled" id="subMenuTeacher">
            <li>
               <a href="upload-content"> Upload Content</a>
            </li>
            <li>
               <a href="assignment-list">Assignment</a>
            </li>
            <li>
               <a href="syllabus-list">Syllabus</a>
            </li>
            <li>
               <a href="other-download-list">Other Downloads</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="#subMenuFeesCollection" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
         <span class="flaticon-wallet"></span>
         Fees Collection                        </a>
         <ul class="collapse list-unstyled" id="subMenuFeesCollection">
            <li>
               <a href="fees-group"> Fees Group</a>
            </li>
            <li>
               <a href="fees-type"> Fees Type</a>
            </li>
            <li>
               <a href="fees-discount"> Fees Discount</a>
            </li>
            <li>
               <a href="fees-master"> Fees Master</a>
            </li>
            <li>
               <a href="collect-fees"> Collect Fees</a>
            </li>
            <li>
               <a href="search-fees-payment"> Search Fees Payment</a>
            </li>
            <li>
               <a href="search-fees-due"> Search Fees Due</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="#subMenuAccount" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
         <span class="flaticon-accounting"></span>
         Accounts                    </a>
         <ul class="collapse list-unstyled" id="subMenuAccount">
            <li>
               <a href="chart-of-account"> Chart Of Account</a>
            </li>
            <li>
               <a href="bank-account"> Bank Account</a>
            </li>
            <li>
               <a href="add-income"> Income</a>
            </li>
            <li>
               <a href="profit"> Profit</a>
            </li>
            <li>
               <a href="add-expense"> Expense</a>
            </li>
            <li>
               <a href="search-account"> Search</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="#subMenuHumanResource" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
         <span class="flaticon-consultation"></span>
         Human resource                    </a>
         <ul class="collapse list-unstyled" id="subMenuHumanResource">
            <li>
               <a href="designation"> Designation</a>
            </li>
            <li>
               <a href="department"> Department</a>
            </li>
            <li>
               <a href="staff-directory"> Staff Directory</a>
            </li>
            <li>
               <a href="staff-attendance"> Staff Attendance</a>
            </li>
            <li>
               <a href="staff-attendance-report"> Staff Attendance Report</a>
            </li>
            <li>
               <a href="payroll"> Payroll</a>
            </li>
            <li>
               <a href="payroll-report"> Payroll Report</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="#subMenuLeaveManagement" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
         <span class="flaticon-slumber"></span>
         Leave                    </a>
         <ul class="collapse list-unstyled" id="subMenuLeaveManagement">
            <li>
               <a href="leave-type"> Leave type</a>
            </li>
            <li>
               <a href="leave-define"> Leave Define</a>
            </li>
            <li>
               <a href="approve-leave">Approve Leave Request</a>
            </li>
            <li>
               <a href="pending-leave">Pending Leave</a>
            </li>
            <li>
               <a href="apply-leave">Apply Leave</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="#subMenuExam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
         <span class="flaticon-test"></span>
         Examination                    </a>
         <ul class="collapse list-unstyled" id="subMenuExam">
            <li>
               <a href="marks-grade"> Marks Grade</a>
            </li>
            <li>
               <a href="exam-type"> Add Exam Type</a>
            </li>
            <li>
               <a href="exam"> Exam Setup</a>
            </li>
            <li>
               <a href="exam-schedule"> Exam Schedule</a>
            </li>
            <li>
               <a href="exam-attendance"> Exam Attendance</a>
            </li>
            <li>
               <a href="marks-register"> Marks Register</a>
            </li>
            <li>
               <a href="send-marks-by-sms"> Send Marks By Sms</a>
            </li>
            <li>
               <a href="question-group">Question Group</a>
            </li>
            <li>
               <a href="question-bank">Question Bank</a>
            </li>
            <li>
               <a href="online-exam">Online Exam</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="#subMenuHomework" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
         <span class="flaticon-book"></span>
         HomeWork                    </a>
         <ul class="collapse list-unstyled" id="subMenuHomework">
            <li>
               <a href="add-homeworks"> Add Homework</a>
            </li>
            <li>
               <a href="homework-list"> Homework List</a>
            </li>
            <li>
               <a href="evaluation-report"> Homework Evaluation Report</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="#subMenuCommunicate" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
         <span class="flaticon-email"></span>
         Communicate                    </a>
         <ul class="collapse list-unstyled" id="subMenuCommunicate">
            <li>
               <a href="notice-list">Notice Board</a>
            </li>
            <li>
               <a href="send-email-sms-view">Send Email / Sms</a>
            </li>
            <li>
               <a href="email-sms-log">Email / Sms Log</a>
            </li>
            <li>
               <a href="event">Event</a>
            </li>
            <li>
               <a href="sms-template-new">lang.sms_template</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="#subMenulibrary" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
         <span class="flaticon-book-1"></span>
         Library                    </a>
         <ul class="collapse list-unstyled" id="subMenulibrary">
            <li>
               <a href="book-category-list"> Book Categories</a>
            </li>
            <li>
               <a href="add-book"> Add Book</a>
            </li>
            <li>
               <a href="book-list"> Book List</a>
            </li>
            <li>
               <a href="library-member"> Add Member</a>
            </li>
            <li>
               <a href="member-list"> Issue/Return Book</a>
            </li>
            <li>
               <a href="all-issed-book"> All Issued Book</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="#subMenuInventory" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
         <span class="flaticon-inventory"></span>
         Inventory                    </a>
         <ul class="collapse list-unstyled" id="subMenuInventory">
            <li>
               <a href="item-category"> Item Category</a>
            </li>
            <li>
               <a href="item-list"> Item List</a>
            </li>
            <li>
               <a href="item-store"> Item Store</a>
            </li>
            <li>
               <a href="suppliers"> Supplier</a>
            </li>
            <li>
               <a href="item-receive"> Item Receive</a>
            </li>
            <li>
               <a href="item-receive-list"> Item Receive List</a>
            </li>
            <li>
               <a href="item-sell-list"> Item Sell</a>
            </li>
            <li>
               <a href="item-issue"> Item Issue</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="#subMenuTransport" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
         <span class="flaticon-bus"></span>
         Transport                    </a>
         <ul class="collapse list-unstyled" id="subMenuTransport">
            <li>
               <a href="transport-route"> Routes</a>
            </li>
            <li>
               <a href="vehicle"> Vehicle</a>
            </li>
            <li>
               <a href="assign-vehicle"> Assign Vehicle</a>
            </li>
            <li>
               <a href="student-transport-report"> Student Transport Report</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="#subMenuDormitory" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
         <span class="flaticon-hotel"></span>
         Dormitory                    </a>
         <ul class="collapse list-unstyled" id="subMenuDormitory">
            <li>
               <a href="room-type"> Room Type</a>
            </li>
            <li>
               <a href="dormitory-list"> Dormitory</a>
            </li>
            <li>
               <a href="room-list"> Dormitory Rooms</a>
            </li>
            <li>
               <a href="student-dormitory-report"> Student Dormitory Report</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="#subMenusystemReports" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
         <span class="flaticon-analysis"></span>
         Reports                    </a>
         <ul class="collapse list-unstyled" id="subMenusystemReports">
            <li>
               <a href="student-report">Student Report</a>
            </li>
            <li>
               <a href="guardian-report">Guardian Reports</a>
            </li>
            <li>
               <a href="student-history">Student History</a>
            </li>
            <li>
               <a href="student-login-report">Student Login Report</a>
            </li>
            <li>
               <a href="fees-statement">Fees Statement</a>
            </li>
            <li>
               <a href="balance-fees-report">Balance Fees Report</a>
            </li>
            <li>
               <a href="transaction-report">Transaction Report</a>
            </li>
            <li>
               <a href="class-report">Class Report</a>
            </li>
            <li>
               <a href="class-routine-report">Class Routine</a>
            </li>
            <li>
               <a href="exam-routine-report">Exam Routine</a>
            </li>
            <li>
               <a href="teacher-class-routine-report">Teacher Class Routine</a>
            </li>
            <li>
               <a href="merit-list-report">Merit List Report</a>
            </li>
            <li>
               <a href="custom-merit-list">custom Merit List Report</a>
            </li>
            <li>
               <a href="online-exam-report">Online Exam Report</a>
            </li>
            <li>
               <a href="mark-sheet-report-student">Mark Sheet Report</a>
            </li>
            <li>
               <a href="tabulation-sheet-report">Tabulation Sheet Report</a>
            </li>
            <li>
               <a href="progress-card-report">Progress card report</a>
            </li>
            <li>
               <a href="custom-progress-card"> Custom Progress card report</a>
            </li>
            <li>
               <a href="student-fine-report">Student Fine Report</a>
            </li>
            <li>
               <a href="user-log">User Log</a>
            </li>
            <li>
               <a href="previous-class-results">Previous result </a>
            </li>
            <li>
               <a href="previous-record">Previous Record </a>
            </li>
         </ul>
      </li>
      <li>
         <a href="#subMenusystemSettings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
         <span class="flaticon-settings"></span>
         System Settings                    </a>
         <ul class="collapse list-unstyled" id="subMenusystemSettings">
            <li>
               <a href="general-settings"> General Settings</a>
            </li>
            <li>
               <a href="rolepermission/role">Role</a>
            </li>
            <li>
               <a href="login-access-control">Login Permission</a>
            </li>
            <li>
               <a href="optional-subject-setup">Optional Subject</a>
            </li>
            <li>
               <a href="academic-year">Academic Year</a>
            </li>
            <li>
               <a href="custom-result-setting">Custom Result Setting</a>
            </li>
            <li>
               <a href="holiday">Holiday</a>
            </li>
            <li>
               <a href="weekend">Weekend</a>
            </li>
            <li>
               <a href="manage-adons">Module manager</a>
            </li>
            <li>
               <a href="manage-currency">Manage Currency</a>
            </li>
            <li>
               <a href="email-settings">Email Settings</a>
            </li>
            <li>
               <a href="payment-method"> Payment Method</a>
            </li>
            <li>
               <a href="payment-method-settings">Payment Method Settings</a>
            </li>
            <li>
               <a href="base-setup">Base Setup</a>
            </li>
            <li>
               <a href="language-list">Language</a>
            </li>
            <li>
               <a href="language-settings">Language Settings</a>
            </li>
            <li>
               <a href="backup-settings">Backup</a>
            </li>
            <li>
               <a href="sms-settings">Sms Settings</a>
            </li>
            <li>
               <a href="button-disable-enable">Button Manage </a>
            </li>
            <li>
               <a href="about-system">About</a>
            </li>
            <li>
               <a href="update-system">Update</a>
            </li>
            <li>
               <a href="templatesettings/email-template">Email Template</a>
            </li>
            <li>
               <a href="api/permission">API Permission </a>
            </li>
         </ul>
      </li>
      <li>
         <a href="#subMenusystemStyle" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
         <span class="flaticon-settings"></span>
         Style                    </a>
         <ul class="collapse list-unstyled" id="subMenusystemStyle">
            <li>
               <a href="background-setting">Background Settings</a>
            </li>
            <li>
               <a href="color-style">Color Theme</a>
            </li>
         </ul>
      </li>
      <li>
         <a href="#subMenufrontEndSettings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
         <span class="flaticon-software"></span>
         Front Settings                        </a>
         <ul class="collapse list-unstyled" id="subMenufrontEndSettings">
            <li>
               <a href="admin-home-page"> Home Page </a>
            </li>
            <li>
               <a href="news">News List</a>
            </li>
            <li>
               <a href="news-category">News Category</a>
            </li>
            <li>
               <a href="testimonial">Testimonial</a>
            </li>
            <li>
               <a href="course-list">Course List</a>
            </li>
            <li>
               <a href="contact-page">Contact Page </a>
            </li>
            <li>
               <a href="contact-message">Contact Message</a>
            </li>
            <li>
               <a href="about-page"> About Us </a>
            </li>
            <li>
               <a href="news-heading-update">News Heading</a>
            </li>
            <li>
               <a href="course-heading-update">Course Heading</a>
            </li>
            <li>
               <a href="custom-links"> Custom Links </a>
            </li>
            <li>
               <a href="social-media"> Social Media </a>
            </li>
         </ul>
      </li> --}}
   </ul>
</nav>
