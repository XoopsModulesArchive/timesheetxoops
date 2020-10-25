# MySQL dump
#
# Host: localhost    Database: timesheet
#--------------------------------------------------------

#
# Table structure for table 'assignments'
#
CREATE TABLE tsx_assignments (
    proj_id  INT(11)  DEFAULT '0' NOT NULL,
    username CHAR(32) DEFAULT ''  NOT NULL,
    PRIMARY KEY (proj_id, username)
);

INSERT INTO tsx_assignments
VALUES (1, 'guest');

#
# Table structure for table 'client'
#
CREATE TABLE tsx_client (
    client_id          INT(8) NOT NULL AUTO_INCREMENT,
    organisation       VARCHAR(64),
    description        VARCHAR(255),
    address1           VARCHAR(127),
    city               VARCHAR(60),
    state              VARCHAR(80),
    country            CHAR(2),
    postal_code        VARCHAR(13),
    contact_first_name VARCHAR(127),
    contact_last_name  VARCHAR(127),
    username           VARCHAR(32),
    contact_email      VARCHAR(127),
    phone_number       VARCHAR(20),
    fax_number         VARCHAR(20),
    gsm_number         VARCHAR(20),
    http_url           VARCHAR(127),
    address2           VARCHAR(127),
    PRIMARY KEY (client_id)
);

INSERT INTO tsx_client
VALUES (1, 'No Client', 'This is required, do not edit or delete this client record', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

#
# Table structure for table 'config'
#

CREATE TABLE tsx_config (
    config_set_id         INT(1)                    NOT NULL DEFAULT '0',
    version               VARCHAR(32)               NOT NULL DEFAULT '1.2.1',
    headerhtml            MEDIUMTEXT                NOT NULL,
    bodyhtml              MEDIUMTEXT                NOT NULL,
    footerhtml            MEDIUMTEXT                NOT NULL,
    errorhtml             MEDIUMTEXT                NOT NULL,
    bannerhtml            MEDIUMTEXT                NOT NULL,
    tablehtml             MEDIUMTEXT                NOT NULL,
    locale                VARCHAR(127)                       DEFAULT NULL,
    timezone              VARCHAR(127)                       DEFAULT NULL,
    timeformat            ENUM ('12','24')          NOT NULL DEFAULT '12',
    weekstartday          TINYINT                   NOT NULL DEFAULT 0,
    useLDAP               TINYINT(4)                NOT NULL DEFAULT '0',
    LDAPScheme            VARCHAR(32)                        DEFAULT NULL,
    LDAPHost              VARCHAR(255)                       DEFAULT NULL,
    LDAPPort              INT(11)                            DEFAULT NULL,
    LDAPBaseDN            VARCHAR(255)                       DEFAULT NULL,
    LDAPUsernameAttribute VARCHAR(255)                       DEFAULT NULL,
    LDAPSearchScope       ENUM ('base','sub','one') NOT NULL DEFAULT 'base',
    LDAPFilter            VARCHAR(255)                       DEFAULT NULL,
    LDAPProtocolVersion   VARCHAR(255)                       DEFAULT '3',
    LDAPBindUsername      VARCHAR(255)                       DEFAULT '',
    LDAPBindPassword      VARCHAR(255)                       DEFAULT '',
    PRIMARY KEY (config_set_id)
)
    ENGINE = ISAM;

#
# Dumping data for table 'config'
#
INSERT INTO tsx_config
VALUES (0, '1.2.1', '<META name=\"description\" content=\"Timesheet.php Employee/Contractor Timesheets\">\r\n<link href=\"css/timesheet.css\" rel=\"stylesheet\" type=\"text/css\">', 'link=\"#004E8A\" vlink=\"#171A42\"',
        '<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\r\n<tr><td style=\"background-color: #000788; padding: 3;\" class=\"bottom_bar_text\" align=\"center\">\r\n\r\nTimesheet.php website: <A href=\"http://www.advancen.com/timesheet/\"><span \r\n\r\nclass=\"bottom_bar_text\">http://www.advancen.com/timesheet/</span></A>\r\n<br><span style=\"font-size: 9px;\"><b>Page generated %time% %date% (%timezone% time)</b></span>\r\n\r\n</td></tr></table>',
        '<TABLE border=0 cellpadding=5 width=\"100%\">\r\n<TR><TD><FONT size=\"+2\" color=\"red\">%errormsg%</FONT></TD></TR></TABLE>\r\n<P>Please go <A href=\"javascript:history.back()\">Back</A> and try again.</P>',
        '<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr>\r\n<td colspan=\"2\" background=\"images/timesheet_background_pattern.gif\"><img src=\"images/timesheet_banner.gif\"></td></tr><tr>\r\n\r\n<td style=\"background-color: #F2F3FF; padding: 3;\">%commandmenu%</td>\r\n<td style=\"background-color: #F2F3FF; padding: 3;\" align=\"right\" width=\"145\" valign=\"top\">You are logged in as %username%</td>\r\n</tr><td colspan=\"2\" height=\"1\" style=\"background-color: #758DD6;\"><img src=\"images/spacer.gif\" width=\"1\" height=\"1\"></td></tr>\r\n</table>',
        '', 'en_AU', 'Australia/Melbourne', '12', 1, 0, 'ldap', 'watson', 389, 'dc=watson', 'cn', 'base', '', '3', '', '');
INSERT INTO tsx_config
VALUES (1, '1.2.1', '<META name=\"description\" content=\"Timesheet.php Employee/Contractor Timesheets\">\r\n<link href=\"css/timesheet.css\" rel=\"stylesheet\" type=\"text/css\">', 'link=\"#004E8A\" vlink=\"#171A42\"',
        '<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\r\n<tr><td style=\"background-color: #000788; padding: 3;\" class=\"bottom_bar_text\" align=\"center\">\r\n\r\nTimesheet.php website: <A href=\"http://www.advancen.com/timesheet/\"><span \r\n\r\nclass=\"bottom_bar_text\">http://www.advancen.com/timesheet/</span></A>\r\n<br><span style=\"font-size: 9px;\"><b>Page generated %time% %date% (%timezone% time)</b></span>\r\n\r\n</td></tr></table>',
        '<TABLE border=0 cellpadding=5 width=\"100%\">\r\n<TR><TD><FONT size=\"+2\" color=\"red\">%errormsg%</FONT></TD></TR></TABLE>\r\n<P>Please go <A href=\"javascript:history.back()\">Back</A> and try again.</P>',
        '<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr>\r\n<td colspan=\"2\" background=\"images/timesheet_background_pattern.gif\"><img src=\"images/timesheet_banner.gif\"></td></tr><tr>\r\n\r\n<td style=\"background-color: #F2F3FF; padding: 3;\">%commandmenu%</td>\r\n<td style=\"background-color: #F2F3FF; padding: 3;\" align=\"right\" width=\"145\" valign=\"top\">You are logged in as %username%</td>\r\n</tr><td colspan=\"2\" height=\"1\" style=\"background-color: #758DD6;\"><img src=\"images/spacer.gif\" width=\"1\" height=\"1\"></td></tr>\r\n</table>',
        '', 'en_AU', 'Australia/Melbourne', '12', 1, 0, 'ldap', 'watson', 389, 'dc=watson', 'cn', 'base', '', '3', '', '');
INSERT INTO tsx_config
VALUES (2, '1.2.1', '<META name=\"description\" content=\"Timesheet.php Employee/Contractor Timesheets\">\r\n<link href=\"css/questra/timesheet.css\" rel=\"stylesheet\" type=\"text/css\">', 'link=\"#004E8A\" vlink=\"#171A42\"',
        '</td><td width=\"2\" style=\"background-color: #9494B7;\"><img src=\"images/questra/spacer.gif\" width=\"2\" height=\"1\"></td></tr>\r\n<tr><td colspan=\"3\" style=\"background-color: #9494B7; padding: 3;\" class=\"bottom_bar_text\" align=\"center\">\r\n\r\nTimesheet.php website: <A href=\"http://www.advancen.com/timesheet/\"><span \r\n\r\nclass=\"bottom_bar_text\">http://www.advancen.com/timesheet/</span></A>\r\n<br><span style=\"font-size: 9px;\"><b>Page generated %time% %date% (%timezone% time)</b></span>\r\n\r\n</td></tr></table>',
        '<TABLE border=0 cellpadding=5 width=\"100%\">\r\n<TR><TD><FONT size=\"+2\" color=\"red\">%errormsg%</FONT></TD></TR></TABLE>\r\n<P>Please go <A href=\"javascript:history.back()\">Back</A> and try again.</P>',
        '<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr>\r\n  <td style=\"padding-right: 15; padding-bottom: 8;\"><img src=\"images/questra/logo.gif\"></td>\r\n  <td width=\"100%\" valign=\"bottom\">\r\n    <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\r\n      <tr><td colspan=\"3\" class=\"text_faint\" style=\"padding-bottom: 5;\" align=\"right\">You are logged in as %username%.</td></tr>\r\n      <tr>\r\n        <td background=\"images/questra/bar_left.gif\" valign=\"top\"><img src=\"images/questra/spacer.gif\" height=\"1\" width=\"8\"></td>\r\n        <td background=\"images/questra/bar_background.gif\" width=\"100%\" style=\"padding: 5;\">%commandmenu%</td>\r\n        <td background=\"images/questra/bar_right.gif\" valign=\"top\"><img src=\"images/questra/spacer.gif\" height=\"1\" width=\"8\"></td>\r\n      </tr>\r\n    </table>\r\n  </td>\r\n</tr></table>\r\n\r\n<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr>\r\n<td colspan=\"3\" height=\"8\" style=\"background-color: #9494B7;\"><img src=\"images/questra/spacer.gif\" width=\"1\" height=\"8\"></td></tr><tr>\r\n<td width=\"2\" style=\"background-color: #9494B7;\"><img src=\"images/questra/spacer.gif\" width=\"2\" height=\"1\"></td>\r\n<td width=\"100%\" bgcolor=\"#F2F2F8\">',
        '', 'en_AU', 'Australia/Melbourne', '12', 1, 0, 'ldap', 'watson', 389, 'dc=watson', 'cn', 'base', '', '3', '', '');


#
# Table structure for table 'note'
#
CREATE TABLE tsx_note (
    note_id    INT(6) AUTO_INCREMENT,
    proj_id    INT(8)         DEFAULT '0'                   NOT NULL,
    date       DATETIME       DEFAULT '0000-00-00 00:00:00' NOT NULL,
    subject    VARCHAR(127)   DEFAULT ''                    NOT NULL,
    body       TEXT                                         NOT NULL,
    to_contact ENUM ('Y','N') DEFAULT 'N'                   NOT NULL,
    PRIMARY KEY (note_id)
);

#
# Table structure for table 'project'
#
CREATE TABLE tsx_project (
    proj_id     INT(11)                                                                NOT NULL AUTO_INCREMENT,
    title       VARCHAR(200)                                      DEFAULT ''           NOT NULL,
    client_id   INT(11)                                           DEFAULT '0'          NOT NULL,
    description VARCHAR(255),
    start_date  DATE                                              DEFAULT '1970-01-01' NOT NULL,
    deadline    DATE                                              DEFAULT '0000-00-00' NOT NULL,
    http_link   VARCHAR(127),
    proj_status ENUM ('Pending','Started','Suspended','Complete') DEFAULT 'Pending'    NOT NULL,
    proj_leader VARCHAR(32)                                       DEFAULT ''           NOT NULL,
    PRIMARY KEY (proj_id)
);

INSERT INTO tsx_project
VALUES (1, 'Default Project', 1, '', '', '', '', 'Started', '');

#
# Table structure for table 'task'
#
CREATE TABLE tsx_task (
    task_id     INT(11)                                                                                    NOT NULL AUTO_INCREMENT,
    proj_id     INT(11)                                                      DEFAULT '0'                   NOT NULL,
    name        VARCHAR(127)                                                 DEFAULT ''                    NOT NULL,
    description TEXT,
    assigned    DATETIME                                                     DEFAULT '0000-00-00 00:00:00' NOT NULL,
    started     DATETIME                                                     DEFAULT '0000-00-00 00:00:00' NOT NULL,
    suspended   DATETIME                                                     DEFAULT '0000-00-00 00:00:00' NOT NULL,
    completed   DATETIME                                                     DEFAULT '0000-00-00 00:00:00' NOT NULL,
    status      ENUM ('Pending','Assigned','Started','Suspended','Complete') DEFAULT 'Pending'             NOT NULL,
    PRIMARY KEY (task_id)
);

INSERT INTO tsx_task
VALUES (1, 1, 'Default Task', '', '', '', '', '', 'Started');

#
# Table structure for table 'task_assignments'
#
CREATE TABLE tsx_task_assignments (
    task_id  INT(8)      DEFAULT '0' NOT NULL,
    username VARCHAR(32) DEFAULT ''  NOT NULL,
    proj_id  INT(11)     DEFAULT '0' NOT NULL,
    PRIMARY KEY (task_id, username)
);

INSERT INTO tsx_task_assignments
VALUES (1, 'guest', 1);

#
# Table structure for table 'times'
#
CREATE TABLE tsx_times (
    uid         VARCHAR(32) DEFAULT ''                    NOT NULL,
    start_time  DATETIME    DEFAULT '1970-01-01 00:00:00' NOT NULL,
    end_time    DATETIME    DEFAULT '0000-00-00 00:00:00' NOT NULL,
    trans_num   INT(11)                                   NOT NULL AUTO_INCREMENT,
    proj_id     INT(11)     DEFAULT '1'                   NOT NULL,
    task_id     INT(11)     DEFAULT '1'                   NOT NULL,
    log_message VARCHAR(255),
    KEY uid (uid, trans_num),
    UNIQUE trans_num (trans_num)
);

#
# Table structure for table 'user'
#
CREATE TABLE tsx_user (
    username       VARCHAR(32)       DEFAULT ''     NOT NULL,
    level          INT(11)           DEFAULT '0'    NOT NULL,
    password       VARCHAR(41)       DEFAULT ''     NOT NULL,
    allowed_realms VARCHAR(20)       DEFAULT '.*'   NOT NULL,
    first_name     VARCHAR(64)       DEFAULT ''     NOT NULL,
    last_name      VARCHAR(64)       DEFAULT ''     NOT NULL,
    email_address  VARCHAR(63)       DEFAULT ''     NOT NULL,
    phone          VARCHAR(31)       DEFAULT ''     NOT NULL,
    bill_rate      DECIMAL(8, 2)     DEFAULT '0.00' NOT NULL,
    time_stamp     TIMESTAMP(14),
    status         ENUM ('IN','OUT') DEFAULT 'OUT'  NOT NULL,
    uid            INT(11)                          NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (username),
    KEY uid (uid)
);

INSERT INTO tsx_user
VALUES ('admin', 10, PASSWORD('admin'), '.*', 'Timesheet', 'Admin', '', '', '0.00', '', 'OUT', '1');
INSERT INTO tsx_user
VALUES ('guest', 1, PASSWORD('guest'), '.*', 'Guest', 'User', '', '', '0.00', '', 'OUT', '2');
