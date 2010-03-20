---------------------------------------------------------
--				Add foreign keys					   --
---------------------------------------------------------

alter table evias_blog_category
	add foreign key (blog_id)
	references
		evias_blog (blog_id);

alter table evias_blog_article
	add foreign key (status_type_id)
	references
		evias_blog_article_status_type (status_type_id);

alter table evias_blog_article
	add foreign key (category_id)
	references
		evias_blog_category (category_id);
