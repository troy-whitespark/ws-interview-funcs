<?php

if (isset($_POST['subscribe_to']) && $_POST['subscribe_to'] == 'local-citation-finder') {
    DB::table('subscriptions')
        ->insert([ 'product' => 'local-citation-finder', 'rate' => 40 ]);

    switch($_POST['account_type']) {
        case 'basic': $limit = 1; break;
        case 'advanced': $limit = 5; break;
        case 'enterprise': $limit = 100; break;
        default: send_email('support@whitespark.ca', "unknown plan type {$_POST['account_type']}"); return view("error", "unknown plan type {$_POST['account_type']}"); break;
    }

    db_connect_external('postgres:://lcf-database')
        ->table('users')
        ->insert([ 'external_id' => $_SESSION['user_id'], 'name' => $_SESSION['user_name'], 'account_limit' => $limit ]);
}

if (isset($_POST['subscribe_to']) && $_POST['subscribe_to'] == 'local-rank-tracker') {
    DB::table('subscriptions')
        ->insert([ 'product' => 'local-rank-tracker', 'rate' => 20 ]);

    switch($_POST['account_type']) {
        case 'basic': $limit = 50; $period = 'weekly'; break;
        case 'advanced': $limit = 100; $period = 'daily'; break;
        case 'enterprise': $limit = 500; $period = 'daily'; break;
        default: send_email('support@whitespark.ca', "unknown plan type {$_POST['account_type']}"); return view("error", "unknown plan type {$_POST['account_type']}"); break;
    }

    db_connect_external('postgres:://rt-database')
        ->table('users')
        ->insert([ 'external_id' => $_SESSION['user_id'], 'name' => $_SESSION['user_name'], 'account_limit' => $limit, 'period' => $period ]);
}

$user = DB::table('users')->find($_POST['user_id']);

send_email($user->email, "Congratulations on your new subscription to {$_POST['subscribe_to']}");

return view("success", [ $user, $_POST['subscribe_to']]);
