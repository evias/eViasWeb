
-- blog update
create trigger tg_blog_before_update
	before update on evias_blog
	for each row
		execute procedure set_date_updated();


-- category update
create trigger tg_blog_category_before_update
	before update on evias_blog_category
	for each row
		execute procedure set_date_updated();


-- category update
create trigger tg_blog_article_before_update
	before update on evias_blog_article
	for each row
		execute procedure set_date_updated();



