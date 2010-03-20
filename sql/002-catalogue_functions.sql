--------------------------------------------------------
--			Create trigger procedures				  --
--------------------------------------------------------

-- set_date_updated_catalogue
create or replace function set_date_updated () returns trigger AS ' 
	begin
		NEW.date_updated := now();
		
		return NEW;
	end;
' language 'plpgsql';

-- @todo : check_article_insert
--			on article_publishing_data insert
--			verify category_publishing_data access level
--				> should always smaller or equal
--			verify category_publishing_data catalogue_id

