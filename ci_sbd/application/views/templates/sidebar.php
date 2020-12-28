<!-- Sidebar -->
<ul class="navbar-nav bg-success sidebar sidebar-dark accordion" bg-color="green" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-prescription-bottle-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Health Mart</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!--query menu-->
    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT `user_menu`.`id`, `menu` FROM `user_menu` JOIN `user_access_menu`
     ON `user_menu`.`id` = `user_access_menu`.`menu_id` 
     WHERE `user_access_menu`.`role_id` = $role_id 
     ORDER BY `user_access_menu`.`menu_id` ASC";
    $menu = $this->db->query($queryMenu)->result_array();
    ?>

    <!-- Looping Menu -->

    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading">
            <?= $m['menu']; ?>
        </div>
        <!-- Looping Menu -->
        <?php $querySubMenu =  "SELECT * FROM `user_menu` JOIN `user_sub_menu` 
        ON `user_menu`.`id` = `user_sub_menu`.`menu_id` 
        WHERE `user_menu`.`id` = {$m['id']}
        AND `user_sub_menu`.`is_active` = 1";
        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>

        <?php foreach ($subMenu as $sm) : ?>

            <?php if ($title == $sm['title']) : ?>
                <li class="nav-item active">

                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>

                <a class="nav-link" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
                </li>
            <?php endforeach; ?>

            <hr class="sidebar-divider">

        <?php endforeach; ?>


        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

</ul>
<!-- End of Sidebar -->