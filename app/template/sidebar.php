<div class="sidebar">
  <div class="head">
    <img class="avatar" src="<?= MAIN_SRC ?>/img/user.png" alt="" />
    <h3>علاء الدين</h3>
    <span><?= $text_app_manager ?></span>
  </div>
  <ul class="links">
    <li>
      <a href="<?= MAIN_LINK . "index" ?>">
        <i class="fa-solid fa-dashboard"></i>
        <span><?= $text_general_statistics ?></span>
      </a>
    </li>
    <li>
      <div>
        <i class="fa-solid fa-credit-card"></i>
        <span><?= $text_transactions ?></span>
      </div>
      <ul class="sub-links">
        <li>
          <a href="">
            <i class="fa-solid fa-cart-shopping"></i>
            <span><?= $text_transactions_purchases ?></span>
          </a>

        </li>
        <li>
          <a href="">
            <i class="fa-solid fa-cash-register"></i>
            <span><?= $text_transactions_sales ?></span>
          </a>

        </li>
      </ul>
    </li>
    <li>
      <div>
        <i class="fa-solid fa-money-bill"></i>
        <span><?= $text_expenses ?></span>
      </div>
      <ul class="sub-links">
        <li>
          <a href="">
            <i class="fa-solid fa-layer-group"></i>
            <span><?= $text_expenses_categories ?></span>
          </a>

        </li>
        <li>
          <a href="">
            <i class="fa-solid fa-coins"></i>
            <span><?= $text_expenses_daily_expenses ?></span>
          </a>

        </li>
      </ul>
    </li>
    <li>
      <a href="<?= MAIN_LINK . "store" ?>">
        <i class="fa-solid fa-store"></i>
        <span><?= $text_store ?></span>
      </a>
    </li>
    <li>
      <a href="<?= MAIN_LINK . "client" ?>">
        <i class="fa-solid fa-users-line"></i>
        <span><?= $text_clients ?></span>
      </a>
    </li>
    <li>
      <div>
        <i class="fa-solid fa-users"></i>
        <span><?= $text_users ?></span>
      </div>
      <ul class="sub-links">
        <li>
          <a href="<?= MAIN_LINK . "user"?>">
            <i class="fa-solid fa-circle-user"></i>
            <span><?= $text_users_list ?></span>
          </a>

        </li>
        <li>
          <a href="<?= MAIN_LINK . "usergroups"?>">
            <i class="fa-solid fa-users-rectangle"></i>
            <span><?= $text_users_group ?></span>
          </a>
        </li>
        <li>
          <a href="<?= MAIN_LINK . "privilege"?>">
            <i class="fa-solid fa-key"></i>
            <span><?= $text_users_privilege ?></span>
          </a>
        </li>
      </ul>
    </li>
    <li>
      <a href="<?= MAIN_LINK . "supplier" ?>">
        <i class="fa-solid fa-truck-field"></i>
        <span><?= $text_suppliers ?></span>
      </a>
    </li>

    <li>
      <a href="<?= MAIN_LINK . "report" ?>">
        <i class="fa-solid fa-bar-chart"></i>
        <span><?= $text_reports ?></span>
      </a>
    </li>
    <li>
      <a href="<?= MAIN_LINK . "notification" ?>">
        <i class="fa-solid fa-bell"></i>
        <span><?= $text_notifications ?></span>
      </a>
    </li>
    <li>
      <a href="<?= MAIN_LINK . "logout" ?>">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span><?= $text_log_out ?></span>
      </a>
    </li>
  </ul>
</div>