begin ;

alter table evias_blog_article add column small_contenu varchar (512) not null default '';

alter table evias_blog_article add column count_likes integer not null default 0;
