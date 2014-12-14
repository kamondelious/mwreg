<?php

function make_new_team() {
    global $user;
    if (!$user) {
        //  not logged in
        return false;
    }
    $teams = get_teams_by_leader($user['userid']);
    if ($teams) {
        //  already leading a team
        return false;
    }
    $newteam = db_insert(
        'teams',
        array(
            'name' => "$user[name]'s Team",
            'leader' => $user['userid'],
            'url' => ""
        ),
        'teamid');
    db_query("INSERT INTO teammembers(teamid, userid, membersice, teamadmin, approved) ".
        "VALUES(:teamid, :userid, NOW(), 1, 1)", array('teamid'=>$newteam, 'userid'=>$user['userid']));
    return $newteam;
}

function get_team_by_id($teamid) {
    $t = db_query("SELECT t.name AS name, t.teamid AS teamid, t.url AS url, u.name AS leadername, u.userid AS leader " .
            "FROM teams t, users u WHERE t.teamid=:teamid and u.userid=t.leader", array('teamid'=>$teamid));
    if (!$t || !$t[0]) {
        return null;
    }
    $team = $t[0];
    $c = db_query("SELECT m.mechid AS mechid, m.name AS name, m.url AS url, u.name AS builder " .
        "FROM mechs m, users u WHERE m.builder=u.userid AND m.team=:teamid", array('teamid'=>$teamid));
    $team['mechs'] = $c;
    $c = db_query("SELECT u.name AS name, u.userid AS userid, tm.membersince AS membersince, tm.teamadmin AS teamadmin, tm.approved as approved ".
            "FROM teammembers tm, users u WHERE tm.userid=u.userid AND tm.teamid=:teamid", array('teamid'=>$teamid));
    $members = array();
    $applicants = array();
    foreach ($c as $v) {
        if ($v['approved']) {
            $members[] = $v;
        } else {
            $applicants[] = $v;
        }
    }
    $team['members'] = $members;
    $team['applicants'] = $applicants;
    return $team;
}

function get_teams_by_leader($leader) {
    $t = db_query("SELECT * FROM teams WHERE leader=:leader", array('leader'=>$leader));
    if (!$t) {
        return null;
    }
    return $t;
}

function is_valid_team_name($name) {
    return strlen($name) >= 5 && strpos($name, '@') === false && strpos($name, '://') === false &&
        strpos($name, '<') === false && strpos($name, '&') === false;
}

function is_valid_team_url($url) {
    if ($url === '') {
        return true;
    }
    if (strlen($url) < 12) {
        return false;
    }
    if (strpos($url, "http://") !== 0 &&
        strpos($url, "https://") !== 0) {
        return false;
    }
    return true;
}

function is_team_admin($userid, array $team) {
    if ($userid === $team['leader']) {
        return true;
    }
    foreach ($team['members'] as $mem) {
        if ($mem['userid'] === $userid) {
            return $mem['teamadmin'];
        }
    }
    return false;
}

function is_team_member($userid, array $team) {
    if ($team['leader'] === $userid) {
        return true;
    }
    foreach ($team['members'] as $mem) {
        if ($mem['userid'] === $userid) {
            return true;
        }
    }
    return false;
}
