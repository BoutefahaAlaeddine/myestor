<div class="sidebar p-rel trans">
  <div class="head col a-itm-cn pad-20">
    <img class="avatar" src="<?= MAIN_SRC ?>/img/user.png" alt="" />
    <h3 class="c-white d-block"><?=$this->session->u->profile->FirstName ." ".$this->session->u->profile->LastName  ?></h3>
    <span><?=$this->session->u->GroupName?></span>
  </div>
  <ul class="links t-trn-cp">
    <li  class="trans">
      <a class="c-white d-block pad-10" href="<?= MAIN_LINK . "index" ?>">
        <i class="fa-solid m-rig-5 fa-dashboard"></i>
        <span><?= $text_general_statistics ?></span>
      </a>
    </li>
    <li  class="trans">
      <div class="c-white d-block pad-10">
        <i class="fa-solid m-rig-5 fa-credit-card"></i>
        <span><?= $text_transactions ?></span>
      </div>
      <ul class="sub-links t-trn-cp  o-hidden trans">
        <li  class="trans">
          <a class="c-white d-block " href="">
            <i class="fa-solid m-rig-5 fa-cart-shopping"></i>
            <span><?= $text_transactions_purchases ?></span>
          </a>

        </li>
        <li  class="trans">
          <a class="c-white d-block " href="">
            <i class="fa-solid m-rig-5 fa-cash-register"></i>
            <span><?= $text_transactions_sales ?></span>
          </a>

        </li>
      </ul>
    </li>
    <li  class="trans">
      <div class="c-white d-block pad-10">
        <i class="fa-solid m-rig-5 fa-money-bill"></i>
        <span><?= $text_expenses ?></span>
      </div>
      <ul class="sub-links t-trn-cp  o-hidden trans">
        <li  class="trans">
          <a class="c-white d-block" href="">
            <i class="fa-solid m-rig-5 fa-layer-group"></i>
            <span><?= $text_expenses_categories ?></span>
          </a>

        </li>
        <li  class="trans">
          <a class="c-white d-block" href="">
            <i class="fa-solid m-rig-5 fa-coins"></i>
            <span><?= $text_expenses_daily_expenses ?></span>
          </a>

        </li>
      </ul>
    </li>
    <li  class="trans">
      <a class="c-white d-block pad-10" href="<?= MAIN_LINK . "store" ?>">
        <i class="fa-solid m-rig-5 fa-store"></i>
        <span><?= $text_store ?></span>
      </a>
    </li>
    <li  class="trans">
      <a class="c-white d-block pad-10" href="<?= MAIN_LINK . "client" ?>">
        <i class="fa-solid m-rig-5 fa-users-line"></i>
        <span><?= $text_clients ?></span>
      </a>
    </li>
    <li  class="trans">
      <div class="c-white d-block pad-10">
        <i class="fa-solid m-rig-5 fa-users"></i>
        <span><?= $text_users ?></span>
      </div>
      <ul class="sub-links t-trn-cp  o-hidden trans">
        <li  class="trans">
          <a class="c-white d-block" href="<?= MAIN_LINK . "user"?>">
            <i class="fa-solid m-rig-5 fa-circle-user"></i>
            <span><?= $text_users_list ?></span>
          </a>

        </li>
        <li  class="trans">
          <a class="c-white d-block " href="<?= MAIN_LINK . "usergroups"?>">
            <i class="fa-solid m-rig-5 fa-users-rectangle"></i>
            <span><?= $text_users_group ?></span>
          </a>
        </li>
        <li  class="trans">
          <a class="c-white d-block " href="<?= MAIN_LINK . "privilege"?>">
            <i class="fa-solid m-rig-5 fa-key"></i>
            <span><?= $text_users_privilege ?></span>
          </a>
        </li>
      </ul>
    </li>
    <li  class="trans">
      <a class="c-white d-block pad-10" href="<?= MAIN_LINK . "supplier" ?>">
        <i class="fa-solid m-rig-5 fa-truck-field"></i>
        <span><?= $text_suppliers ?></span>
      </a>
    </li>

    <li  class="trans">
      <a class="c-white d-block pad-10" href="<?= MAIN_LINK . "report" ?>">
        <i class="fa-solid m-rig-5 fa-bar-chart"></i>
        <span><?= $text_reports ?></span>
      </a>
    </li>
    <li  class="trans">
      <a class="c-white d-block pad-10" href="<?= MAIN_LINK . "notification" ?>">
        <i class="fa-solid m-rig-5 fa-bell"></i>
        <span><?= $text_notifications ?></span>
      </a>
    </li>
    <li  class="trans">
      <a class="c-white d-block pad-10" href="<?= MAIN_LINK . "auth/logout" ?>">
        <i class="fa-solid m-rig-5 fa-right-from-bracket"></i>
        <span><?= $text_log_out ?></span>
      </a>
    </li>
  </ul>
</div>