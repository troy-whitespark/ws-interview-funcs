<?php

class DB {

    function getAllUsers() {
        return db_execute("SELECT * from users");
    }

    // Example return:
    // [
    //     user,
    //     user,
    //     ... (additional user objects up to page_size)
    //  ] 
    //
    // page_size = # of results per page
    // page = page number requested
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

    // Example return:
    // [
    //     project,
    //     project,
    //     ... (additional project objects up to page_size)
    //  ] 
    //
    // page_size = # of results per page
    // page = page number requested
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

