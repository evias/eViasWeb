
-- user update
create trigger tg_user_before_update
	before update on evias_users
	for each row
		execute procedure set_date_updated();

