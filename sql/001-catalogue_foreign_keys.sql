---------------------------------------------------------
--				Add foreign keys					   --
---------------------------------------------------------

alter table evias_catalogue_category
	add foreign key (parent_category_id)
	references
		evias_catalogue_category (category_id);

alter table evias_catalogue_category_publishing_data
	add foreign key (category_id)
	references
		evias_catalogue_category (category_id);

alter table evias_catalogue_category_publishing_data
	add foreign key (catalogue_id)
	references
		evias_catalogue (catalogue_id);

alter table evias_catalogue_article_publishing_data
	add foreign key (article_id)
	references
		evias_catalogue_article (article_id);

alter table evias_catalogue_article_publishing_data
	add foreign key (category_id)
	references
		evias_catalogue_category (category_id);

alter table evias_catalogue_article_publishing_data
	add foreign key (catalogue_id)
	references
		evias_catalogue (catalogue_id);

alter table evias_catalogue_article_publishing_data
	add foreign key (prize_data_id)
	references
		evias_catalogue_prize_data (prize_data_id);

alter table evias_catalogue_prize_data
	add foreign key (currency_id)
	references 
		evias_catalogue_currency (currency_id);

