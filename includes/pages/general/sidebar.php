<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index3.html" class="brand-link">
      <img src="../dist/img/jayauto.png" alt="Jay Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Jay Auto Sales</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/<?php echo $myimage;?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $myname;?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <?php if ($myposition_id==1){?>
                <li class="nav-item">
                  <a href="../admin/dashboard.php" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../admin/employeelist.php" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                      Employee Management
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-car"></i>
                    <p>
                      Vehicle Management
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="../general/vehicles.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Vehicles</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="../general/vehiclemake.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Vehicle Maker</p>
                      </a>
                    </li>
              </li>
            </ul>
          </li>
          
               <?php }else{?>
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php }?>
          <li class="nav-header">Vehicle Store</li>
          <li class="nav-item">
            <a href="../general/store.php" class="nav-link">
              <i class="nav-icon fas fa-institution"></i>
              <p>In-Store Vehicle List
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../general/salesrecord.php" class="nav-link">
              <i class="nav-icon fas fa-records"></i>
              <p>Vehicle Sales List
              </p>
            </a>
          </li>
          
          <li class="nav-header">PERSONAL</li>
          <li class="nav-item">
            <a href="../general/profile.php" class="nav-link">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>My Profile</p>
            </a>
          </li>
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  