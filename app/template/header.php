</head>

<body class="f-cairo" data-lang="<?= $_SESSION["lang"] ?>">
  <div class="wrapper open-side">
    <div class="header t-trn-cp f-alg-sb c-white ">
      <div class="rightSide d-flex a-itm-cn">
        <i class="fa-solid fa-bars f-siz-20 c-pointer trans"></i>
        <h2><?= $text_dashboard ?><?=(isset($text_header))?' <i class="fa-solid header-arrow fa-chevron-left"></i> '.$text_header:''?></h2>
      </div>
      <ul class="leftSide d-flex">
        <li >
          <a class="c-white" href="<?= MAIN_LINK . "language" ?>">
            <i class="fa-solid fa-earth-americas"></i>
            <span><?= $text_change_language ?></span>
          </a>
        </li>
        <li><a class="c-white" href=""><i class="fa-solid fa-bell"></i></a></li>
        <li><a class="c-white" href=""><i class="fa-solid fa-envelope"></i></a></li>
        <li class="p-rel c-pointer">
          مرحبا عليلو <i class="fa-solid fa-angle-down"></i>
          <ul class="other p-abs b-white index-100 d-none">
            <li><a class="pad-10 d-block trans" href=""> <i class="fa-solid fa-user"></i> <?= $text_my_profile ?></a></li>
            <li><a class="pad-10 d-block trans" href=""><i class="fa-solid fa-key"></i> <?= $text_change_password ?></a></li>
            <li><a class="pad-10 d-block trans" href=""><i class="fa-solid fa-gear"></i> <?= $text_account_settings ?></a></li>
            <li><a class="pad-10 d-block trans" href=""><i class="fa-solid fa-right-from-bracket"></i> <?= $text_log_out ?></a></li>
          </ul>
        </li>

      </ul>
    </div>
    <div class="body d-flex">