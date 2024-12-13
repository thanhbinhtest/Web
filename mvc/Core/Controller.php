<?php
    Class controller{
// Hàm model - thực hiện chức năng chính của hàm model
        function model($model)
        {
            require_once "./mvc/Models/".$model.".php";

            return new $model;
        }

// Hàm modelAdmin - thực hiện chức năng chính của hàm modelAdmin
        function modelAdmin($model)
        {
            require_once "./mvc/Models/Admin/".$model.".php";

            return new $model;
        }

// Hàm view - thực hiện chức năng chính của hàm view
        function view($view, $data=[])
        {
            require_once "./mvc/Views/User/layouts/".$view.".php";
        }

// Hàm viewAdmin - thực hiện chức năng chính của hàm viewAdmin
        function viewAdmin($view, $data = [])
        {
            require_once "./mvc/Views/Admin/layouts/".$view.".php";
        }
    }
?>