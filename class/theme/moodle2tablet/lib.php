<?php


/**
 * Sets the custom css variable in CSS
 *
 * @param string $css
 * @param mixed $customcss
 * @return string
 */
function moodle2tablet_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function moodle2tablet_require_course_login($courseorid, $autologinguest = true, $cm = NULL, $setwantsurltome = true, $preventredirect = true) {
    global $CFG, $SITE;
    $issite = (is_object($courseorid) and $courseorid->id == SITEID)
          or (!is_object($courseorid) and $courseorid == SITEID);
    if ($issite && !empty($cm) && !($cm instanceof cm_info)) {
        // note: nearly all pages call get_fast_modinfo anyway and it does not make any
        // db queries so this is not really a performance concern, however it is obviously
        // better if you use get_fast_modinfo to get the cm before calling this.
        if (is_object($courseorid)) {
            $course = $courseorid;
        } else {
            $course = clone($SITE);
        }
        $modinfo = get_fast_modinfo($course);
        $cm = $modinfo->get_cm($cm->id);
    }
    if (!empty($CFG->forcelogin)) {
        // login required for both SITE and courses
        moodle2tablet_require_login($courseorid, $autologinguest, $cm, $setwantsurltome, $preventredirect);

    } else if ($issite && !empty($cm) and !$cm->uservisible) {
        // always login for hidden activities
        moodle2tablet_require_login($courseorid, $autologinguest, $cm, $setwantsurltome, $preventredirect);

    } else if ($issite) {
              //login for SITE not required
        if ($cm and empty($cm->visible)) {
            // hidden activities are not accessible without login
            moodle2tablet_require_login($courseorid, $autologinguest, $cm, $setwantsurltome, $preventredirect);
        } else if ($cm and !empty($CFG->enablegroupmembersonly) and $cm->groupmembersonly) {
            // not-logged-in users do not have any group membership
            moodle2tablet_require_login($courseorid, $autologinguest, $cm, $setwantsurltome, $preventredirect);
        } else {
            // We still need to instatiate PAGE vars properly so that things
            // that rely on it like navigation function correctly.
            if (!empty($courseorid)) {
                if (is_object($courseorid)) {
                    $course = $courseorid;
                } else {
                    $course = clone($SITE);
                }
                if ($cm) {
                    if ($cm->course != $course->id) {
                        throw new coding_exception('course and cm parameters in require_course_login() call do not match!!');
                    }
                }
            }
            return;
        }

    } else {
        // course login always required
        moodle2tablet_require_login($courseorid, $autologinguest, $cm, $setwantsurltome, $preventredirect);
    }
}

function moodle2tablet_require_login($courseorid = NULL, $autologinguest = true, $cm = NULL, $setwantsurltome = true, $preventredirect = false) {
    global $CFG, $SESSION, $USER, $FULLME, $DB;

    // setup global $COURSE, themes, language and locale
    if (!empty($courseorid)) {
        if (is_object($courseorid)) {
            $course = $courseorid;
        } else if ($courseorid == SITEID) {
            $course = clone($SITE);
        } else {
            $course = $DB->get_record('course', array('id' => $courseorid), '*', MUST_EXIST);
        }
        if ($cm) {
            if ($cm->course != $course->id) {
                throw new coding_exception('course and cm parameters in require_login() call do not match!!');
            }
            // make sure we have a $cm from get_fast_modinfo as this contains activity access details
            if (!($cm instanceof cm_info)) {
                // note: nearly all pages call get_fast_modinfo anyway and it does not make any
                // db queries so this is not really a performance concern, however it is obviously
                // better if you use get_fast_modinfo to get the cm before calling this.
                $modinfo = get_fast_modinfo($course);
                $cm = $modinfo->get_cm($cm->id);
            }
        }
    } else {
        // do not touch global $COURSE via $PAGE->set_course(),
        // the reasons is we need to be able to call require_login() at any time!!
        $course = $SITE;
        if ($cm) {
            throw new coding_exception('cm parameter in require_login() requires valid course parameter!');
        }
    }

    // If the user is not even logged in yet then make sure they are
    if (!isloggedin()) {
        if ($autologinguest and !empty($CFG->guestloginbutton) and !empty($CFG->autologinguests)) {
            if (!$guest = get_complete_user_data('id', $CFG->siteguest)) {
                // misconfigured site guest, just redirect to login page
                redirect(get_login_url());
                exit; // never reached
            }
            $lang = isset($SESSION->lang) ? $SESSION->lang : $CFG->lang;
            complete_user_login($guest);
            $USER->autologinguest = true;
            $SESSION->lang = $lang;
        } else {
            //NOTE: $USER->site check was obsoleted by session test cookie,
            //      $USER->confirmed test is in login/index.php
            if ($preventredirect) {
                throw new require_login_exception('You are not logged in');
            }

            if ($setwantsurltome) {
                // TODO: switch to PAGE->url
                $SESSION->wantsurl = $FULLME;
            }
            if (!empty($_SERVER['HTTP_REFERER'])) {
                $SESSION->fromurl  = $_SERVER['HTTP_REFERER'];
            }
            redirect(get_login_url());
            exit; // never reached
        }
    }

    // loginas as redirection if needed
    if ($course->id != SITEID and session_is_loggedinas()) {
        if ($USER->loginascontext->contextlevel == CONTEXT_COURSE) {
            if ($USER->loginascontext->instanceid != $course->id) {
                print_error('loginasonecourse', '', $CFG->wwwroot.'/course/view.php?id='.$USER->loginascontext->instanceid);
            }
        }
    }

    // check whether the user should be changing password (but only if it is REALLY them)
    if (get_user_preferences('auth_forcepasswordchange') && !session_is_loggedinas()) {
        $userauth = get_auth_plugin($USER->auth);
        if ($userauth->can_change_password() and !$preventredirect) {
            $SESSION->wantsurl = $FULLME;
            if ($changeurl = $userauth->change_password_url()) {
                //use plugin custom url
                redirect($changeurl);
            } else {
                //use moodle internal method
                if (empty($CFG->loginhttps)) {
                    redirect($CFG->wwwroot .'/login/change_password.php');
                } else {
                    $wwwroot = str_replace('http:','https:', $CFG->wwwroot);
                    redirect($wwwroot .'/login/change_password.php');
                }
            }
        } else {
            print_error('nopasswordchangeforced', 'auth');
        }
    }

    // Check that the user account is properly set up
    if (user_not_fully_set_up($USER)) {
        if ($preventredirect) {
            throw new require_login_exception('User not fully set-up');
        }
        $SESSION->wantsurl = $FULLME;
        redirect($CFG->wwwroot .'/user/edit.php?id='. $USER->id .'&amp;course='. SITEID);
    }

    // Make sure the USER has a sesskey set up. Used for CSRF protection.
    sesskey();

    // Do not bother admins with any formalities
    if (is_siteadmin()) {
        return;
    }

    // Fetch the system context, the course context, and prefetch its child contexts
    $sysctx = get_context_instance(CONTEXT_SYSTEM);
    $coursecontext = get_context_instance(CONTEXT_COURSE, $course->id, MUST_EXIST);
    if ($cm) {
        $cmcontext = get_context_instance(CONTEXT_MODULE, $cm->id, MUST_EXIST);
    } else {
        $cmcontext = null;
    }

    // make sure the course itself is not hidden
    if ($course->id == SITEID) {
        // frontpage can not be hidden
    } else {
        if (is_role_switched($course->id)) {
            // when switching roles ignore the hidden flag - user had to be in course to do the switch
        } else {
            if (!$course->visible and !has_capability('moodle/course:viewhiddencourses', $coursecontext)) {
                // originally there was also test of parent category visibility,
                // BUT is was very slow in complex queries involving "my courses"
                // now it is also possible to simply hide all courses user is not enrolled in :-)
                if ($preventredirect) {
                    throw new require_login_exception('Course is hidden');
                }
                notice(get_string('coursehidden'), $CFG->wwwroot .'/');
            }
        }
    }

    // is the user enrolled?
    if ($course->id == SITEID) {
        // everybody is enrolled on the frontpage

    } else {
        if (session_is_loggedinas()) {
            // Make sure the REAL person can access this course first
            $realuser = session_get_realuser();
            if (!is_enrolled($coursecontext, $realuser->id, '', true) and !is_viewing($coursecontext, $realuser->id) and !is_siteadmin($realuser->id)) {
                if ($preventredirect) {
                    throw new require_login_exception('Invalid course login-as access');
                }
                echo $OUTPUT->header();
                notice(get_string('studentnotallowed', '', fullname($USER, true)), $CFG->wwwroot .'/');
            }
        }

        // very simple enrolment caching - changes in course setting are not reflected immediately
        if (!isset($USER->enrol)) {
            $USER->enrol = array();
            $USER->enrol['enrolled'] = array();
            $USER->enrol['tempguest'] = array();
        }

        $access = false;

        if (is_viewing($coursecontext, $USER)) {
            // ok, no need to mess with enrol
            $access = true;

        } else {
            if (isset($USER->enrol['enrolled'][$course->id])) {
                if ($USER->enrol['enrolled'][$course->id] == 0) {
                    $access = true;
                } else if ($USER->enrol['enrolled'][$course->id] > time()) {
                    $access = true;
                } else {
                    //expired
                    unset($USER->enrol['enrolled'][$course->id]);
                }
            }
            if (isset($USER->enrol['tempguest'][$course->id])) {
                if ($USER->enrol['tempguest'][$course->id] == 0) {
                    $access = true;
                } else if ($USER->enrol['tempguest'][$course->id] > time()) {
                    $access = true;
                } else {
                    //expired
                    unset($USER->enrol['tempguest'][$course->id]);
                    $USER->access = remove_temp_roles($coursecontext, $USER->access);
                }
            }

            if ($access) {
                // cache ok
            } else if (is_enrolled($coursecontext, $USER, '', true)) {
                // active participants may always access
                // TODO: refactor this into some new function
                $now = time();
                $sql = "SELECT MAX(ue.timeend)
                          FROM {user_enrolments} ue
                          JOIN {enrol} e ON (e.id = ue.enrolid AND e.courseid = :courseid)
                          JOIN {user} u ON u.id = ue.userid
                         WHERE ue.userid = :userid AND ue.status = :active AND e.status = :enabled AND u.deleted = 0
                               AND ue.timestart < :now1 AND (ue.timeend = 0 OR ue.timeend > :now2)";
                $params = array('enabled'=>ENROL_INSTANCE_ENABLED, 'active'=>ENROL_USER_ACTIVE,
                                'userid'=>$USER->id, 'courseid'=>$coursecontext->instanceid, 'now1'=>$now, 'now2'=>$now);
                $until = $DB->get_field_sql($sql, $params);
                if (!$until or $until > time() + ENROL_REQUIRE_LOGIN_CACHE_PERIOD) {
                    $until = time() + ENROL_REQUIRE_LOGIN_CACHE_PERIOD;
                }

                $USER->enrol['enrolled'][$course->id] = $until;
                $access = true;

                // remove traces of previous temp guest access
                $USER->access = remove_temp_roles($coursecontext, $USER->access);

            } else {
                $instances = $DB->get_records('enrol', array('courseid'=>$course->id, 'status'=>ENROL_INSTANCE_ENABLED), 'sortorder, id ASC');
                $enrols = enrol_get_plugins(true);
                // first ask all enabled enrol instances in course if they want to auto enrol user
                foreach($instances as $instance) {
                    if (!isset($enrols[$instance->enrol])) {
                        continue;
                    }
                    // Get a duration for the guestaccess, a timestamp in the future or false.
                    $until = $enrols[$instance->enrol]->try_autoenrol($instance);
                    if ($until !== false) {
                        $USER->enrol['enrolled'][$course->id] = $until;
                        $USER->access = remove_temp_roles($coursecontext, $USER->access);
                        $access = true;
                        break;
                    }
                }
                // if not enrolled yet try to gain temporary guest access
                if (!$access) {
                    foreach($instances as $instance) {
                        if (!isset($enrols[$instance->enrol])) {
                            continue;
                        }
                        // Get a duration for the guestaccess, a timestamp in the future or false.
                        $until = $enrols[$instance->enrol]->try_guestaccess($instance);
                        if ($until !== false) {
                            $USER->enrol['tempguest'][$course->id] = $until;
                            $access = true;
                            break;
                        }
                    }
                }
            }
        }

        if (!$access) {
            if ($preventredirect) {
                throw new require_login_exception('Not enrolled');
            }
            $SESSION->wantsurl = $FULLME;
            redirect($CFG->wwwroot .'/enrol/index.php?id='. $course->id);
        }
    }

    // Check visibility of activity to current user; includes visible flag, groupmembersonly,
    // conditional availability, etc
    if ($cm && !$cm->uservisible) {
        if ($preventredirect) {
            throw new require_login_exception('Activity is hidden');
        }
        redirect($CFG->wwwroot, get_string('activityiscurrentlyhidden'));
    }
}


