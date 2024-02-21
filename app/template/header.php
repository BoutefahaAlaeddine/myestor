</head>

<body data-lang="<?= $_SESSION["lang"] ?>">
  <div class="wrapper open-side">
    <div class="header">
      <div class="rightSide">
        <i class="fa-solid fa-bars "></i>
        <h2><?= $text_dashboard ?><?=(isset($text_header))?' <i class="fa-solid header-arrow fa-chevron-left"></i> '.$text_header:''?></h2>
      </div>
      <ul class="leftSide">
        <li>
          <a href="<?= MAIN_LINK . "language" ?>">
            <i class="fa-solid fa-earth-americas"></i>
            <span><?= $text_change_language ?></span>
          </a>
        </li>
        <li><a href=""><i class="fa-solid fa-bell"></i></a></li>
        <li><a href=""><i class="fa-solid fa-envelope"></i></a></li>
        <li>
          مرحبا عليلو <i class="fa-solid fa-angle-down"></i>

          <ul class="other">
            <li><i class="fa-solid fa-user"></i> <?= $text_my_profile ?></li>
            <li><i class="fa-solid fa-key"></i> <?= $text_change_password ?></li>
            <li><i class="fa-solid fa-gear"></i> <?= $text_account_settings ?></li>
            <li><i class="fa-solid fa-right-from-bracket"></i> <?= $text_log_out ?></li>
          </ul>
        </li>

      </ul>
    </div>
    <div class="body">