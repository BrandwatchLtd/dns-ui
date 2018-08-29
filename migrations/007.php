<?php
$migration_name = 'Adding explicit support for change approval without applying changes.';

// Add new column to pending_update table to track which updates have been approved before they get applied.
$this->database->exec('
ALTER TABLE ONLY pending_update
	ADD COLUMN approved boolean DEFAULT false NOT NULL,
	ADD COLUMN approver_id bigint,
	ADD COLUMN approval_date timestamp without time zone
');

// Add new column to changeset table to keep record of which user has approved the update.
$this->database->exec('ALTER TABLE ONLY changeset ADD COLUMN approver_id bigint');
