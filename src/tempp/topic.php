<?php

$rel_typ_suffix = 2;

$ID = IsId(2);

$table = 'topic';

// definded rules ascending
$rule = array();

$rule['default'] = ' topic_status = 1 ';

$member_rule = array(
    $member_rule[MEMBER_PENNDLING] = $rule['default'],
    $member_rule[MEMBER_APPROVED] = $rule['default'],
    $member_rule[MEMBER_SPECIAL] = 'topic_status > 0',
    $member_rule[MEMBER_BANDED] = $rule['default']
);
//
//$manager_rule = array(
//    $manager_rule[MANAGER_UNKNOWN] = $rule['default'],
//    $manager_rule[MANAGER_OWNER] = '1',
//    $manager_rule[MANAGER_ADMIN] = '1',
//    $manager_rule[MANAGER_DEFINED] = $rule['default'],
//    $manager_rule[MANAGER_LIMITED] = $rule['default'],
//    $manager_rule[MANAGER_BANNDED] = $rule['default']
//);

;
$manager_rule = array(
    $manager_rule[0] = $rule['default'],
    $manager_rule[1] = '1',
    $manager_rule[2] = '1',
    $manager_rule[3] = $rule['default'],
    $manager_rule[4] = $rule['default'],
    $manager_rule[5] = $rule['default']
);

$rule['visitor'] = $rule['default'];
$rule['member'] = $member_rule;
$rule['manager'] = $manager_rule;


