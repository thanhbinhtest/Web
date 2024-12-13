<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class App
    {
        protected $controller = "TrangChu";
        protected $action = "show";
        protected $para = [];

// Hàm __construct - thực hiện chức năng chính của hàm __construct

        function __construct()
        {
            $arr = $this->urlProcess();

            if (!empty($arr) && strtolower($arr[0]) == 'admin') {
                $checkUrl = implode('/', $arr);
                $arrCheckUrl = explode("/", $checkUrl);

                $checkUrl = $arrCheckUrl[0] . "/" . $arrCheckUrl[1];

                //  đường dẫn với Controllers 
                if (file_exists("./mvc/Controllers/" . $checkUrl . ".php")) {
                    $this->controller = $arr[1];
                    unset($arr[1]);
                }

               requireFileCaseInsensitive("./mvc/Controllers/" . $checkUrl . ".php");

                $this->controller = new $this->controller;

                if (isset($arr[2])) {
                    $this->action = $arr[2];
                    unset($arr[2]);
                }

                $this->para = $arr ? array_values($arr) : [];
                call_user_func_array([$this->controller, $this->action], $this->para);
            } else {
                if (isset($arr[0]) && file_exists("./mvc/Controllers/" . $arr[0] . ".php")) {
                    $this->controller = $arr[0];
                    unset($arr[0]);
                }

                require_once "./mvc/Controllers/" . $this->controller . ".php";
                $this->controller = new $this->controller;

                if (isset($arr[1])) {
                    $this->action = $arr[1];
                    unset($arr[1]);
                }

                $this->para = $arr ? array_values($arr) : [];
                call_user_func_array([$this->controller, $this->action], $this->para);
            }
        }

// Hàm urlProcess - thực hiện chức năng chính của hàm urlProcess
        function urlProcess()
        {
            if (isset($_GET["url"])) {
                $temp = filter_var(trim($_GET["url"], "/"));
                $result = explode("/", $temp);
                return $result;
            }
            return [];
        }
    }
    function requireFileCaseInsensitive($path) {
    $directory = dirname($path);
    $fileName = basename($path);
    $files = scandir($directory);

    foreach ($files as $file) {
        if (strcasecmp($file, $fileName) === 0) {
            require_once $directory . "/" . $file;
            return;
        }
    }

    throw new Exception("File không tồn tại: $path");
}

?>
