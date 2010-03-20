--------------------------------------------------------
--			Add triggers for update					  --
--------------------------------------------------------

-- catalogue update
create trigger tg_catalogue_before_update 
	before update on evias_catalogue
	for each row
		execute procedure set_date_updated();

-- category update
create trigger tg_category_before_update
	before update on evias_catalogue_category
	for each row
		execute procedure set_date_updated();

-- article update
create trigger tg_article_before_update
	before update on evias_catalogue_article
	for each row
		execute procedure set_date_updated();

-- category_resource update
create trigger tg_category_resource_before_update
	before update on evias_catalogue_category_resource
	for each row
		execute procedure set_date_updated();

-- article_resource update
create trigger tg_article_resource_before_update
	before update on evias_catalogue_article_resource
	for each row
		execute procedure set_date_updated();

-- category_publishing_data update
create trigger tg_category_publishing_data_before_update
	before update on evias_catalogue_category_publishing_data
	for each row
		execute procedure set_date_updated();

-- article_publishing_data update
create trigger tg_article_publishing_data_before_update
	before update on evias_catalogue_article_publishing_data
	for each row
		execute procedure set_date_updated();

-- currency update
create trigger tg_currency_before_update
	before update on evias_catalogue_currency
	for each row
		execute procedure set_date_updated();

-- prize_data update
create trigger tg_prize_data_before_update
	before update on evias_catalogue_prize_data
	for each row
		execute procedure set_date_updated();
