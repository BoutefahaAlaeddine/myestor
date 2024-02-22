<?php
//هذا الملف لي يحدد لي الملفات نتاعوي باه نحملها في الصفحة

return [
  'template' => [
      "header" => TEMPLATE_PATH . DS . "header.php",
      "sidebar" => TEMPLATE_PATH . DS . "sidebar.php",
      "content" => TEMPLATE_PATH . DS . "content.php",
      ":view" => ":action_view",
      "footer" => TEMPLATE_PATH . DS . "footer.php",
  ],

  "Header_resources" => [
      "css" => [
          "myFramework" => "css/myFramework.css",
          "main" => "css/main.css",
          "main-ar" => "css/main.ar.css",
          "all.min" => "css/all.min.css",
          "datatable" => "css/datatable.css",
      ],
  ],

  "footer_resources" => [
      "js" => [
          "main" => "js/main.js",
          "datatable" => "js/datatable.js",
      ],
  ],
];
