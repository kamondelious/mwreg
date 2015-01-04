<?php

function get_all_mechs() {
    return db_query(
        "SELECT m.mechid AS mechid, m.name AS name, m.builder AS builder, m.team AS team, m.url AS url, ".
        "t.name AS teamname, u.name AS username FROM mechs m, teams t, users u ".
        "WHERE m.builder=u.userid AND m.team=t.teamid");
}

function get_mech_by_id($mechid) {
    $ret = db_query(
        "SELECT m.mechid AS mechid, m.name AS name, m.builder AS builder, m.team AS team, m.url AS url, ".
        "t.name AS teamname, u.name AS username FROM mechs m, teams t, users u ".
        "WHERE m.builder=u.userid AND m.team=t.teamid AND m.mechid=:mechid",
        array('mechid'=>$mechid));
    return $ret ? $ret[0] : null;
}

function get_mechs_by_userid($userid) {
    $ret = db_query(
        "SELECT m.mechid AS mechid, m.name AS name, m.builder AS builder, m.team AS team, m.url AS url, ".
        "t.name AS teamname, u.name AS username FROM mechs m, teams t, users u ".
        "WHERE m.builder=u.userid AND m.team=t.teamid AND u.userid=:userid",
        array('userid'=>$userid));
    return $ret;
}

function get_mechs_by_teamid($teamid) {
    $ret = db_query(
        "SELECT m.mechid AS mechid, m.name AS name, m.builder AS builder, m.team AS team, m.url AS url, ".
        "t.name AS teamname, u.name AS username FROM mechs m, teams t, users u ".
        "WHERE m.builder=u.userid AND m.team=t.teamid AND t.teamid=:teamid",
        array('teamid'=>$teamid));
    return $ret;
}

function create_mech(array $builder, $name, array $team, $url) {
    if (!$builder || !@$builder['userid']) {
        errors_fatal("Bad builder for create_mech()");
    }
    if ($team && !@$team['teamid']) {
        errors_fatal("Bad team for create_mech()");
    }
    $q = db_insert("mechs", array(
        'name'=>$name,
        'builder'=>$builder['userid'],
        'team'=>$team ? $team['teamid'] : null,
        'url'=>$url));
    ), "mechid");
    return $q;
}

function add_mech_to_team($mechid, array $team) {
    global $MAILFROM;
    global $URLHOST;
    global $ROOTPATH;
    if (!$team || !@$team['teamid']) {
        errors_fatal("Bad teamid in add_mech_to_team");
    }
    if (!(int)$mechid) {
        errors_fatal("Bad mech id in add_mech_to_team");
    }
    $mech = get_mech_by_id($mechid);
    if (!$mech) {
        errors_fatal("Bad mech in add_mech_to_team");
    }
    $builder = get_user_by_id($mech['userid']);
    if (!$builder) {
        errors_fatal("Bad mech info in add_mech_to_team");
    }
    db_query("UPDATE mechs SET team=:teamid WHERE mechid=:mechid",
        array('teamid'=>$team['teamid'], 'mechid'=>$mechid));
    mail($builder['email'],
        "Your mech was added to team $team[name]",
        "The mech $mech[name] that you are listed as builder for was added \n".
        "to the team $team[name]. You can view the team roster at: \n".
        "$URLHOST$ROOTPATH/teams.php?id=$team[teamid]\n",
        "From: $MAILFROM");
}

