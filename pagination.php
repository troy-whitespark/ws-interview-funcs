<?php

class DB {

    function getAllUsers() {
        return db_execute("SELECT * from users");
    }

    function get_paged_users() {
        $sqlQueryResult = $this->getAllUsers();
        $result = [];

        for ($i = 0; $i < count($sqlQueryResult); $i++) {
            $result[ceil($i / $_GET['page_size'])][] = $sqlQueryResult[$i];
        }

        $result['meta'] = ['total' => count($sqlQueryResult), 'pages' => ceil(count($sqlQueryResult) / $_GET['page_size'])];

        return $result[$_GET['page']];
    }

    function getAllProjects() {
        return db_execute("SELECT * from projects");
    }

    function get_paged_projects() {
        $sqlQueryResult = $this->getAllProjects();
        $result = [];

        for ($i = 0; $i < count($sqlQueryResult); $i++) {
            $result[ceil($i / $_GET['page_size'])][] = $sqlQueryResult[$i];
        }

        $result['meta'] = ['total' => count($sqlQueryResult), 'pages' => ceil(count($sqlQueryResult) / $_GET['page_size'])];

        return $result[$_GET['page']];
    }
}

