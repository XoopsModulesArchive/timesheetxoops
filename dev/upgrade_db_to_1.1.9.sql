ALTER TABLE timesheet_config
    ADD COLUMN useLDAP TINYINT NOT NULL DEFAULT 0;

ALTER TABLE timesheet_config
    ADD COLUMN LDAPScheme VARCHAR(32);

ALTER TABLE timesheet_config
    ADD COLUMN LDAPHost VARCHAR(255);

ALTER TABLE timesheet_config
    ADD COLUMN LDAPPort INTEGER;

ALTER TABLE timesheet_config
    ADD COLUMN LDAPBaseDN VARCHAR(255);

ALTER TABLE timesheet_config
    ADD COLUMN LDAPUsernameAttribute VARCHAR(255);

ALTER TABLE timesheet_config
    ADD COLUMN LDAPSearchScope ENUM ('base', 'sub', 'one') NOT NULL DEFAULT 'base';

ALTER TABLE timesheet_config
    ADD COLUMN LDAPFilter VARCHAR(255);

ALTER TABLE timesheet_config
    ADD COLUMN weekstartday TINYINT NOT NULL DEFAULT 0;
