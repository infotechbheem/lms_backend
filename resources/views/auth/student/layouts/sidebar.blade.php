 <!-- partial:partials/_sidebar.html -->
 <nav class="sidebar sidebar-offcanvas" id="sidebar">
     <ul class="nav">
         <li class="nav-item">
             <a class="nav-link" href="{{ route('student.dashboard') }}">
                 <i class="typcn typcn-device-desktop menu-icon"></i>
                 <span class="menu-title">Dashboard</span>
                 <div class="badge badge-danger">new</div>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="{{ route('student.course') }}">
                 <i class="typcn typcn-document-text menu-icon"></i>
                 <span class="menu-title">Course</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="{{ route('student.attendance') }}">
                 <i class="typcn typcn-document-text menu-icon"></i>
                 <span class="menu-title">Attendance</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                 <i class="typcn typcn-document-text menu-icon"></i>
                 <span class="menu-title">Live Classes</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                 <i class="typcn typcn-document-text menu-icon"></i>
                 <span class="menu-title">Recorded Course</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                 <i class="typcn typcn-document-text menu-icon"></i>
                 <span class="menu-title">Assignment</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                 <i class="typcn typcn-document-text menu-icon"></i>
                 <span class="menu-title">Notifications</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                 <i class="typcn typcn-document-text menu-icon"></i>
                 <span class="menu-title">Test</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" href="{{ route('student.profile') }}">
                 <i class="typcn typcn-document-text menu-icon"></i>
                 <span class="menu-title">Profile</span>
             </a>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-bs-toggle="modal" href="#ui-basic" data-bs-target="#changePassword">
                 <i class="typcn typcn-document-text menu-icon"></i>
                 <span class="menu-title">Change Password</span>
             </a>
         </li>

         <li class="nav-item">
             <a class="nav-link" href="{{ route('student.logout') }}">
                 <i class="typcn typcn-power-outline menu-icon"></i>
                 <span class="menu-title">Logout</span>
             </a>
         </li>
     </ul>
 </nav>
